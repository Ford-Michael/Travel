<?php
/**
 * Shell chung: hero (continent-style) + mosaic highlights + lưới tour DB + CTA.
 * Biến: $meta, $tours, $totalTours, $page, $totalPages, $miceDelegationSlug
 */

$headExtra = ($headExtra ?? '') . <<<'HTML'
<style>
.tour-grid-kd{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:2rem;}
</style>
HTML;

?>
<main class="bg-background pt-24">
    <section class="relative min-h-[72vh] overflow-hidden">
        <div class="absolute inset-0">
            <img src="<?php echo htmlspecialchars((string) ($meta['heroImage'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars((string) ($meta['h1Plain'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-[#001945]/85 via-[#001945]/55 to-transparent"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 text-white">
            <nav class="flex items-center gap-2 text-white/65 text-xs sm:text-sm mb-6 uppercase tracking-[0.12em]">
                <a href="index.php?controller=home" class="hover:text-white transition-colors">Trang chủ</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <a href="index.php?controller=tour&action=mice-delegation&type=<?php echo urlencode((string) ($meta['slug'] ?? '')); ?>" class="hover:text-white transition-colors">Tour khách đoàn</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-white font-bold"><?php echo htmlspecialchars((string) ($meta['breadcrumb'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span>
            </nav>
            <span class="text-[#ff645a] font-bold tracking-[0.26em] uppercase text-xs sm:text-sm"><?php echo htmlspecialchars((string) ($meta['eyebrow'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span>
            <h1 class="mt-5 font-headline text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[0.95] tracking-tight whitespace-pre-line">
                <?php echo nl2br(htmlspecialchars((string) ($meta['title'] ?? ''), ENT_QUOTES, 'UTF-8')); ?>
            </h1>
            <p class="mt-6 text-base sm:text-lg leading-8 text-white/80 max-w-2xl">
                <?php echo htmlspecialchars((string) ($meta['subtitle'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
            </p>
            <div class="mt-10 flex flex-wrap gap-4">
                <a href="#khach-doan-tours" class="rounded-full bg-[#ff645a] px-6 py-3 text-sm font-bold text-white transition hover:brightness-110">Chọn tour gợi ý</a>
                <a href="index.php?controller=home&action=contact" class="rounded-full border border-white/30 px-6 py-3 text-sm font-bold text-white transition hover:bg-white/10">Báo giá đoàn</a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 mb-12">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-[#ff645a] font-bold">Điểm nhấn khách đoàn</p>
                    <h2 class="mt-3 font-headline text-3xl sm:text-4xl font-extrabold text-on-secondary-fixed">Định hình hành trình cho <?php echo htmlspecialchars((string) ($meta['name'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></h2>
                </div>
                <div class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm">
                    <?php echo (int) ($totalTours ?? 0); ?> tour khớp từ khóa
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-12 md:auto-rows-[260px]">
                <?php foreach (($meta['highlights'] ?? []) as $index => $item): ?>
                    <?php
                    $spanClass = $index === 0 || $index === 3 ? 'md:col-span-7' : 'md:col-span-5';
                    ?>
                    <article class="<?php echo $spanClass; ?> group relative overflow-hidden rounded-[28px]">
                        <img src="<?php echo htmlspecialchars((string) ($item['image'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars((string) ($item['name'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute left-6 right-6 bottom-6 text-white">
                            <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] backdrop-blur-sm">
                                <?php echo htmlspecialchars((string) ($meta['name'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                            <h3 class="mt-4 font-headline text-2xl sm:text-3xl font-extrabold"><?php echo htmlspecialchars((string) ($item['name'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="mt-3 text-sm leading-6 text-white/85"><?php echo htmlspecialchars((string) ($item['note'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="khach-doan-tours" class="py-20 bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-[#ff645a] font-bold">Tour từ dữ liệu</p>
                    <h2 class="mt-3 font-headline text-3xl sm:text-4xl font-extrabold text-on-secondary-fixed">Hành trình được gợi ý cho đoàn</h2>
                </div>
                <form method="get" action="index.php" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <input type="hidden" name="controller" value="tour">
                    <input type="hidden" name="action" value="search">
                    <input type="text" name="q" placeholder="Tìm trong toàn hệ tour..." class="min-w-[200px] rounded-full border border-slate-200 px-5 py-3 text-sm outline-none focus:border-[#2b5bb5]" />
                    <button type="submit" class="rounded-full bg-[#00337c] px-5 py-3 text-sm font-bold text-white">Tìm tour</button>
                </form>
            </div>

            <?php include __DIR__ . '/_kd_tours_grid.php'; ?>
        </div>
    </section>

    <section class="pb-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-[32px] bg-gradient-to-br from-[#2b5bb5] to-[#00337c] px-8 py-14 sm:px-12 sm:py-16 text-white">
                <div class="max-w-3xl">
                    <h2 class="font-headline text-3xl sm:text-4xl font-extrabold leading-tight"><?php echo htmlspecialchars((string) ($meta['ctaTitle'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></h2>
                    <p class="mt-5 text-white/80 leading-8">
                        Travel Bling thiết kế lịch trình chi tiết — booking khách sạn, xe và hướng dẫn — phù hợp SLA đoàn công ty, trường học và hội nhóm.
                    </p>
                    <div class="mt-9 flex flex-wrap gap-4">
                        <a href="index.php?controller=home&action=contact" class="rounded-full bg-white px-6 py-3 text-sm font-bold text-[#00337c] transition hover:bg-white/90">
                            Nhận báo giá
                        </a>
                        <a href="index.php?controller=tour&action=domestic" class="rounded-full border border-white/30 px-6 py-3 text-sm font-bold text-white transition hover:bg-white/10">
                            Xem du lịch trong nước
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
