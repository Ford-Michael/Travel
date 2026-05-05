<?php
if (!function_exists('tourPriceText')) {
    function tourPriceText($tour) {
        return number_format((float) ($tour['priceAdult'] ?? $tour['price'] ?? 0), 0, ',', '.') . ' đ';
    }
}
?>

<main class="bg-background">
    <style>
        .foreign-slideshow { position: relative; min-height: 78vh; overflow: hidden; }
        .foreign-slideshow .fslide {
            position: absolute; inset: 0; opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }
        .foreign-slideshow .fslide.active { opacity: 1; }
        .foreign-slideshow .fslide img {
            width: 100%; height: 100%; object-fit: cover;
            animation: foreignKenBurns 20s ease-in-out infinite alternate;
        }
        @keyframes foreignKenBurns {
            0%   { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.08) translate(-0.5%, -0.5%); }
        }
        .foreign-slideshow .fslide-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 50%);
        }
        .foreign-dots { display: flex; gap: 8px; margin-top: 24px; }
        .foreign-dots button {
            width: 10px; height: 10px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.5);
            background: transparent; cursor: pointer; transition: all 0.3s; padding: 0;
        }
        .foreign-dots button.active {
            background: #ff645a; border-color: #ff645a; transform: scale(1.3);
        }
        .foreign-progress {
            position: absolute; bottom: 0; left: 0; height: 3px;
            background: linear-gradient(90deg, #2b5bb5, #ff645a);
            transition: width 0.3s linear; z-index: 25;
        }
    </style>

    <?php
    $foreignSlides = [
        '/travel.bling/img/TOUR NƯỚC NGOÀI/CHÂU Á/NHATBAN/UFGVM.jpg',
        '/travel.bling/img/TOUR NƯỚC NGOÀI/CHÂU Á/NHATBAN/sLPs1.jpg',
        '/travel.bling/img/TOUR NƯỚC NGOÀI/CHÂU Á/HANQUOC/7fXRQ.jpg',
        '/travel.bling/img/TOUR NƯỚC NGOÀI/CHÂU Á/HANQUOC/Jw2F3.jpg',
        '/travel.bling/img/TOUR NƯỚC NGOÀI/CHÂU Á/THAILAND/d8JTN.jpg',
        '/travel.bling/img/TOUR NƯỚC NGOÀI/CHÂU Á/SINGAPORE/XDmzh.jpg',
        '/travel.bling/img/TOUR NƯỚC NGOÀI/CHÂU Á/SINGAPORE/pHyfk.jpg',
        '/travel.bling/img/TOUR NƯỚC NGOÀI/CHÂU Á/CHINA/LzaQQ.jpg',
        '/travel.bling/img/TOUR NƯỚC NGOÀI/CHÂU Á/CHINA/lapF0.jpg',
        '/travel.bling/img/TOUR NƯỚC NGOÀI/CHÂU Á/CHINA/8SNfS.jpg',
    ];
    ?>

    <section class="foreign-slideshow" id="foreignSlideshow">
        <?php foreach ($foreignSlides as $i => $slide): ?>
            <div class="fslide <?php echo $i === 0 ? 'active' : ''; ?>">
                <img src="<?php echo $slide; ?>" alt="Du lịch nước ngoài <?php echo $i + 1; ?>" loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>" />
                <div class="fslide-overlay"></div>
            </div>
        <?php endforeach; ?>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-end pb-12 text-white" style="position:relative;z-index:10;">
            <div class="foreign-dots" id="foreignDots">
                <?php foreach ($foreignSlides as $i => $slide): ?>
                    <button data-slide="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="foreign-progress" id="foreignProgress"></div>
    </section>

    <script>
    (function() {
        const slides = document.querySelectorAll('#foreignSlideshow .fslide');
        const dots = document.querySelectorAll('#foreignDots button');
        const progress = document.getElementById('foreignProgress');
        let current = 0;
        const total = slides.length;
        const interval = 4500;
        let timer, progressTimer;
        let progressWidth = 0;

        function goTo(index) {
            slides[current].classList.remove('active');
            dots[current].classList.remove('active');
            current = (index + total) % total;
            slides[current].classList.add('active');
            dots[current].classList.add('active');
            resetProgress();
        }

        function next() { goTo(current + 1); }

        function resetProgress() {
            progressWidth = 0;
            progress.style.width = '0%';
            clearInterval(progressTimer);
            progressTimer = setInterval(function() {
                progressWidth += 100 / (interval / 30);
                progress.style.width = Math.min(progressWidth, 100) + '%';
            }, 30);
        }

        dots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                clearInterval(timer);
                goTo(parseInt(this.dataset.slide));
                timer = setInterval(next, interval);
            });
        });

        resetProgress();
        timer = setInterval(next, interval);

        var container = document.getElementById('foreignSlideshow');
        container.addEventListener('mouseenter', function() {
            clearInterval(timer); clearInterval(progressTimer);
        });
        container.addEventListener('mouseleave', function() {
            timer = setInterval(next, interval); resetProgress();
        });
    })();
    </script>

    <section class="bg-surface-container-low py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between mb-12">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-[#ff645a] font-bold">Tung Chau</p>
                    <h2 class="mt-3 font-headline text-4xl font-extrabold text-on-secondary-fixed">Danh muc du lich nuoc ngoai</h2>
                </div>
                <div class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm">
                    <?php echo (int) ($totalTours ?? 0); ?> tour nuoc ngoai dang mo ban
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                <?php foreach (($continentCards ?? []) as $card): ?>
                    <a href="index.php?controller=tour&action=continent&region=<?php echo urlencode($card['slug']); ?>" class="group overflow-hidden rounded-[28px] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="relative h-72 overflow-hidden">
                            <img src="<?php echo htmlspecialchars($card['heroImage']); ?>" alt="<?php echo htmlspecialchars($card['name']); ?>" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute left-6 right-6 bottom-6 text-white">
                                <div class="inline-flex rounded-full bg-white/15 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.22em]">
                                    <?php echo htmlspecialchars($card['name']); ?>
                                </div>
                                <h3 class="mt-4 font-headline text-3xl font-extrabold"><?php echo htmlspecialchars($card['title']); ?></h3>
                                <p class="mt-3 text-sm leading-6 text-white/80"><?php echo htmlspecialchars($card['subtitle']); ?></p>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between text-sm text-slate-500">
                                <span><?php echo (int) ($card['count'] ?? 0); ?> tour</span>
                                <span class="font-bold text-[#2b5bb5]">Xem chi tiet</span>
                            </div>
                            <?php if (!empty($card['featured'])): ?>
                                <div class="mt-5 space-y-3">
                                    <?php foreach ($card['featured'] as $tour): ?>
                                        <div class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3">
                                            <img src="<?php echo htmlspecialchars($tour['heroImage']); ?>" alt="<?php echo htmlspecialchars($tour['tour_name']); ?>" class="h-14 w-14 rounded-xl object-cover">
                                            <div class="min-w-0 flex-1">
                                                <div class="truncate text-sm font-bold text-slate-900"><?php echo htmlspecialchars($tour['tour_name']); ?></div>
                                                <div class="text-xs text-slate-500"><?php echo tourPriceText($tour); ?></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="foreign-tours" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-12">
                <div>
                    <p class="text-sm uppercase tracking-[0.24em] text-[#ff645a] font-bold">Featured list</p>
                    <h2 class="mt-3 font-headline text-4xl font-extrabold text-on-secondary-fixed">Tat ca tour nuoc ngoai</h2>
                </div>
                <form method="get" action="index.php" class="flex items-center gap-3">
                    <input type="hidden" name="controller" value="tour">
                    <input type="hidden" name="action" value="search">
                    <input type="text" name="q" placeholder="Tim theo diem den..." class="min-w-[240px] rounded-full border border-slate-200 px-5 py-3 text-sm outline-none focus:border-[#2b5bb5]">
                    <button type="submit" class="rounded-full bg-[#00337c] px-5 py-3 text-sm font-bold text-white">Tim tour</button>
                </form>
            </div>

            <?php if (empty($tours)): ?>
                <div class="rounded-[28px] border border-dashed border-slate-300 px-8 py-20 text-center text-slate-500">
                    Chua co tour nuoc ngoai phu hop de hien thi.
                </div>
            <?php else: ?>
                <div class="grid gap-8 lg:grid-cols-3">
                    <?php foreach ($tours as $tour): ?>
                        <article class="group overflow-hidden rounded-[28px] bg-surface-container-lowest shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                            <div class="relative h-72 overflow-hidden">
                                <img src="<?php echo htmlspecialchars($tour['heroImage']); ?>" alt="<?php echo htmlspecialchars($tour['tour_name']); ?>" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                                <div class="absolute left-5 top-5 rounded-full bg-white/15 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] text-white backdrop-blur-sm">
                                    <?php echo htmlspecialchars($tour['continentLabel'] ?? 'Nuoc ngoai'); ?>
                                </div>
                            </div>
                            <div class="p-7">
                                <div class="flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">
                                    <span><?php echo htmlspecialchars($tour['duration'] ?? 'Dang cap nhat'); ?></span>
                                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                    <span><?php echo htmlspecialchars($tour['destination'] ?? 'Nuoc ngoai'); ?></span>
                                </div>
                                <h3 class="mt-4 font-headline text-2xl font-bold text-slate-900 line-clamp-2">
                                    <?php echo htmlspecialchars($tour['tour_name']); ?>
                                </h3>
                                <p class="mt-4 text-sm leading-7 text-slate-600 line-clamp-3">
                                    <?php echo htmlspecialchars($tour['summary'] ?: 'Tour du lich nuoc ngoai duoc chon loc va bien tap lai cho giao dien user.'); ?>
                                </p>
                                <div class="mt-8 flex items-center justify-between border-t border-slate-100 pt-6">
                                    <div>
                                        <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Gia tu</div>
                                        <div class="mt-2 text-2xl font-black text-[#ff645a]"><?php echo tourPriceText($tour); ?></div>
                                    </div>
                                    <a href="index.php?controller=tour&action=detail&id=<?php echo (int) $tour['tourID']; ?>" class="rounded-full bg-[#2b5bb5] px-5 py-3 text-sm font-bold text-white transition hover:brightness-110">
                                        Chi tiet tour
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
