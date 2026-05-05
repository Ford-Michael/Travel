<?php
/**
 * Partial: Domestic Tours Grid
 * Included by domestic region pages (e.g., tour_mien-trung.php).
 *
 * Expected variables (passed from TourController::domesticRegion()):
 *   $tours      – array of tour rows from DB
 *   $totalTours – int
 *   $page       – int current page
 *   $totalPages – int
 *   $meta       – array with region metadata
 *   $region     – string region slug
 */

if (!function_exists('domesticPriceText')) {
    function domesticPriceText($tour) {
        $p = (float) ($tour['priceAdult'] ?? $tour['price'] ?? 0);
        return $p > 0 ? number_format($p, 0, ',', '.') . ' đ' : 'Liên hệ';
    }
}
?>

<?php if (empty($tours)): ?>
    <!-- Empty state -->
    <div class="rounded-xl border-2 border-dashed border-outline-variant/30 bg-surface-container-lowest px-8 py-16 text-center">
        <span class="material-symbols-outlined text-6xl text-outline-variant mb-4 block">travel_explore</span>
        <p class="text-on-surface-variant text-lg font-medium">
            Chưa có tour nào cho <?php echo htmlspecialchars($meta['name'] ?? 'khu vực này'); ?>.
        </p>
        <a href="index.php?controller=home&action=contact"
           class="mt-6 inline-block rounded-md bg-secondary px-6 py-3 text-sm font-bold text-white hover:bg-on-secondary-fixed transition-colors">
            Liên hệ để thiết kế tour riêng
        </a>
    </div>
<?php else: ?>
    <!-- Tour Cards Grid -->
    <div class="tour-grid">
        <?php foreach ($tours as $tour): ?>
            <?php
            $imgSrc = !empty($tour['heroImage'])
                ? htmlspecialchars($tour['heroImage'])
                : (!empty($tour['image'])
                    ? '/travel.bling/img/tours/' . htmlspecialchars($tour['image'])
                    : 'https://lh3.googleusercontent.com/aida-public/AB6AXuCxVL_52rYKiR0uTxFM8CgUbwixbPLC_WVf04R5_-RpbWOJ3dt7r--bqCueCSOva8hgie2rYFkY5aFc1tkL96HZgwmw9y0AZV2plcHup8pFbWvZBIEys6jjHl8JZ3te47cCLaI0aCqh60uFNDELoBCs0unC1_RmupFrIiNIYpcN8AS_IBtteNLoef_oXPTmUw5M2xGZX72665XsrLXq5dT7OUeJbu6Zf8L5jFFDKei2ydl9kOihUfQ2_fQQTr8RYhobU86LEx2HuspK');
            $name    = htmlspecialchars($tour['tour_name'] ?? 'Tour');
            $dest    = htmlspecialchars($tour['destination'] ?? '');
            $dur     = htmlspecialchars($tour['duration'] ?? '');
            $qty     = (int) ($tour['quantity'] ?? 0);
            $summary = htmlspecialchars($tour['summary'] ?? $tour['description'] ?? '');
            $price   = domesticPriceText($tour);
            $id      = (int) ($tour['tourID'] ?? 0);
            ?>
            <a href="index.php?controller=tour&action=detail&id=<?php echo $id; ?>" class="group bg-surface-container-lowest rounded-xl overflow-hidden hover:shadow-[0px_12px_32px_rgba(25,28,29,0.06)] transition-all duration-500 block">
                <div class="relative h-64 overflow-hidden">
                    <img src="<?php echo $imgSrc; ?>" alt="<?php echo $name; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                    <?php if (!empty($tour['is_featured'])): ?>
                        <div class="absolute top-4 left-4 bg-on-primary-container/90 backdrop-blur-md px-3 py-1.5 rounded-full text-[10px] font-bold text-white uppercase tracking-widest">Featured</div>
                    <?php endif; ?>
                    <button type="button" class="absolute top-4 right-4 bg-white/20 hover:bg-white/40 backdrop-blur-md w-8 h-8 rounded-full flex items-center justify-center text-white transition-colors">
                        <span class="material-symbols-outlined text-lg">favorite</span>
                    </button>
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
                            <span class="text-xl font-bold text-on-primary-container tracking-tight"><?php echo $price; ?></span>
                        </div>
                        <span class="p-3 bg-surface-container-low group-hover:bg-on-primary-container group-hover:text-white rounded-lg transition-all inline-flex">
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <?php if (($totalPages ?? 1) > 1): ?>
        <div class="mt-20 flex justify-center">
            <div class="flex flex-col items-center space-y-6">
                <!-- Decorative Progress Line -->
                <div class="w-64 h-1 bg-outline-variant/20 rounded-full relative overflow-hidden">
                    <div class="absolute left-0 top-0 h-full bg-on-primary-container" style="width: <?php echo min(100, round((($page ?? 1) / $totalPages) * 100)); ?>%"></div>
                </div>
                <p class="text-xs font-bold text-outline uppercase tracking-widest">
                    Trang <?php echo $page; ?> / <?php echo $totalPages; ?>
                </p>
                
                <div class="flex gap-2">
                    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                        <a href="index.php?controller=tour&action=domesticRegion&region=<?php echo urlencode($region ?? ''); ?>&page=<?php echo $p; ?>"
                           class="w-10 h-10 rounded-md flex items-center justify-center font-bold transition-all <?php echo $p === (int)($page ?? 1) ? 'bg-secondary text-white' : 'bg-surface-container-lowest text-on-secondary-fixed border border-outline-variant/30 hover:border-secondary hover:text-secondary'; ?>">
                            <?php echo $p; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>
