<?php
/**
 * Promotion Model
 * Public promotion queries for the user-facing site.
 */

require_once __DIR__ . '/Model.php';

class PromotionModel extends Model {
    protected $table = 'Promotion';
    protected $primaryKey = 'promotionID';

    /**
     * Get active admin-created promotions for the public promotion page.
     */
    public function getActivePromotions($limit = 6) {
        $limit = max(1, (int) $limit);

        $sql = "SELECT p.*, t.title AS tourTitle, t.destination
                FROM {$this->table} p
                LEFT JOIN Tour t ON p.tourID = t.tourID
                WHERE p.startDate <= NOW()
                  AND p.endDate >= NOW()
                  AND (p.quantity IS NULL OR p.quantity > 0)
                ORDER BY p.discount DESC, p.endDate ASC, p.startDate DESC
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Best discount percent (%) per tour: max(global promos with tourID NULL, tour-specific promos).
     * Only promotions active now and with remaining quantity (if set) are considered.
     *
     * @param int[] $tourIds
     * @return array<int, float> tourID => percent 0–100
     */
    public function getBestDiscountPercentForTourIds(array $tourIds) {
        $tourIds = array_values(array_unique(array_filter(array_map('intval', $tourIds))));
        $out = [];
        if (empty($tourIds)) {
            return $out;
        }

        foreach ($tourIds as $id) {
            $out[$id] = 0.0;
        }

        $placeholders = implode(',', array_fill(0, count($tourIds), '?'));
        $sql = "SELECT tourID, discount FROM {$this->table}
                WHERE startDate <= NOW()
                  AND endDate >= NOW()
                  AND (quantity IS NULL OR quantity > 0)
                  AND (tourID IS NULL OR tourID IN ({$placeholders}))";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($tourIds);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $globalMax = 0.0;
        $perTour = [];
        foreach ($rows as $row) {
            $d = (float) ($row['discount'] ?? 0);
            if ($d <= 0) {
                continue;
            }
            $tid = $row['tourID'];
            if ($tid === null || $tid === '') {
                $globalMax = max($globalMax, $d);
            } else {
                $tid = (int) $tid;
                $perTour[$tid] = max($perTour[$tid] ?? 0.0, $d);
            }
        }

        foreach ($tourIds as $id) {
            $out[$id] = min(100, max(0, max($globalMax, $perTour[$id] ?? 0.0)));
        }

        return $out;
    }
}
