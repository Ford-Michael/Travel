<?php
/**
 * Tour khách đoàn — lưới tour (pattern tours_in_country) + phân trang miceDelegation.
 *
 * Variables: $tours, $totalTours, $page, $totalPages, $meta, $miceDelegationSlug
 */

if (!function_exists('kdToursPriceText')) {
    function kdToursPriceText($tour) {
        $p = (float) ($tour['priceAdult'] ?? $tour['price'] ?? 0);
        return $p > 0 ? number_format($p, 0, ',', '.') . ' đ' : 'Liên hệ';
    }
}

$kdType = htmlspecialchars((string) ($miceDelegationSlug ?? ''), ENT_QUOTES, 'UTF-8');
$pageNum = max(1, (int) ($page ?? 1));
$tp = max(1, (int) ($totalPages ?? 1));

?>

<?php if (empty($tours)): ?>
    <div class="rounded-xl border-2 border-dashed border-outline-variant/30 bg-surface-container-lowest px-8 py-16 text-center">
        <span class="material-symbols-outlined text-6xl text-outline-variant mb-4 block">groups</span>
        <p class="text-on-surface-variant text-lg font-medium">
            Chưa có tour được gán nhãn trong hệ thống cho "<?php echo htmlspecialchars($meta['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>".
        </p>
        <p class="mt-4 text-sm text-outline max-w-xl mx-auto">
            Gắn từ khóa vào tiêu đề / mô tả tour trong CMS hoặc liên hệ để được thiết kế báo giá đoàn riêng.
        </p>
        <a href="index.php?controller=home&action=contact"
           class="mt-6 inline-block rounded-md bg-secondary px-6 py-3 text-sm font-bold text-white hover:bg-on-secondary-fixed transition-colors">
            Liên hệ tư vấn đoàn
        </a>
    </div>
<?php else: ?>
    <div class="tour-grid-kd">
        <?php foreach ($tours as $tour): ?>
            <?php
            $imgSrc = !empty($tour['heroImage'])
                ? htmlspecialchars((string) $tour['heroImage'], ENT_QUOTES, 'UTF-8')
                : (!empty($tour['image'])
                    ? '/travel.bling/img/tours/' . htmlspecialchars((string) $tour['image'], ENT_QUOTES, 'UTF-8')
                    : 'https://images.unsplash.com/photo-1549646871-ebdd8a65fbbc?auto=format&fit=crop&w=1200&q=80');
            $name    = htmlspecialchars((string) ($tour['tour_name'] ?? 'Tour'), ENT_QUOTES, 'UTF-8');
            $dest    = htmlspecialchars((string) ($tour['destination'] ?? ''), ENT_QUOTES, 'UTF-8');
            $dur     = htmlspecialchars((string) ($tour['duration'] ?? ''), ENT_QUOTES, 'UTF-8');
            $price   = kdToursPriceText($tour);
            $id      = (int) ($tour['tourID'] ?? 0);
            ?>
            <a href="index.php?controller=tour&action=detail&id=<?php echo $id; ?>" class="group bg-surface-container-lowest rounded-xl overflow-hidden hover:shadow-[0px_12px_32px_rgba(25,28,29,0.06)] transition-all duration-500 block">
                <div class="relative h-64 overflow-hidden">
                    <img src="<?php echo $imgSrc; ?>" alt="<?php echo $name; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                    <?php if (!empty($tour['is_featured'])): ?>
                        <div class="absolute top-4 left-4 bg-on-primary-container/90 backdrop-blur-md px-3 py-1.5 rounded-full text-[10px] font-bold text-white uppercase tracking-widest">Featured</div>
                    <?php endif; ?>
                </div>
                <div class="p-6 space-y-4 flex flex-col h-[calc(100%-16rem)]">
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-[11px] font-bold text-secondary uppercase tracking-wider">
                        <?php if ($dur): ?>
                            <span class="flex items-center"><span class="material-symbols-outlined text-sm mr-1">schedule</span> <?php echo $dur; ?></span>
                        <?php endif; ?>
                        <?php if ($dest): ?>
                            <span class="flex items-center"><span class="material-symbols-outlined text-sm mr-1">location_on</span> <?php echo $dest; ?></span>
                        <?php endif; ?>
                    </div>
                    <h3 class="font-headline text-xl font-bold text-on-secondary-fixed leading-tight flex-1">
                        <?php echo $name; ?>
                    </h3>
                    <div class="flex items-center justify-between pt-4 border-t border-outline-variant/20 mt-auto">
                        <div>
                            <span class="block text-[10px] text-outline font-bold uppercase mb-1">Giá từ</span>
                            <span class="text-xl font-bold text-on-primary-container tracking-tight"><?php echo htmlspecialchars($price, ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <span class="p-3 bg-surface-container-low group-hover:bg-on-primary-container group-hover:text-white rounded-lg transition-all inline-flex">
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if ($tp > 1): ?>
        <div class="mt-20 flex justify-center">
            <div class="flex flex-col items-center space-y-6">
                <div class="w-64 h-1 bg-outline-variant/20 rounded-full relative overflow-hidden">
                    <div class="absolute left-0 top-0 h-full bg-on-primary-container" style="width: <?php echo min(100, round(($pageNum / $tp) * 100)); ?>%"></div>
                </div>
                <p class="text-xs font-bold text-outline uppercase tracking-widest">
                    Trang <?php echo $pageNum; ?> / <?php echo $tp; ?>
                </p>
                <div class="flex flex-wrap gap-2 justify-center max-w-xl">
                    <?php for ($p = 1; $p <= $tp; $p++): ?>
                        <a href="index.php?controller=tour&action=mice-delegation&amp;type=<?php echo urlencode($kdType); ?>&amp;page=<?php echo $p; ?>"
                           class="w-10 h-10 rounded-md flex items-center justify-center font-bold transition-all <?php echo $p === $pageNum ? 'bg-secondary text-white' : 'bg-surface-container-lowest text-on-secondary-fixed border border-outline-variant/30 hover:border-secondary hover:text-secondary'; ?>">
                            <?php echo $p; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>
