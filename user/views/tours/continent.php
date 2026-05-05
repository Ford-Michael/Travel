<?php
if (!function_exists('continentPriceText')) {
    function continentPriceText($tour) {
        return number_format((float) ($tour['priceAdult'] ?? $tour['price'] ?? 0), 0, ',', '.') . ' đ';
    }
}
?>

<main class="bg-background">
    <section class="relative min-h-[78vh] overflow-hidden">
        <div class="absolute inset-0">
            <img src="<?php echo htmlspecialchars($meta['heroImage']); ?>" alt="<?php echo htmlspecialchars($meta['name']); ?>" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-[#001945]/85 via-[#001945]/55 to-transparent"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32 text-white">
            <div class="max-w-3xl">
                <span class="text-[#ff645a] font-bold tracking-[0.26em] uppercase text-sm"><?php echo htmlspecialchars($meta['eyebrow']); ?></span>
                <h1 class="mt-5 font-headline text-5xl sm:text-6xl lg:text-7xl font-extrabold leading-[0.92] tracking-tight">
                    <?php echo htmlspecialchars($meta['title']); ?>
                </h1>
                <p class="mt-6 text-base sm:text-lg leading-8 text-white/80 max-w-2xl">
                    <?php echo htmlspecialchars($meta['subtitle']); ?>
                </p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="#continent-tours" class="rounded-full bg-[#ff645a] px-6 py-3 text-sm font-bold text-white transition hover:brightness-110">Khám phá tour</a>
                    <a href="index.php?controller=tour" class="rounded-full border border-white/30 px-6 py-3 text-sm font-bold text-white transition hover:bg-white/10">Tất cả tour</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 mb-12">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-[#ff645a] font-bold">Điểm đến biểu tượng</p>
                    <h2 class="mt-3 font-headline text-4xl font-extrabold text-on-secondary-fixed">Từng góc nhìn của <?php echo htmlspecialchars($meta['name']); ?></h2>
                </div>
                <div class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm">
                    <?php echo (int) ($totalTours ?? 0); ?> tour hiện có
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-12 md:auto-rows-[260px]">
                <?php foreach (($meta['highlights'] ?? []) as $index => $item): ?>
                    <?php
                    $spanClass = $index === 0 || $index === 3 ? 'md:col-span-7' : 'md:col-span-5';
                    if ($index === 2) {
                        $spanClass = 'md:col-span-5';
                    }
                    ?>
                    <article class="<?php echo $spanClass; ?> group relative overflow-hidden rounded-[28px]">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute left-6 right-6 bottom-6 text-white">
                            <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] backdrop-blur-sm">
                                <?php echo htmlspecialchars($meta['name']); ?>
                            </span>
                            <h3 class="mt-4 font-headline text-3xl font-extrabold"><?php echo htmlspecialchars($item['name']); ?></h3>
                            <p class="mt-3 text-sm leading-6 text-white/80"><?php echo htmlspecialchars($item['note']); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="continent-tours" class="py-20 bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-[#ff645a] font-bold">Tour tiêu biểu</p>
                    <h2 class="mt-3 font-headline text-4xl font-extrabold text-on-secondary-fixed">Hành trình được đề xuất</h2>
                </div>
                <form method="get" action="index.php" class="flex items-center gap-3">
                    <input type="hidden" name="controller" value="tour">
                    <input type="hidden" name="action" value="search">
                    <input type="text" name="q" placeholder="Tìm tên hành trình..." class="min-w-[220px] rounded-full border border-slate-200 px-5 py-3 text-sm outline-none focus:border-[#2b5bb5]">
                    <button type="submit" class="rounded-full bg-[#00337c] px-5 py-3 text-sm font-bold text-white">Tìm tour</button>
                </form>
            </div>

            <?php if (empty($tours)): ?>
                <div class="rounded-[28px] border border-dashed border-slate-300 bg-white px-8 py-20 text-center text-slate-500">
                    Hiện chưa có tour nào được gắn vào <?php echo htmlspecialchars($meta['name']); ?>.
                </div>
            <?php else: ?>
                <div class="space-y-10">
                    <?php foreach ($tours as $index => $tour): ?>
                        <article class="group rounded-[28px] bg-white p-6 sm:p-8 shadow-sm transition hover:shadow-xl">
                            <div class="grid gap-8 lg:grid-cols-2 lg:items-center">
                                <div class="<?php echo $index % 2 === 1 ? 'lg:order-2' : ''; ?> overflow-hidden rounded-[24px]">
                                    <img src="<?php echo htmlspecialchars($tour['heroImage']); ?>" alt="<?php echo htmlspecialchars($tour['tour_name']); ?>" class="h-[320px] w-full object-cover transition duration-700 group-hover:scale-105">
                                </div>
                                <div class="<?php echo $index % 2 === 1 ? 'lg:order-1' : ''; ?>">
                                    <div class="text-sm font-bold uppercase tracking-[0.24em] text-[#2b5bb5]">
                                        <?php echo htmlspecialchars($tour['duration'] ?? 'Đang cập nhật'); ?>
                                    </div>
                                    <h3 class="mt-4 font-headline text-4xl font-bold text-on-secondary-fixed">
                                        <?php echo htmlspecialchars($tour['tour_name']); ?>
                                    </h3>
                                    <p class="mt-5 text-base leading-8 text-slate-600">
                                        <?php echo htmlspecialchars($tour['summary'] ?: 'Nội dung tour đang được cập nhật từ hệ thống dữ liệu.'); ?>
                                    </p>
                                    <div class="mt-8 flex flex-wrap items-center gap-5 text-sm text-slate-500">
                                        <span class="inline-flex items-center gap-2">
                                            <span class="material-symbols-outlined text-base text-[#2b5bb5]">location_on</span>
                                            <?php echo htmlspecialchars($tour['destination'] ?? 'Nước ngoài'); ?>
                                        </span>
                                        <span class="inline-flex items-center gap-2">
                                            <span class="material-symbols-outlined text-base text-[#2b5bb5]">hotel</span>
                                            Số chỗ: <?php echo (int) ($tour['quantity'] ?? 0); ?>
                                        </span>
                                    </div>
                                    <div class="mt-9 flex items-center justify-between">
                                        <div>
                                            <div class="text-xs uppercase tracking-[0.22em] text-slate-400">Giá từ</div>
                                            <div class="mt-2 text-3xl font-black text-[#400002]"><?php echo continentPriceText($tour); ?></div>
                                        </div>
                                        <a href="index.php?controller=tour&action=detail&id=<?php echo (int) $tour['tourID']; ?>" class="rounded-full bg-[#ff645a] px-6 py-3 text-sm font-bold text-white transition hover:brightness-110">
                                            Chi tiết tour
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-[32px] bg-gradient-to-br from-[#2b5bb5] to-[#00337c] px-8 py-14 sm:px-12 sm:py-16 text-white">
                <div class="max-w-3xl">
                    <h2 class="font-headline text-4xl font-extrabold leading-tight"><?php echo htmlspecialchars($meta['ctaTitle']); ?></h2>
                    <p class="mt-5 text-white/80 leading-8">
                        Tư vấn viên của Travel Bling sẽ giúp bạn chọn lịch trình, mức giá, nhóm khách và những điểm đến phù hợp nhất với phong cách du lịch của bạn.
                    </p>
                    <div class="mt-9 flex flex-wrap gap-4">
                        <a href="index.php?controller=home&action=contact" class="rounded-full bg-white px-6 py-3 text-sm font-bold text-[#00337c] transition hover:bg-white/90">
                            Tư vấn miễn phí
                        </a>
                        <a href="index.php?controller=tour" class="rounded-full border border-white/30 px-6 py-3 text-sm font-bold text-white transition hover:bg-white/10">
                            Quay lại trang tour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
