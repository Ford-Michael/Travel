<?php
/**
 * Homepage View
 * Travel Bling User Site
 */

// Helper to format tour price
function formatPrice($price)
{
    return number_format($price, 0, ',', '.') . '₫';
}
?>
<!-- ===== HERO SLIDESHOW SECTION ===== -->
<style>
    .hero-slideshow { position: relative; width: 100%; height: 870px; overflow: hidden; }
    .hero-slideshow .slide {
        position: absolute; inset: 0; opacity: 0;
        transition: opacity 1.5s ease-in-out;
    }
    .hero-slideshow .slide.active { opacity: 1; }
    .hero-slideshow .slide img {
        width: 100%; height: 100%; object-fit: cover;
        animation: heroKenBurns 18s ease-in-out infinite alternate;
    }
    @keyframes heroKenBurns {
        0%   { transform: scale(1)   translate(0, 0); }
        100% { transform: scale(1.1) translate(-1%, -1%); }
    }
    .hero-slideshow .slide-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.4) 0%, transparent 60%);
    }
    /* Dot indicators */
    .hero-dots { display: flex; gap: 10px; }
    .hero-dots button {
        width: 12px; height: 12px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.6);
        background: transparent; cursor: pointer; transition: all 0.3s; padding: 0;
    }
    .hero-dots button.active {
        background: #ff645a; border-color: #ff645a; transform: scale(1.2);
    }
    /* Progress bar */
    .hero-progress {
        position: absolute; bottom: 0; left: 0; height: 3px;
        background: linear-gradient(90deg, #ff645a, #ff9a44);
        transition: width 0.3s linear; z-index: 25;
    }
</style>

<?php
$heroSlides = [
    '/travel.bling/img/RÁC/a5d82902-1fc1-4c75-856e-023b34cd67a0.png',
    '/travel.bling/img/RÁC/adbe1ecd-98be-4234-8fc3-272b46b7a13c.png',
    '/travel.bling/img/RÁC/baf2c158-03ec-4034-bac0-8d42b59953d8.png',
    '/travel.bling/img/RÁC/bn.png',
    '/travel.bling/img/RÁC/ss.png',
    '/travel.bling/img/RÁC/vt.png',
    '/travel.bling/img/RÁC/cs-cl.png',
    '/travel.bling/img/background about autoplay- memo/OUIjq.jpg',
    '/travel.bling/img/background about autoplay- memo/Z6cOl.jpg',
    '/travel.bling/img/background about autoplay- memo/f30Jj.jpg',
    '/travel.bling/img/background about autoplay- memo/icGgF.jpg',
    '/travel.bling/img/background about autoplay- memo/rd9bt.jpg',
];
?>

<section class="hero-slideshow" id="heroSlideshow">
    <?php foreach ($heroSlides as $i => $slide): ?>
        <div class="slide <?php echo $i === 0 ? 'active' : ''; ?>">
            <img src="<?php echo $slide; ?>" alt="Travel Bling Hero <?php echo $i + 1; ?>" loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>" />
            <div class="slide-overlay"></div>
        </div>
    <?php endforeach; ?>

    <div class="relative z-10 max-w-7xl mx-auto h-full flex flex-col justify-end pb-12 px-8">
        <div class="hero-dots" id="heroDots">
            <?php foreach ($heroSlides as $i => $slide): ?>
                <button data-slide="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bottom Strip -->
    <div class="absolute bottom-0 w-full bg-white/10 backdrop-blur-md border-t border-white/20 py-4 px-8 z-20">
        <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center text-white font-medium text-sm">
            <div class="flex items-center gap-6">
                <span class="flex items-center gap-2"><span
                        class="material-symbols-outlined text-on-primary-container">language</span> travel.bling</span>
                <span class="flex items-center gap-2"><span
                        class="material-symbols-outlined text-on-primary-container">phone_in_talk</span> Hotline: 0365
                    690 399</span>
            </div>
            <div class="hidden md:block">Hơn 20 năm đồng hành cùng du khách Việt</div>
        </div>
    </div>
    <div class="hero-progress" id="heroProgress"></div>
</section>

<script>
(function() {
    const slides = document.querySelectorAll('#heroSlideshow .slide');
    const dots = document.querySelectorAll('#heroDots button');
    const progress = document.getElementById('heroProgress');
    let current = 0;
    const total = slides.length;
    const interval = 5000;
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

    // Pause on hover
    var container = document.getElementById('heroSlideshow');
    container.addEventListener('mouseenter', function() {
        clearInterval(timer); clearInterval(progressTimer);
    });
    container.addEventListener('mouseleave', function() {
        timer = setInterval(next, interval); resetProgress();
    });
})();
</script>

<!-- ===== FEATURED TOURS SECTION ===== -->
<section class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex justify-between items-end mb-16">
            <div>
                <h2 class="text-on-secondary-fixed font-headline font-bold text-4xl mb-4">CÁC TOUR NỔI BẬT</h2>
                <p class="text-on-surface-variant max-w-lg">Những hành trình được thiết kế riêng, mang đến trải nghiệm
                    đẳng cấp và khác biệt cho mỗi điểm đến.</p>
            </div>
            <a href="index.php?controller=tour" class="text-secondary font-bold flex items-center gap-2 group">
                XEM TẤT CẢ <span
                    class="material-symbols-outlined group-hover:translate-x-1 transition-transform">trending_flat</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php if (!empty($featuredTours)): ?>
                <?php foreach ($featuredTours as $tour): ?>
                    <!-- Dynamic Tour Card -->
                    <a href="index.php?controller=tour&action=detail&id=<?php echo $tour['tourID']; ?>"
                        class="bg-surface-container-lowest rounded-xl overflow-hidden group hover:shadow-2xl transition-shadow duration-500 block">
                        <div class="relative h-64 overflow-hidden">
                            <?php if (!empty($tour['heroImage'])): ?>
                                <img src="<?php echo htmlspecialchars($tour['heroImage']); ?>"
                                    alt="<?php echo htmlspecialchars($tour['tour_name'] ?? ''); ?>"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <?php else: ?>
                                <div
                                    class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-700 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white text-6xl">landscape</span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($tour['badge'])): ?>
                                <div
                                    class="absolute top-4 left-4 glass-badge px-3 py-1 rounded-full text-xs font-bold text-white uppercase tracking-wider">
                                    <?php echo htmlspecialchars($tour['badge']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-4 text-xs text-outline font-medium mb-4">
                                <?php if (!empty($tour['duration'])): ?>
                                    <span class="flex items-center gap-1"><span
                                            class="material-symbols-outlined text-base">calendar_today</span>
                                        <?php echo htmlspecialchars($tour['duration']); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($tour['airline'])): ?>
                                    <span class="flex items-center gap-1"><span
                                            class="material-symbols-outlined text-base">flight_takeoff</span>
                                        <?php echo htmlspecialchars($tour['airline']); ?></span>
                                <?php endif; ?>
                            </div>
                            <h3 class="text-on-secondary-fixed font-headline font-bold text-xl mb-6 line-clamp-2">
                                <?php echo htmlspecialchars($tour['tour_name'] ?? 'Tour Name'); ?>
                            </h3>
                            <div class="flex justify-between items-center pt-6 border-t border-surface-variant/50">
                                <div>
                                    <span class="block text-xs text-outline mb-1">Giá từ</span>
                                    <span class="text-on-primary-container font-headline font-bold text-2xl">
                                        <?php echo formatPrice($tour['price'] ?? 0); ?>
                                    </span>
                                </div>
                                <span
                                    class="bg-secondary text-white p-3 rounded-lg group-hover:bg-on-secondary-fixed transition-colors">
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Demo Tour Cards (fallback when no DB data) -->
                <!-- Tour Card 1 -->
                <div
                    class="bg-surface-container-lowest rounded-xl overflow-hidden group hover:shadow-2xl transition-shadow duration-500">
                    <div class="relative h-64 overflow-hidden">
                        <img alt="Nhật Bản"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7lm1kDErHheEQsvUIrwpAKfu8gr2s0PNcaXK2sAIrcJQdZSMirCR3hpU1_likZNWo4OE1LSkokGtFqyWpuGTaoMvDxqVHbTK9bJ_6mm_-2Fq20J8iACDwKWap0ui8v1tUSailILqDxtSperKmGOZYdNnD90tmhdX89PdUB2qwz7xxNRpuN_AJpejjO9lsxUzcQruuy4w3ur-65xdTHKtCzq36tjaCWDW8V9vUGjXy6OidS1osN3LbqFhQ99-ifBHI8RxEQd9xOqjp" />
                        <div
                            class="absolute top-4 left-4 glass-badge px-3 py-1 rounded-full text-xs font-bold text-white uppercase tracking-wider">
                            Bán Chạy</div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-4 text-xs text-outline font-medium mb-4">
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-base">calendar_today</span> 6N5Đ</span>
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-base">flight_takeoff</span> Japan Airlines</span>
                        </div>
                        <h3 class="text-on-secondary-fixed font-headline font-bold text-xl mb-6 line-clamp-2">Hành trình
                            Cung Đường Vàng Nhật Bản: Tokyo - Fuji - Kyoto - Osaka</h3>
                        <div class="flex justify-between items-center pt-6 border-t border-surface-variant/50">
                            <div>
                                <span class="block text-xs text-outline mb-1">Giá từ</span>
                                <span class="text-on-primary-container font-headline font-bold text-2xl">32.900.000₫</span>
                            </div>
                            <a href="index.php?controller=tour"
                                class="bg-secondary text-white p-3 rounded-lg hover:bg-on-secondary-fixed transition-colors">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 2 -->
                <div
                    class="bg-surface-container-lowest rounded-xl overflow-hidden group hover:shadow-2xl transition-shadow duration-500">
                    <div class="relative h-64 overflow-hidden">
                        <img alt="Thái Lan"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuB_OjjWXjEjVnZWBZ8-qxEa8tczqagzAHQPRdelHI8OqavJlR3xtkmdndl-oT2k9B1XBHxkOVPJI9vtmgTBep-HmrQG74htYUDDTZj1tg95cyk0jJAVveHG5T69XfY7Wk-cAl8LJyLkcCgzNkDfuJdVKAddymjQ8uGnmHgB05G3G1D-rfVkbwMVmnPgIc5OuTh0XWqySuO5kseN8ek2CpJNGOFcwZFeTFzt2GC-21Leop-YGTQ2K2rVZu6Q9gZU8zrr6Qjffl5dWmKi" />
                        <div
                            class="absolute top-4 left-4 glass-badge px-3 py-1 rounded-full text-xs font-bold text-white uppercase tracking-wider">
                            Khuyến Mãi</div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-4 text-xs text-outline font-medium mb-4">
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-base">calendar_today</span> 5N4Đ</span>
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-base">flight_takeoff</span> VietJet Air</span>
                        </div>
                        <h3 class="text-on-secondary-fixed font-headline font-bold text-xl mb-6 line-clamp-2">Thái Lan:
                            Thiên Đường Biển Đảo Phuket - Đảo Phi Phi - Vịnh Maya</h3>
                        <div class="flex justify-between items-center pt-6 border-t border-surface-variant/50">
                            <div>
                                <span class="block text-xs text-outline mb-1">Giá từ</span>
                                <span class="text-on-primary-container font-headline font-bold text-2xl">12.500.000₫</span>
                            </div>
                            <a href="index.php?controller=tour"
                                class="bg-secondary text-white p-3 rounded-lg hover:bg-on-secondary-fixed transition-colors">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tour Card 3 -->
                <div
                    class="bg-surface-container-lowest rounded-xl overflow-hidden group hover:shadow-2xl transition-shadow duration-500">
                    <div class="relative h-64 overflow-hidden">
                        <img alt="Châu Âu"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQuzyn-B1Mnotymxv8zICtQy_kRv2PQQlN-pRQEPHKHka1KpcF8UpR783FDn_8r3pgsondfreN2__jW7wJx3UKLBZWHO0oja-pMByycXA1MsequOyHGN13AVhVSA-bOHG_YE1wVbt7HyBbWsRRRzg4QIAcyjFUG4tp4jWVU04-XxwhwhLwzo8dKMgt5FmjdHu6MRsV0UDgejOI3TKMycM2eOLKJXeia1-EilW3dRdy2VK1JK_gL5pRsZCV9dlR9W3EngIGjrUfpUiq" />
                        <div
                            class="absolute top-4 left-4 glass-badge px-3 py-1 rounded-full text-xs font-bold text-white uppercase tracking-wider">
                            Đẳng Cấp</div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-4 text-xs text-outline font-medium mb-4">
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-base">calendar_today</span> 10N9Đ</span>
                            <span class="flex items-center gap-1"><span
                                    class="material-symbols-outlined text-base">flight_takeoff</span> Qatar Airways</span>
                        </div>
                        <h3 class="text-on-secondary-fixed font-headline font-bold text-xl mb-6 line-clamp-2">Châu Âu Liên
                            Tuyến: Pháp - Thụy Sĩ - Ý - Vatican Kinh Điển</h3>
                        <div class="flex justify-between items-center pt-6 border-t border-surface-variant/50">
                            <div>
                                <span class="block text-xs text-outline mb-1">Giá từ</span>
                                <span class="text-on-primary-container font-headline font-bold text-2xl">65.900.000₫</span>
                            </div>
                            <a href="index.php?controller=tour"
                                class="bg-secondary text-white p-3 rounded-lg hover:bg-on-secondary-fixed transition-colors">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ===== GLOBAL DESTINATIONS ===== -->
<section class="py-24 editorial-gradient relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 100 100">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
        </svg>
    </div>
    <div class="max-w-7xl mx-auto px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-white font-headline font-bold text-4xl mb-4 uppercase tracking-tight">Điểm Đến Toàn Cầu</h2>
            <div class="w-24 h-1 bg-on-primary-container mx-auto"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Destination: Nhật Bản -->
            <a href="index.php?controller=tour&action=search&q=Nhật+Bản"
                class="relative group h-[400px] rounded-2xl overflow-hidden cursor-pointer">
                <img alt="Nhật Bản"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIAgJ8LqXKorYitMAvYviORGwsEZmxVIIsPJ5lnkvO0OKvJQuXFS5yB14FcsXOjGDE7zW_sP2kUhdP1L4W7Qxl5oICDluMtfwCgXSh4lCmD-r56QqBULvvFaz7qWNRGuDyCZK_ZOSwZJii-2day9Mo7arcgU5uFI8owNJAboUwpAjLGlRPp425CeVQcNnt9NrZ0la33Tzt4eUw2MCGT_AiSiFfkvZXgetNfckHFIWlzV7rU6T27zW1vSQ4uMZthWCag9qGvkfj1vTQ" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-8 left-8">
                    <span class="text-on-primary-container font-bold text-xs tracking-widest uppercase mb-2 block">Châu
                        Á</span>
                    <h4 class="text-white font-headline font-bold text-2xl">Nhật Bản</h4>
                </div>
            </a>

            <!-- Destination: Thái Lan -->
            <a href="index.php?controller=tour&action=search&q=Thái+Lan"
                class="relative group h-[400px] rounded-2xl overflow-hidden md:mt-12 cursor-pointer">
                <img alt="Thái Lan"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDzEwvcLKGjIb38n0l3deRWwsok1NqltsVi8AY4H9SB0N29bsKMxlvG2-bT5oAelNuL_MB9TA7uZrM95hVldFV66JWWbRA_8MCkSUmlmfuvUzh9kXOUawli6glwWibho30l9YLkI37-0oe5biPoLg1cKksU_nHXHqdinnVU_qlo5jRhJUYePFLDFfm6PRzxqt7MYYmJY_iOF__CO34EPstmCGFmzP-FVoxhMWEQDb4alR3M0aVVIN3agVc5nRP1FbBV2g-HEROmrHQ2" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-8 left-8">
                    <span class="text-on-primary-container font-bold text-xs tracking-widest uppercase mb-2 block">Châu
                        Á</span>
                    <h4 class="text-white font-headline font-bold text-2xl">Thái Lan</h4>
                </div>
            </a>

            <!-- Destination: Thụy Sĩ -->
            <a href="index.php?controller=tour&action=search&q=Thụy+Sĩ"
                class="relative group h-[400px] rounded-2xl overflow-hidden cursor-pointer">
                <img alt="Thụy Sĩ"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-nP6aUCEpqyRYY9HN8950s5_08cUOcJL9AWxEjncDHs7JOjah27PBU4CJRhZ9ayfuwVyfdfAex-Q8LGkuxbY1XPjKyYhVfSd2aBXPMug5bubpcjOw7b5c-8t-7KQ-BCmDiX-Jz38FAACMRY0lvPGUXau6C4oxCCK47tYwpvjXPceJHheuxjSrGhVn4K37DP7MWjkTDtPrqe0UxLkLYo69cTmQda4wYkgA4zAbZ8bx6AgPNhUv6aOmIfKrzqaUfKYEHmZXWThWaWTx" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-8 left-8">
                    <span class="text-on-primary-container font-bold text-xs tracking-widest uppercase mb-2 block">Châu
                        Âu</span>
                    <h4 class="text-white font-headline font-bold text-2xl">Thụy Sĩ</h4>
                </div>
            </a>

            <!-- Destination: Singapore -->
            <a href="index.php?controller=tour&action=search&q=Singapore"
                class="relative group h-[400px] rounded-2xl overflow-hidden cursor-pointer">
                <img alt="Singapore"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAXuE8vafxLUTyjkKDdOkS-B1RqaI7dWNqDXSDW6HCOpik61k6dkO5IBEnA0YtXjyZjvhXkReGXxOw626KG4JLSEDTZWUVEudUxkBLrTq6_IdL9Cd8KHtGCvwBLF13w2HzBEDZwmgQYVQnB7lNZl6wZJosxsYaOfG4kCamBm6bdscVv_-ibJskgB8qrqjH7Mkq5VHF6OhLGav1_pJVjfHuu0twULPvYZTVhmn_F1x0whLwDYyAQ10n7BSxqytxKV8xjZMHGpkteimZ" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-8 left-8">
                    <span class="text-on-primary-container font-bold text-xs tracking-widest uppercase mb-2 block">Châu
                        Á</span>
                    <h4 class="text-white font-headline font-bold text-2xl">Singapore</h4>
                </div>
            </a>

            <!-- Destination: Australia -->
            <a href="index.php?controller=tour&action=search&q=Australia"
                class="relative group h-[400px] rounded-2xl overflow-hidden md:mt-12 cursor-pointer">
                <img alt="Australia"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH42479PRknlPTWm3FGODo3F9GoS-GVPlsU_to_-81ayVq0RGJBFm9AdNdgwNqnQqITYbECnaPpt32Du4SqDpLAjsgRk-nBrzDBpTOgsR9O2oQUCSg0vqxnRzuM8_HNonJ8MluQbvyN09r6Bah8pBvo00sYQW_nFhtSdQwP63fJVy2pGB-_9PUDpNw8M6oSUqPA_9-tfgdGSiZBzXt9FkNFpkCB4s1naolsQa-7s8S696bmP2SjQRMBIi7k7blxVs445m6Qkgz0TBz" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-8 left-8">
                    <span class="text-on-primary-container font-bold text-xs tracking-widest uppercase mb-2 block">Châu
                        Úc</span>
                    <h4 class="text-white font-headline font-bold text-2xl">Australia</h4>
                </div>
            </a>

            <!-- Destination: Sapa -->
            <a href="index.php?controller=tour&action=search&q=Sapa"
                class="relative group h-[400px] rounded-2xl overflow-hidden cursor-pointer">
                <img alt="Sapa Tây Bắc"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDePE4ZkhDl040eCTSyfxA6nb9uZ7D0q3-2IMWR4YADpGBIsAAudbZfbYm01fSsGxZz4JlNjppdN_2999Pq5NFras6jMBoC2LhHhv9I0Xb3Es13o7Tfqf1e5MAR-gwlG4dDBPhYDnmqQ9B0kJLV_xs78CzeRMKz3ARJbdBlpVOWyfTsIKUHzNmSQztiPnAlNo-pJj25c_kYB2APTSxrjYJQ5RvBt9giUERel66KlZSzPFPCRhHEw6siGVARrE5ugoMKVRnFwYiMDMTY" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-8 left-8">
                    <span class="text-on-primary-container font-bold text-xs tracking-widest uppercase mb-2 block">Việt
                        Nam</span>
                    <h4 class="text-white font-headline font-bold text-2xl">Sapa - Tây Bắc</h4>
                </div>
            </a>
        </div>

        <div class="mt-16 text-center">
            <a href="index.php?controller=tour"
                class="border-2 border-white/30 text-white px-12 py-3 rounded-md font-bold hover:bg-white hover:text-secondary transition-all inline-block">
                XEM THÊM ĐIỂM ĐẾN
            </a>
        </div>
    </div>
</section>

<!-- ===== PRESS & CUSTOMERS ===== -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
            <!-- Press -->
            <div>
                <h3 class="text-on-secondary-fixed font-headline font-bold text-xl mb-8 flex items-center gap-3">
                    <span class="w-8 h-[2px] bg-on-primary-container"></span>
                    VIET SUN TRAVEL VỚI BÁO CHÍ
                </h3>
                <div class="flex flex-wrap gap-8 items-center opacity-60">
                    <img alt="Tuoi Tre" class="h-8 object-contain"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD7IS5UXfBnLw8dz7bX9mKqPFJZuO3ItFP2tO2FPa0vSlfxp0O1dOiqphaSzkoovoZrw9F0-zu7DqDW6l42KzhvnukPN1OwTK8anZg22sNxAZbnBUj8qzEuY8JQYp1B1CFDNxymmG_Utvb_488596m7Sw5exyp_weKSwovFOGinHtFo1x39fqaVdclXvpD_Qt9c4VPgaF9JWd2srciC_MuZWKU_iKeULTg_zS4NwVz-ximFDAfmvks7-1I8uEs18DcdLHwCirjwXlN5" />
                    <img alt="Thanh Nien" class="h-8 object-contain"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxlG5fi6FQ-84BdUotBojsNHhkxNz13jMER-H6AcN4c-HFPA5LhBYYWXubJWItBZ45Uag0jaNb2jLtYEJ7j3iC_ieGZ9TVoj72L_gDCWc88BPjVFY4JNTCtipJP3yA_y-DHVLs1RNsCE_mnW7mFB_EoN4V6gO-X_LvVFMISj66EVng67l4Pp2nVPPiRgj0dayUi6c8eh2FEjJdTKnlaxzNJaMbEkZEhIrg1tPLw8Ab5FAWDJln9-PqDfA-H3gSh7JDbP6kHympKg0U" />
                    <img alt="VNExpress" class="h-8 object-contain"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCE-CeNvNIa7si4-qSNyGrtjOSGItuGTHG73OdBf0qGOhjCYyJ6yZFyflm9idXQedQfSn48R-xqibUBqt3RjH0Q39EDi7B2lYalPPELq1reduNeXCCtbcDbD3tA1Wn8ftUAph4nuCWSzf6kbGaAFAlMLn9JQLWjYcpqBvnUFtzyxH4aPhdYMbPvibwrhDhjvfkrMAGCy5YwcjZ-OmKoElAw2bqQ4dF707s6ARGUWK1TBCAUUrHZ2125Py8-6eovWeJRoipCP6gPkPte" />
                    <img alt="VTV" class="h-8 object-contain"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAQ5T9DvJAQe3tSl_iR9oECZERbZKZQs8O4AiyWLKRN32cl7NheuNBAAbuVYamx3hekqMnGe652EdnAtbtLH3JMP7fxQJVvFTC7oOxYtNggOZuUxroPOIXoEVCqjqWr_ur97g-LIOPlsEaHIouqFvI4NBN0oD2uj_ZZFwWOKaEiqKYRaLQaZp6xQ4AnQKEhZ60ZcsPfJHkG2HTShRTUt-LXvFy-jRE66sAPiwTD4lLiijTmtn197Lm76v97il-WeQlLi_eaK61bW4qc" />
                </div>
            </div>

            <!-- Customers -->
            <div>
                <h3 class="text-on-secondary-fixed font-headline font-bold text-xl mb-8 flex items-center gap-3">
                    <span class="w-8 h-[2px] bg-on-primary-container"></span>
                    KHÁCH HÀNG TIÊU BIỂU
                </h3>
                <div class="flex -space-x-4 overflow-hidden mb-6">
                    <img alt="Khách hàng 1" class="inline-block h-12 w-12 rounded-full ring-2 ring-white object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDVL8TP3VCJRDjmXp9Ei_KB5iDb7EroZ4Fe5g8Xuc18xWtRj2xG41T8y81vKe6QfKp55OeRfAFUzRseFqsMUg3z19ZLQ6Sy4L5VHpTlgkwtn0Q_KGWOhe4-mhiXlEvdPf_cxsZodWxruXn7N_YNmhnSv-PFaB9PPO2dJZ80xPNLk2X8jHZruM32t0Ost8eawfillZPl7HZLkMLd-WelTS08vjJ8lV6xIXcbacdnx8Ccsw5dCl5CK2jMR8tGdtA62a4L8ByNbD-rgJ_5" />
                    <img alt="Khách hàng 2" class="inline-block h-12 w-12 rounded-full ring-2 ring-white object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBhthu9VGQb7Re7VRiv46msxfLnvZps1q71Nwvv-rip35odplvj591chk6Uh5dy_i4g4skPEDAnsVYVymWQ--SK4_j0wsk-gWVExT3lIhE7vCU2UcjJz1VBCG2xYgisuQ7amrWM-yU5JODrfiiBnZRZhxudXBtqq7-Dd74NXHTvIlhEiL4BW1hFcE9_6kdAlRKdFDwKtfKqCHH91rHl0yDE5k96hefSZaSuU0CauJdxDxeVXLKVkVcp0PHx-U5_6R0_6UvBfoI86L9R" />
                    <img alt="Khách hàng 3" class="inline-block h-12 w-12 rounded-full ring-2 ring-white object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCfK-dV68pPXzHYWN8pekkWl32WWSzJPEjnrjfzpKTMRKLvtDTaEB1IW7D8YXKhHlHyG_8uw-FDUij-j1Hu8nKeyw2ZT5nFVjAN_bNuJKx0VRFc4mYWACx1VSJKcv1Q8fzdRKV4EDVw5OdKJGXg-xr8v4R90iW52GkY4J7iQF7gqbT7C7NwGl1eDdguYWWJeVf2J-OtOTsglBOkLB0vh8N4-IvlWtKLdrwp_Gki8-ZJMh4biSP44QkFNafw9wN4KE5LhiG8xepXsO84" />
                    <img alt="Khách hàng 4" class="inline-block h-12 w-12 rounded-full ring-2 ring-white object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAw-hc2WwiK_Fk3-p5111MGrxhzero__vgiBvnFWKl-RcGmCosTRPKu1wmgpa7WeSIPicOfhZC8Ez4JkH3wzf84vgP_vE3LsYkwA5hA8pFwEr_K9wq3bmxqFYXFYlh0lCeX5SVj2cmhvxm5T_0Poj4ePqW6Hxs-av4ACQDuCOmJeMEh6WhlZkEQEewFhh4kGxJoh4wSF_TiYnQ9Q9tQaM6cZ5_6KkukfKgW7b7DsWimaX8isxsiemI9WUnuVewvkAKKU1i8M_VF57Yk" />
                    <div
                        class="flex items-center justify-center h-12 w-12 rounded-full ring-2 ring-white bg-surface-container-high text-on-surface-variant text-xs font-bold">
                        +5k</div>
                </div>
                <p class="text-on-surface-variant text-sm">Hơn 50,000 khách hàng đã tin tưởng và đồng hành cùng chúng
                    tôi mỗi năm trên mọi nẻo đường thế giới.</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== NEWS & VIDEO ===== -->
<section class="py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex flex-col md:flex-row gap-12">
            <!-- Video -->
            <div class="md:w-3/5">
                <h3 class="text-on-secondary-fixed font-headline font-bold text-3xl mb-8">Video Nổi Bật</h3>
                <div class="relative aspect-video rounded-2xl overflow-hidden shadow-xl group cursor-pointer">
                    <img alt="Video hành trình Châu Âu"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDkke-5gE4RTTChbx2IbyK2KtZwVreiY5tBEPOx_NcNTG8YGVlABdIKOv0NOmtNnzYeSLxNm7qJMDyvCn1pG4VzoL0A2BZ9yijTErZznSb1uAf8fk49amTU-mbV7R3uiJNNj9RhHE0I-8lYvPJqvhr9EEgKuJ_4rjzCTmvyqJexvyRoI33sPiDGsp5-W_3UmSOuF4yut6xzlm2aKsg4YG2jMcYjI-TwH4z7L4X5m3cy7zFBOSBwFm91vxcAJdRnGT34CRObux-4E9Cm" />
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                        <div
                            class="w-20 h-20 bg-on-primary-container text-white rounded-full flex items-center justify-center shadow-2xl transition-transform group-hover:scale-110">
                            <span class="material-symbols-outlined text-4xl"
                                style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-black/80 to-transparent">
                        <h4 class="text-white font-bold text-xl">Hành trình khám phá Châu Âu cùng Viet Sun Travel 2024
                        </h4>
                    </div>
                </div>
            </div>

            <!-- News -->
            <div class="md:w-2/5">
                <h3 class="text-on-secondary-fixed font-headline font-bold text-3xl mb-8">Tin Tức Du Lịch</h3>
                <div class="space-y-8">
                    <div class="flex gap-4 group cursor-pointer">
                        <img alt="Visa Châu Âu" class="w-24 h-24 object-cover rounded-lg flex-shrink-0"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDO6kAcwVhpQG2WayNHME-RdqCJr-Kgroe_qyeQuiHxZBAK7oeUijMd5OZkDSt_u7nl1Y87vNtYhWIGxPX_eXBeT27ovf2tiCPTXqQMljoErSaQ6es4bRAyZaba9Si48x81IR9V6B3U2VqVUsAsY-PPoSgzym-OrCcOJ1FOLWI3GX_kuSo40tLzD4LOjapI71MySpYtmzuMkOjCUBDul14lIRPsQyzZA0ahuSw2EvD5S0Hovi5KaKGWbbBmUKqe3JfTDgDxyt07n1xr" />
                        <div>
                            <span class="text-xs text-outline font-medium block mb-1 uppercase tracking-wider">Cẩm
                                nang</span>
                            <h5
                                class="text-on-secondary-fixed font-bold leading-tight group-hover:text-on-primary-container transition-colors">
                                Kinh nghiệm xin Visa Châu Âu tỷ lệ đậu 99% khách hàng nên biết</h5>
                            <span class="text-xs text-outline mt-2 block">12 Tháng 4, 2024</span>
                        </div>
                    </div>
                    <div class="flex gap-4 group cursor-pointer">
                        <img alt="Ẩm thực Tokyo" class="w-24 h-24 object-cover rounded-lg flex-shrink-0"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBZ1QD9A5MG6Pk8EkPj_qh18w0wpsTlPwfsPtL4G26qLQLoyuPI4tKRCUj7zBo68_euHEmnapbSMqRlI5PNgFFSFjNdXDd3j-TqJxMEpZFw2pjcXuU3XH4H93D30PA7cZ7Xv97wxk0_2nf3MXBFEBqfzxyti3Y2wjm_yhp_nWX9O2LuRNwKapMQXzXOLHktDEFJVcS5Ofurvv8T9DLxwLaasMenfpItB-AMbsjq3ObyvOdYUENKDK786LGnSkz4yRLsz9oeklHokNw" />
                        <div>
                            <span class="text-xs text-outline font-medium block mb-1 uppercase tracking-wider">Ẩm
                                thực</span>
                            <h5
                                class="text-on-secondary-fixed font-bold leading-tight group-hover:text-on-primary-container transition-colors">
                                Top 10 món ăn không thể bỏ qua khi đến Tokyo mùa hoa anh đào</h5>
                            <span class="text-xs text-outline mt-2 block">10 Tháng 4, 2024</span>
                        </div>
                    </div>
                    <div class="flex gap-4 group cursor-pointer">
                        <img alt="Phú Quốc" class="w-24 h-24 object-cover rounded-lg flex-shrink-0"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuD17ZEia7CYBFVURXvlQrPnJZP4cQEwvyJmnsYhyZErwuhQrhUN7pREI_qKrJH7n-GpdoLSPMYBskR5f8-iYL7zRkfCQ4hGQzrqUjUfxP7gcaq1aMVYdMfX93nDWbEfjzoCy3DyqV-QM7dXb_tA2-YR0dSZB9TxQtYD0nuMBtjEqszNWTaOmPSyYHDMLdqHAHgdp5eKeR2ehD7_9nfZ-B8qkVXOVf0LYT9eQriavu7RIm5XfMxCf1m_TbyFZYqYBjBTToBeXQMN6y18" />
                        <div>
                            <span class="text-xs text-outline font-medium block mb-1 uppercase tracking-wider">Điểm
                                đến</span>
                            <h5
                                class="text-on-secondary-fixed font-bold leading-tight group-hover:text-on-primary-container transition-colors">
                                Phú Quốc vào top những hòn đảo đẹp nhất thế giới 2024</h5>
                            <span class="text-xs text-outline mt-2 block">08 Tháng 4, 2024</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== REVIEWS SECTION ===== -->
<section class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-8">
        <h2 class="text-on-secondary-fixed font-headline font-bold text-4xl mb-16 text-center">CẢM NHẬN KHÁCH HÀNG</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <?php
            $reviews = [
                [
                    'name' => 'Chị Minh Anh',
                    'tour' => 'Tour Nhật Bản 6N5Đ',
                    'text' => '"Chuyến đi Nhật Bản vừa rồi thực sự tuyệt vời. Hướng dẫn viên nhiệt tình, lịch trình hợp lý và khách sạn rất cao cấp."',
                    'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRiIUExTSNIychQsZi58iZoqy7wsILPThYJfTKgZ9S3QmmSyL7r8guFbpCpzZQ83HhnaHQ06LYKH2m-hv-3YZqeurmP8XiUTiRtQudwPndmFlmevTSB2PBTmFXL3xTjp7SWupRSHzkyWuRyf55Z4IntAIrquG7T8bYfjW-oj7OQFRhtQwzmXPKluCbL1ZpJpXCWyTU-2EcODBMasH9dNY8HkTdGUchYLngdegi74bd2dxIyrdVr8cn7-zjg_qDmzwPaTG-07PLDgUN'
                ],
                [
                    'name' => 'Anh Hoàng Nam',
                    'tour' => 'Dịch vụ Visa',
                    'text' => '"Dịch vụ chuyên nghiệp, nhân viên tư vấn Visa rất có tâm. Tôi đã đậu Visa Châu Âu nhờ sự hỗ trợ của Viet Sun."',
                    'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDQRlOmbepuM0mLS3x_GXxbw7JgtvPQTfe6p_qsCeE4nwxLHpn7HG9c0l5zdVVAByTkLzh4viaxh9noHkCgt0INOcV1Q_FOfrS5iCFm5O3gepyUyJ41ECnRxTrWcakeBxJ2Px-Zdz4CWI--jajLwe1SCwOX7ehIXDcpZ4cODx8cfbRZyPZDHs7peeTUzYm1aCZGioM-fT3nEsnAS4UeNgBFc43GgFyzV4ZO8lqvfrI1EmaaA77tLzE5ndqi6j4ajL5fevym27CYC0J6'
                ],
                [
                    'name' => 'Cô Tuyết Mai',
                    'tour' => 'Tour Thái Lan',
                    'text' => '"Cám ơn công ty đã tổ chức tour Thái Lan rất chu đáo cho gia đình tôi. Đồ ăn ngon, điểm tham quan đẹp."',
                    'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA_qjB4v_XA6mTcwMtSryH4zfVjJBbxFTKa5HBiToAB7-PIHNFKaFMyfHjdeogpZcwVg1YPAPNk_iLvhKbjxSXz9c7jodQSLX80d0lGGG3m_ZIkQTZWDkkPxavrxGtqJuf9IsgvOp1vvvD73Mzq5T5HvYtc_HLgySQT4zZhCNzJLKzZMexomzU9pM5agcS5JOmyu64XXcpb9T-ZCLdVd--0uiQ5auR1zaKXJS02EUd9-Wcf2BPHiLaLyNM32CBfxFNz69mMPiIyRW_Z'
                ],
                [
                    'name' => 'Chị Phương Thảo',
                    'tour' => 'Tour Hàn Quốc',
                    'text' => '"Giá cả cạnh tranh mà chất lượng tour lại cực kỳ cao. Sẽ tiếp tục đồng hành cùng Viet Sun trong các chuyến đi tới."',
                    'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCb5ZVUhfz0NBk86XlYgO6EJJaVQPnY0cevlUooTL0LSNReGb-s58upCHPgrPk-6BIc_Qfmhq3m-tvR6vsfYtpBNQkXgRkCE28nKycEtwI8Wi4V-S5KugCYWcW85bDusq1wXo0K7xPDBkM4hMmyWH9OR53DgsjduP52K5GZnNqP1xLVZtnmTI7lM64t_1xLDcblMMdk3DtF2CgOei_VbTPlU8OKMP8z-Wobcaddb9uL5F-fivluDJrh_NbLwQbeEWQQfgbkyb5ng8v1'
                ],
            ];
            foreach ($reviews as $review): ?>
                <div class="bg-white p-8 rounded-xl relative shadow-sm hover:shadow-lg transition-all mt-6">
                    <div class="absolute -top-6 left-8">
                        <img alt="<?php echo htmlspecialchars($review['name']); ?>"
                            class="w-12 h-12 rounded-full border-4 border-white shadow-md object-cover"
                            src="<?php echo $review['img']; ?>" />
                    </div>
                    <div class="pt-4">
                        <div class="flex text-on-primary-container mb-4">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                            <?php endfor; ?>
                        </div>
                        <p class="text-on-surface-variant text-sm italic leading-relaxed mb-6">
                            <?php echo $review['text']; ?>
                        </p>
                        <h6 class="text-on-secondary-fixed font-bold text-sm"><?php echo $review['name']; ?></h6>
                        <span class="text-xs text-outline uppercase tracking-wider"><?php echo $review['tour']; ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ===== OTHER SERVICES ===== -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="#" class="relative rounded-2xl overflow-hidden h-48 group cursor-pointer block">
                <img alt="Dịch vụ Visa"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBC3c9WIAQQYamH4--bIU9lyGNxBfakJA5fMVVRQ5dcWC5QQAzBgYmx684hlUrxNa0YjygI5D1GGy2s9f1WpxkdmcILSFr3OEiioGYpSvPYXCRVHRfdArWBhZC61Z1DsDQUzOiaIutwPcoPyivSwgPXyLr6UAMid9JjmPTstx3Ni9N5GWkCuJDuCjM8hEn9x_mAAOxMNQamWPd1qdSp7VjE__8UxL4ZJhnfsldBDHuDpPyZBgGUS2B-xrrMethr0LTIjR0N02eSuqK3" />
                <div
                    class="absolute inset-0 bg-black/40 flex items-center justify-center hover:bg-black/50 transition-colors">
                    <h4 class="text-white font-headline font-bold text-2xl uppercase tracking-widest">Dịch Vụ Visa</h4>
                </div>
            </a>
            <a href="#" class="relative rounded-2xl overflow-hidden h-48 group cursor-pointer block">
                <img alt="Vé máy bay"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIlNIOEbW_0SV1GQNFW16t-dmg2XdvCimYqkIeZIOJwJ32nBV-91lgmQ9Bi1lRl5XVFKlzOiHu13p6U9h9u-DpUyrysm43UnLtmy7mgxwFzgkEgkDp-PyMV9McpqrCkNPCxyoYTr9EhQH3sjBrlsWkG-xA-9pjNuQs_XydiAKkGfVkjfhxMR8S4CO3ezrHP60w6IQo0zSdXU4ZYl-Q4pP6T3mJ7xWgsmsuNqQxVo2hAwmXyxMenfRszp-rP0qsYH9JYti23SvpuomD" />
                <div
                    class="absolute inset-0 bg-black/40 flex items-center justify-center hover:bg-black/50 transition-colors">
                    <h4 class="text-white font-headline font-bold text-2xl uppercase tracking-widest">Vé Máy Bay</h4>
                </div>
            </a>
            <a href="#" class="relative rounded-2xl overflow-hidden h-48 group cursor-pointer block">
                <img alt="Khách sạn"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvACZ315tapQ7MphcbYB3R3umriDT0GuIiN_9T5bdXUATlnwfxX5Ro1Pw_awgNobHnVWKZeYRoqGZyh2CrSLmJCP-EyVVy_KnnV3wvPG4JX0QQ43fd6ifHdyaeGzcsc18bCGktGNDDgSEIC0zxRKKIoRqGOXBszNo5iWgxJhqdI97dFWB5qHWlmPlPqKeeF3vy4a4QPUTt_WakLGUcg9Hpxt1pHBIIbYx1ugfyQM011xarf3yZwrOI9aMujOtI1l2rXjDR-hEWqX3y" />
                <div
                    class="absolute inset-0 bg-black/40 flex items-center justify-center hover:bg-black/50 transition-colors">
                    <h4 class="text-white font-headline font-bold text-2xl uppercase tracking-widest">Khách Sạn</h4>
                </div>
            </a>
        </div>
    </div>
</section>


