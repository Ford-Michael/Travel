<?php
if (!function_exists('domesticPriceText')) {
    function domesticPriceText($tour) {
        return number_format((float) ($tour['priceAdult'] ?? $tour['price'] ?? 0), 0, ',', '.') . ' đ';
    }
}
?>

<main>
    <style>
        .domestic-slideshow { position: relative; min-height: 680px; display: flex; align-items: center; overflow: hidden; }
        .domestic-slideshow .dslide {
            position: absolute; inset: 0; opacity: 0; z-index: 0;
            transition: opacity 1.5s ease-in-out;
        }
        .domestic-slideshow .dslide.active { opacity: 1; }
        .domestic-slideshow .dslide img {
            width: 100%; height: 100%; object-fit: cover;
            animation: domesticKenBurns 20s ease-in-out infinite alternate;
        }
        @keyframes domesticKenBurns {
            0%   { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.08) translate(0.5%, -0.5%); }
        }
        .domestic-slideshow .dslide-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 60%);
        }
        .domestic-dots { display: flex; gap: 8px; margin-top: 20px; }
        .domestic-dots button {
            width: 10px; height: 10px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.5);
            background: transparent; cursor: pointer; transition: all 0.3s; padding: 0;
        }
        .domestic-dots button.active {
            background: #ff645a; border-color: #ff645a; transform: scale(1.3);
        }
        .domestic-progress {
            position: absolute; bottom: 0; left: 0; height: 3px;
            background: linear-gradient(90deg, #ff645a, #00337c);
            transition: width 0.3s linear; z-index: 25;
        }
        .dslide .slide-caption {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 3rem 2rem 4.5rem;
            background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, transparent 100%);
            z-index: 5;
        }
        .dslide .slide-caption p {
            color: #fff; font-size: 1.25rem; font-weight: 700;
            letter-spacing: 0.03em; text-shadow: 0 2px 8px rgba(0,0,0,0.4);
        }
    </style>

    <?php
    $domesticSlides = [
        [
            'src'     => '/travel.bling/img/TOUR TRONG NƯỚC/miền bắc/GhdyX.jpg',
            'caption' => 'Miền Bắc — Hà Long, Sa Pa, Hà Giang',
        ],
        [
            'src'     => '/travel.bling/img/TOUR TRONG NƯỚC/miền bắc/jUVi2.jpg',
            'caption' => 'Miền Bắc — Ruộng bậc thang Tây Bắc',
        ],
        [
            'src'     => '/travel.bling/img/TOUR TRONG NƯỚC/miền trung/2ef1h.jpg',
            'caption' => 'Miền Trung — Hội An, Đà Nẵng, Huế',
        ],
        [
            'src'     => '/travel.bling/img/TOUR TRONG NƯỚC/miền nam/860ze.jpg',
            'caption' => 'Miền Nam — Sài Gòn, Vũng Tàu, Cần Thơ',
        ],
        [
            'src'     => '/travel.bling/img/TOUR TRONG NƯỚC/miền nam/B3E7n.jpg',
            'caption' => 'Miền Tây — Sông nước Cửu Long',
        ],
        [
            'src'     => '/travel.bling/img/TOUR TRONG NƯỚC/Hải đảo/YP5tt.jpg',
            'caption' => 'Hải Đảo — Phú Quốc, Côn Đảo, Lý Sơn',
        ],
    ];
    ?>

    <section class="domestic-slideshow" id="domesticSlideshow">
        <?php foreach ($domesticSlides as $i => $slide): ?>
            <div class="dslide <?php echo $i === 0 ? 'active' : ''; ?>">
                <img src="<?php echo $slide['src']; ?>" alt="Du lịch trong nước <?php echo $i + 1; ?>" loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>" />
                <div class="dslide-overlay"></div>
                <div class="slide-caption">
                    <p><?php echo htmlspecialchars($slide['caption']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full" style="position:absolute;bottom:1.5rem;left:50%;transform:translateX(-50%);">
            <div class="domestic-dots" id="domesticDots">
                <?php foreach ($domesticSlides as $i => $slide): ?>
                    <button data-slide="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="domestic-progress" id="domesticProgress"></div>
    </section>

    <script>
    (function() {
        const slides = document.querySelectorAll('#domesticSlideshow .dslide');
        const dots = document.querySelectorAll('#domesticDots button');
        const progress = document.getElementById('domesticProgress');
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

        var container = document.getElementById('domesticSlideshow');
        container.addEventListener('mouseenter', function() {
            clearInterval(timer); clearInterval(progressTimer);
        });
        container.addEventListener('mouseleave', function() {
            timer = setInterval(next, interval); resetProgress();
        });
    })();
    </script>

    <section class="py-20 bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-5 mb-12">
                <div>
                    <h2 class="font-headline text-4xl font-extrabold text-on-secondary-fixed">Phân Vùng Hành Trình Trong Nước</h2>
                    <p class="mt-4 text-slate-500 max-w-2xl">Mỗi miền được thiết kế theo bộ tiêu chuẩn dịch vụ cao cấp nhằm mang lại trải nghiệm hoàn hảo nhất cho du khách.</p>
                </div>
                <div class="rounded-full bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm">
                    <?php echo (int) ($totalTours ?? 0); ?> tour trong nước
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <?php foreach (($regionCards ?? []) as $card): ?>
                    <a href="index.php?controller=tour&action=domesticRegion&region=<?php echo urlencode($card['slug']); ?>" class="group overflow-hidden rounded-[32px] bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="grid lg:grid-cols-[1.1fr,0.9fr]">
                            <div class="relative min-h-[280px] overflow-hidden">
                                <img src="<?php echo htmlspecialchars($card['heroImage']); ?>" alt="<?php echo htmlspecialchars($card['name']); ?>" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                <div class="absolute left-6 bottom-6 rounded-full bg-white/15 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-white backdrop-blur-sm">
                                    <?php echo htmlspecialchars($card['name']); ?>
                                </div>
                            </div>
                            <div class="p-7">
                                <h3 class="font-headline text-3xl font-extrabold text-on-secondary-fixed"><?php echo htmlspecialchars($card['title']); ?></h3>
                                <p class="mt-4 text-sm leading-7 text-slate-600"><?php echo htmlspecialchars($card['subtitle']); ?></p>
                                <div class="mt-6 text-sm font-semibold text-[#2b5bb5]"><?php echo (int) ($card['count'] ?? 0); ?> tour đang mở bán</div>
                                <?php if (!empty($card['featured'])): ?>
                                    <div class="mt-6 space-y-3">
                                        <?php foreach ($card['featured'] as $tour): ?>
                                            <div class="flex items-center gap-3 rounded-2xl bg-slate-50 px-3 py-3">
                                                <img src="<?php echo htmlspecialchars($tour['heroImage']); ?>" alt="<?php echo htmlspecialchars($tour['tour_name']); ?>" class="h-14 w-14 rounded-xl object-cover">
                                                <div class="min-w-0 flex-1">
                                                    <div class="truncate text-sm font-bold text-slate-900"><?php echo htmlspecialchars($tour['tour_name']); ?></div>
                                                    <div class="text-xs text-slate-500"><?php echo domesticPriceText($tour); ?></div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="domestic-tours" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-12">
                <div class="h-px w-12 bg-[#2b5bb5]"></div>
                <span class="text-[#2b5bb5] font-bold tracking-[0.22em] uppercase text-xs">Bộ Sưu Tập Trong Nước</span>
            </div>

            <?php if (empty($tours)): ?>
                <div class="rounded-[28px] border border-dashed border-slate-300 px-8 py-20 text-center text-slate-500">
                    Chưa có tour trong nước phù hợp để hiển thị.
                </div>
            <?php else: ?>
                <div class="grid gap-8 md:grid-cols-12">
                    <?php foreach ($tours as $index => $tour): ?>
                        <article class="<?php echo $index === 0 ? 'md:col-span-8' : 'md:col-span-4'; ?> overflow-hidden rounded-[28px] bg-surface-container-lowest shadow-sm">
                            <div class="relative h-[360px] overflow-hidden">
                                <img src="<?php echo htmlspecialchars($tour['heroImage']); ?>" alt="<?php echo htmlspecialchars($tour['tour_name']); ?>" class="h-full w-full object-cover transition duration-700 hover:scale-105">
                                <div class="absolute left-5 top-5 rounded-full bg-white/15 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] text-white backdrop-blur-sm">
                                    <?php echo htmlspecialchars($tour['domesticLabel'] ?? 'Trong nước'); ?>
                                </div>
                            </div>
                            <div class="p-7">
                                <h3 class="font-headline text-2xl font-extrabold text-on-secondary-fixed"><?php echo htmlspecialchars($tour['tour_name']); ?></h3>
                                <p class="mt-4 text-sm leading-7 text-slate-600 line-clamp-3">
                                    <?php echo htmlspecialchars($tour['summary'] ?: 'Trải nghiệm hành trình trong nước với tiêu chuẩn dịch vụ cao cấp và trọn vẹn.'); ?>
                                </p>
                                <div class="mt-8 flex items-center justify-between border-t border-slate-100 pt-6">
                                    <div>
                                        <div class="text-xs uppercase tracking-[0.2em] text-slate-400">Giá từ</div>
                                        <div class="mt-2 text-2xl font-black text-[#400002]"><?php echo domesticPriceText($tour); ?></div>
                                    </div>
                                    <a href="index.php?controller=tour&action=detail&id=<?php echo (int) $tour['tourID']; ?>" class="rounded-full bg-[#ff645a] px-5 py-3 text-sm font-bold text-white">
                                        Chi tiết tour
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
