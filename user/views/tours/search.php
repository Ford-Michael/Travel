<?php
if (!function_exists('searchTourPrice')) {
    function searchTourPrice($tour) {
        return number_format((float) ($tour['priceAdult'] ?? $tour['price'] ?? 0), 0, ',', '.') . ' đ';
    }
}
?>

<main class="bg-background min-h-screen py-16">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.24em] text-[#ff645a] font-bold">Search result</p>
                <h1 class="mt-3 font-headline text-4xl sm:text-5xl font-extrabold text-on-secondary-fixed">
                    Tim tour: "<?php echo htmlspecialchars($keyword); ?>"
                </h1>
                <p class="mt-4 text-slate-500">Ket qua duoc truy van tu bang tour va hien thi theo giao dien user moi.</p>
            </div>
            <form method="get" action="index.php" class="flex items-center gap-3">
                <input type="hidden" name="controller" value="tour">
                <input type="hidden" name="action" value="search">
                <input type="text" name="q" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Tim lai..." class="min-w-[240px] rounded-full border border-slate-200 px-5 py-3 text-sm outline-none focus:border-[#2b5bb5]">
                <button type="submit" class="rounded-full bg-[#00337c] px-5 py-3 text-sm font-bold text-white">Tim</button>
            </form>
        </div>

        <?php if (empty($tours)): ?>
            <div class="rounded-[28px] border border-dashed border-slate-300 bg-white px-8 py-20 text-center text-slate-500">
                Khong tim thay tour phu hop voi tu khoa nay.
            </div>
        <?php else: ?>
            <div class="grid gap-8 lg:grid-cols-3">
                <?php foreach ($tours as $tour): ?>
                    <article class="overflow-hidden rounded-[28px] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="h-72 overflow-hidden">
                            <img src="<?php echo htmlspecialchars($tour['heroImage']); ?>" alt="<?php echo htmlspecialchars($tour['tour_name']); ?>" class="h-full w-full object-cover">
                        </div>
                        <div class="p-7">
                            <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                <?php echo htmlspecialchars($tour['continentLabel'] ?? 'Tour'); ?>
                            </div>
                            <h2 class="mt-4 font-headline text-2xl font-bold text-slate-900 line-clamp-2">
                                <?php echo htmlspecialchars($tour['tour_name']); ?>
                            </h2>
                            <p class="mt-4 line-clamp-3 text-sm leading-7 text-slate-600">
                                <?php echo htmlspecialchars($tour['summary'] ?: 'Noi dung tour dang duoc cap nhat.'); ?>
                            </p>
                            <div class="mt-8 flex items-center justify-between border-t border-slate-100 pt-6">
                                <div>
                                    <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Gia tu</div>
                                    <div class="mt-2 text-2xl font-black text-[#ff645a]"><?php echo searchTourPrice($tour); ?></div>
                                </div>
                                <a href="index.php?controller=tour&action=detail&id=<?php echo (int) $tour['tourID']; ?>" class="rounded-full bg-[#2b5bb5] px-5 py-3 text-sm font-bold text-white">
                                    Chi tiet
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>
