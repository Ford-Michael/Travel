<?php
/**
 * Dashboard Controller - Thá»‘ng KÃª (Statistics)
 * Admin statistics dashboard with charts
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/CheckoutModel.php';

class ThongkeController extends Controller {
    private $userModel;
    private $checkoutModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->checkoutModel = new CheckoutModel();
    }

    /**
     * Display statistics dashboard
     */
    public function index() {
        if (!$this->isLoggedIn()) {
            $this->setFlash('warning', 'Please login to access the dashboard.');
            $this->redirect('index.php?controller=auth&action=login');
            return;
        }

        $data = array_merge($this->getStatisticsData(), [
            'title' => 'Thá»‘ng KÃª - Travel Bling Admin',
            'admin' => $this->getCurrentAdmin(),
            'flash' => $this->getFlash()
        ]);

        $this->view('thongke/index', $data);
    }

    /**
     * Export statistics to Excel-compatible file.
     */
    public function exportExcel() {
        if (!$this->isLoggedIn()) {
            $this->setFlash('warning', 'Please login to access the dashboard.');
            $this->redirect('index.php?controller=auth&action=login');
            return;
        }

        $stats = $this->getStatisticsData();

        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="statistics-report-' . date('Ymd-His') . '.xls"');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF";

        require __DIR__ . '/../views/thongke/export_excel.php';
        exit;
    }

    /**
     * Export statistics to a print-ready page for saving as PDF.
     */
    public function exportPdf() {
        if (!$this->isLoggedIn()) {
            $this->setFlash('warning', 'Please login to access the dashboard.');
            $this->redirect('index.php?controller=auth&action=login');
            return;
        }

        $stats = $this->getStatisticsData();

        require __DIR__ . '/../views/thongke/export_pdf.php';
        exit;
    }

    private function getStatisticsData() {
        $totalUsers = $this->userModel->count();
        $activeUsers = $this->userModel->countByStatus('active');
        $inactiveUsers = $this->userModel->countByStatus('inactive');

        $totalCheckouts = $this->checkoutModel->count();
        $totalRevenue = $this->checkoutModel->getTotalPayments();
        $completedPayments = $this->checkoutModel->countByPaymentStatus('Completed');
        $pendingPayments = $this->checkoutModel->countByPaymentStatus('Pending');
        $failedPayments = $this->checkoutModel->countByPaymentStatus('Failed');

        $userMonthlyData = $this->getUserMonthlyStats();
        $checkoutMonthlyData = $this->getCheckoutMonthlyStats();

        return [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'totalCheckouts' => $totalCheckouts,
            'totalRevenue' => $totalRevenue,
            'completedPayments' => $completedPayments,
            'pendingPayments' => $pendingPayments,
            'failedPayments' => $failedPayments,
            'userMonthlyData' => $userMonthlyData,
            'checkoutMonthlyData' => $checkoutMonthlyData
        ];
    }

    /**
     * Get monthly user registration stats
     */
    private function getUserMonthlyStats() {
        $months = [];
        $counts = [];
        $monthKeys = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = date('Y-m', strtotime("-{$i} months"));
            $monthKeys[] = $date;
            $months[] = date('M Y', strtotime("-$i months"));
            $counts[] = 0;
        }

        try {
            $dateColumn = $this->resolveDateColumn('Users', ['createdDate', 'createdAt', 'created_at', 'timestamp']);
            if ($dateColumn) {
                $sql = "SELECT DATE_FORMAT({$dateColumn}, '%Y-%m') AS ym, COUNT(*) AS total
                        FROM Users
                        WHERE {$dateColumn} IS NOT NULL
                          AND {$dateColumn} >= DATE_SUB(CURDATE(), INTERVAL 5 MONTH)
                        GROUP BY ym";
                $stmt = $this->userModel->query($sql);
                $rows = $stmt->fetchAll();
                foreach ($rows as $row) {
                    $ym = $row['ym'] ?? '';
                    $idx = array_search($ym, $monthKeys, true);
                    if ($idx !== false) {
                        $counts[$idx] = (int) ($row['total'] ?? 0);
                    }
                }
            }
        } catch (Exception $e) {
            // keep default zeros
        }

        return ['labels' => $months, 'data' => $counts];
    }

    /**
     * Get monthly checkout/revenue stats
     */
    private function getCheckoutMonthlyStats() {
        $months = [];
        $amounts = [];
        $counts = [];
        $monthKeys = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = date('Y-m', strtotime("-{$i} months"));
            $monthKeys[] = $date;
            $months[] = date('M Y', strtotime("-$i months"));
            $amounts[] = 0;
            $counts[] = 0;
        }

        try {
            $dateColumn = $this->resolveDateColumn('Checkout', ['paymentDate', 'paidAt', 'createdDate', 'createdAt', 'created_at']);
            if ($dateColumn) {
                // Doanh thu ưu tiên trạng thái completed/paid/success; số giao dịch lấy tổng để luôn thấy cột mốc.
                $sql = "SELECT DATE_FORMAT({$dateColumn}, '%Y-%m') AS ym,
                               COUNT(*) AS txCount,
                               COALESCE(SUM(CASE
                                   WHEN LOWER(COALESCE(paymentStatus, '')) IN ('completed','paid','success')
                                   THEN amount
                                   ELSE 0
                               END), 0) AS completedAmount
                        FROM Checkout
                        WHERE {$dateColumn} IS NOT NULL
                          AND {$dateColumn} >= DATE_SUB(CURDATE(), INTERVAL 5 MONTH)
                        GROUP BY ym";
                $stmt = $this->checkoutModel->query($sql);
                $rows = $stmt->fetchAll();
                foreach ($rows as $row) {
                    $ym = $row['ym'] ?? '';
                    $idx = array_search($ym, $monthKeys, true);
                    if ($idx !== false) {
                        $counts[$idx] = (int) ($row['txCount'] ?? 0);
                        $amounts[$idx] = (float) ($row['completedAmount'] ?? 0);
                    }
                }
            }
        } catch (Exception $e) {
            // keep default zeros
        }

        return ['labels' => $months, 'amounts' => $amounts, 'counts' => $counts];
    }

    private function resolveDateColumn($table, array $candidates) {
        foreach ($candidates as $column) {
            try {
                $stmt = $this->checkoutModel->query("SHOW COLUMNS FROM {$table} LIKE :column", ['column' => $column]);
                if ($stmt->fetch()) {
                    return $column;
                }
            } catch (Exception $e) {
                continue;
            }
        }
        return null;
    }
}
