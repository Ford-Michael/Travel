<?php
/**
 * Partial: DB Tours Grid
 * Included by each tour-chau-*.php continent page.
 *
 * Expected variables (passed from TourController::continent()):
 *   $tours      – array of tour rows from DB
 *   $totalTours – int
 *   $page       – int current page
 *   $totalPages – int
 *   $meta       – array with continent metadata
 *   $region     – string continent slug
 *
 * Helper (declared in continent.php or here):
 */
if (!function_exists('continentPriceText')) {
    function continentPriceText($tour) {
        $p = (float) ($tour['priceAdult'] ?? $tour['price'] ?? 0);
        return $p > 0 ? number_format($p, 0, ',', '.') . ' đ' : 'Liên hệ';
    }
}
?>

<!-- ================================================================
     SECTION: TOUR TỪ DATABASE
================================================================ -->
<section id="db-tours" class="py-20 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-[#ff645a] font-bold">Tour thực tế</p>
                <h2 class="mt-3 font-headline text-4xl font-extrabold text-on-secondary-fixed">
                    Hành trình <?php echo htmlspecialchars($meta['name'] ?? 'Nước Ngoài'); ?>
                </h2>
            </div>
            <div class="flex items-center gap-4">
                <div class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm">
                    <?php echo (int) ($totalTours ?? 0); ?> tour hiện có
                </div>
                <!-- Search mini -->
                <form method="get" action="index.php" class="flex items-center gap-2">
                    <input type="hidden" name="controller" value="tour">
                    <input type="hidden" name="action" value="search">
                    <input type="text" name="q"
                           placeholder="Tìm tour..."
                           class="rounded-full border border-slate-200 px-4 py-2.5 text-sm outline-none focus:border-[#2b5bb5] w-44">
                    <button type="submit"
                            class="rounded-full bg-[#00337c] px-4 py-2.5 text-sm font-bold text-white hover:bg-[#2b5bb5] transition-colors">
                        Tìm
                    </button>
                </form>
            </div>
        </div>

        <?php if (empty($tours)): ?>
            <!-- Empty state -->
            <div class="rounded-[28px] border-2 border-dashed border-slate-200 bg-white px-8 py-24 text-center">
                <span class="material-symbols-outlined text-6xl text-slate-300 mb-4 block">travel_explore</span>
                <p class="text-slate-500 text-lg font-medium">
                    Chưa có tour nào cho <?php echo htmlspecialchars($meta['name'] ?? 'khu vực này'); ?>.
                </p>
                <a href="index.php?controller=home&action=contact"
                   class="mt-6 inline-block rounded-full bg-[#ff645a] px-6 py-3 text-sm font-bold text-white hover:brightness-110 transition">
                    Liên hệ để đặt tour theo yêu cầu
                </a>
            </div>

        <?php else: ?>
            <!-- Tour Cards Grid -->
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
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
                    $price   = continentPriceText($tour);
                    $id      = (int) ($tour['tourID'] ?? 0);
                    ?>
                    <a href="index.php?controller=tour&action=detail&id=<?php echo $id; ?>"
                       class="group bg-white rounded-[24px] overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">
                        <!-- Image -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="<?php echo $imgSrc; ?>"
                                 alt="<?php echo $name; ?>"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <?php if (!empty($tour['is_featured'])): ?>
                                <div class="absolute top-4 left-4 bg-[#ff645a] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">
                                    Nổi bật
                                </div>
                            <?php endif; ?>
                            <?php if ($dest): ?>
                                <div class="absolute bottom-4 left-4 bg-black/40 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full">
                                    <span class="material-symbols-outlined text-xs align-middle mr-1">location_on</span><?php echo $dest; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- Body -->
                        <div class="p-6 flex flex-col flex-1">
                            <!-- Duration badge -->
                            <?php if ($dur): ?>
                                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#2b5bb5] mb-2"><?php echo $dur; ?></span>
                            <?php endif; ?>
                            <h3 class="font-headline text-lg font-bold text-on-secondary-fixed mb-2 line-clamp-2 group-hover:text-[#2b5bb5] transition-colors">
                                <?php echo $name; ?>
                            </h3>
                            <?php if ($summary): ?>
                                <p class="text-sm text-slate-500 leading-relaxed line-clamp-2 mb-4 flex-1">
                                    <?php echo $summary; ?>
                                </p>
                            <?php else: ?>
                                <div class="flex-1"></div>
                            <?php endif; ?>
                            <!-- Meta + Price -->
                            <div class="flex items-center gap-4 text-xs text-slate-400 mb-4">
                                <?php if ($qty > 0): ?>
                                    <span class="inline-flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">group</span>
                                        <?php echo $qty; ?> chỗ
                                    </span>
                                <?php endif; ?>
                                <?php if (!empty($tour['departure_date'])): ?>
                                    <span class="inline-flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">calendar_today</span>
                                        <?php echo date('d/m/Y', strtotime($tour['departure_date'])); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <!-- Price + CTA -->
                            <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                                <div>
                                    <div class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">Giá từ</div>
                                    <div class="text-xl font-black text-[#400002]"><?php echo $price; ?></div>
                                </div>
                                <span class="w-10 h-10 rounded-full bg-[#2b5bb5] group-hover:bg-[#ff645a] transition-colors flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white text-base">arrow_forward</span>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if (($totalPages ?? 1) > 1): ?>
                <div class="mt-16 flex justify-center gap-2 flex-wrap">
                    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                        <?php $active = $p === (int) ($page ?? 1); ?>
                        <a href="index.php?controller=tour&action=continent&region=<?php echo urlencode($region ?? ''); ?>&page=<?php echo $p; ?>#db-tours"
                           class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all
                                  <?php echo $active
                                      ? 'bg-[#2b5bb5] text-white shadow-lg'
                                      : 'bg-white text-slate-600 border border-slate-200 hover:border-[#2b5bb5] hover:text-[#2b5bb5]'; ?>">
                            <?php echo $p; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- CTA bottom -->
        <div class="mt-16 text-center">
            <a href="index.php?controller=home&action=contact"
               class="inline-flex items-center gap-2 rounded-full border-2 border-[#2b5bb5] px-8 py-3 text-sm font-bold text-[#2b5bb5] hover:bg-[#2b5bb5] hover:text-white transition-all">
                <span class="material-symbols-outlined text-sm">support_agent</span>
                Tư vấn hành trình miễn phí
            </a>
        </div>

    </div>
</section>
