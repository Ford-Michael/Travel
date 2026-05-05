<?php
/**
 * Promotion / Khuyến Mãi Page
 * Travel Bling User Site
 */
?>

<?php
if (!function_exists('promoPriceText')) {
    function promoPriceText($tour) {
        $price = (float) ($tour['priceAdult'] ?? $tour['price'] ?? 0);
        return $price > 0 ? number_format($price, 0, ',', '.') . '₫' : 'Liên hệ';
    }
}

if (!function_exists('promoDiscountPercent')) {
    function promoDiscountPercent($tour) {
        $discount = (float) ($tour['promoDiscount'] ?? 0);
        return $discount > 0 ? $discount : 0;
    }
}
?>

<!-- ===== HERO BANNER ===== -->
<section class="relative h-[520px] flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img class="w-full h-full object-cover"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDX3X4s-zPbOyMfV4MntT5JQNeLykljpTQU5K4X85Y-vKInMdkip-IX37dR2DKUJIMmS5dUXJlEXQgGBq5eRuU1fUiL4TDn8lhOgqWOx-A_52zTmE3gSmiWl7W51XeCxgAptX4SbL9DFLTcTcYy3jLmVVQ17HG-ByBM3YMSSEVNJjGQjFG2cfU7yb6qfJvThzThzKHLKV5tgKq_WTpxFy1gUxW2IndflhVBWDRZdhkbcOZM0GfdgFlPiGSBBC4r3VgKefTSBTYbTcFJ"
            alt="Khuyến mãi du lịch" />
        <div class="absolute inset-0 bg-gradient-to-r from-[#00337c]/90 via-[#00337c]/60 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-8 w-full">
        <div class="max-w-2xl">
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-[#ff645a] text-3xl" style="font-variation-settings:'FILL' 1">local_fire_department</span>
                <span class="text-[#ff645a] font-bold tracking-widest uppercase text-sm font-headline">Hot Deals</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-headline font-extrabold text-white leading-tight tracking-tight mb-6">
                KHUYẾN MÃI <br /><span class="text-[#ff645a]">ĐẶC BIỆT</span>
            </h1>
            <p class="text-lg text-slate-200 leading-relaxed max-w-lg mb-8">
                Săn deal du lịch hấp dẫn với ưu đãi lên đến <strong class="text-[#ff645a]">50%</strong>. Cơ hội có hạn — đặt ngay để khám phá thế giới cùng Travel Bling!
            </p>
            <a href="#deals"
                class="inline-flex items-center gap-2 bg-[#ff645a] text-white px-8 py-4 rounded-lg font-bold text-lg shadow-lg hover:brightness-110 hover:scale-105 transition-all duration-300">
                <span class="material-symbols-outlined">arrow_downward</span>
                Xem Ưu Đãi
            </a>
        </div>
    </div>
</section>

<!-- ===== FLASH DEAL COUNTDOWN ===== -->
<section class="bg-gradient-to-r from-[#e84c3d] to-[#ff645a] py-6 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-white"></div>
        <div class="absolute -left-10 -bottom-10 w-60 h-60 rounded-full bg-white"></div>
    </div>
    <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row items-center justify-between gap-6 relative z-10">
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined text-white text-4xl animate-pulse" style="font-variation-settings:'FILL' 1">timer</span>
            <div>
                <h3 class="text-white font-headline font-extrabold text-2xl">⚡ Flash Sale Đang Diễn Ra!</h3>
                <p class="text-white/80 text-sm">Ưu đãi kết thúc trong thời gian giới hạn</p>
            </div>
        </div>
        <div class="flex gap-3" id="countdown">
            <div class="bg-white/20 backdrop-blur-md rounded-xl px-5 py-3 text-center min-w-[70px]">
                <span class="text-white font-headline font-extrabold text-3xl block" id="cd-days">03</span>
                <span class="text-white/70 text-xs uppercase tracking-wider">Ngày</span>
            </div>
            <div class="bg-white/20 backdrop-blur-md rounded-xl px-5 py-3 text-center min-w-[70px]">
                <span class="text-white font-headline font-extrabold text-3xl block" id="cd-hours">12</span>
                <span class="text-white/70 text-xs uppercase tracking-wider">Giờ</span>
            </div>
            <div class="bg-white/20 backdrop-blur-md rounded-xl px-5 py-3 text-center min-w-[70px]">
                <span class="text-white font-headline font-extrabold text-3xl block" id="cd-mins">45</span>
                <span class="text-white/70 text-xs uppercase tracking-wider">Phút</span>
            </div>
            <div class="bg-white/20 backdrop-blur-md rounded-xl px-5 py-3 text-center min-w-[70px]">
                <span class="text-white font-headline font-extrabold text-3xl block" id="cd-secs">30</span>
                <span class="text-white/70 text-xs uppercase tracking-wider">Giây</span>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    // Set countdown to 3 days from now
    const endDate = new Date();
    endDate.setDate(endDate.getDate() + 3);
    endDate.setHours(23, 59, 59, 0);

    function updateCountdown() {
        const now = new Date();
        const diff = endDate - now;
        if (diff <= 0) return;

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const secs = Math.floor((diff % (1000 * 60)) / 1000);

        document.getElementById('cd-days').textContent = String(days).padStart(2, '0');
        document.getElementById('cd-hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('cd-mins').textContent = String(mins).padStart(2, '0');
        document.getElementById('cd-secs').textContent = String(secs).padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
})();
</script>

<!-- ===== WHY CHOOSE US BADGES ===== -->
<section class="py-16 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl text-center group hover:-translate-y-2 transition-all duration-500 shadow-sm hover:shadow-lg">
                <div class="w-16 h-16 bg-[#ff645a]/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#ff645a]/20 transition-colors">
                    <span class="material-symbols-outlined text-[#ff645a] text-3xl" style="font-variation-settings:'FILL' 1">percent</span>
                </div>
                <h4 class="font-headline font-bold text-on-secondary-fixed text-lg mb-1">Giảm đến 50%</h4>
                <p class="text-on-surface-variant text-sm">Cho các tour hot nhất</p>
            </div>
            <div class="bg-white p-6 rounded-xl text-center group hover:-translate-y-2 transition-all duration-500 shadow-sm hover:shadow-lg">
                <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-secondary/20 transition-colors">
                    <span class="material-symbols-outlined text-secondary text-3xl" style="font-variation-settings:'FILL' 1">verified</span>
                </div>
                <h4 class="font-headline font-bold text-on-secondary-fixed text-lg mb-1">Cam kết giá tốt</h4>
                <p class="text-on-surface-variant text-sm">Hoàn tiền nếu tìm rẻ hơn</p>
            </div>
            <div class="bg-white p-6 rounded-xl text-center group hover:-translate-y-2 transition-all duration-500 shadow-sm hover:shadow-lg">
                <div class="w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-500/20 transition-colors">
                    <span class="material-symbols-outlined text-green-500 text-3xl" style="font-variation-settings:'FILL' 1">shield</span>
                </div>
                <h4 class="font-headline font-bold text-on-secondary-fixed text-lg mb-1">Đảm bảo chất lượng</h4>
                <p class="text-on-surface-variant text-sm">Khách sạn 4-5 sao</p>
            </div>
            <div class="bg-white p-6 rounded-xl text-center group hover:-translate-y-2 transition-all duration-500 shadow-sm hover:shadow-lg">
                <div class="w-16 h-16 bg-amber-500/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-500/20 transition-colors">
                    <span class="material-symbols-outlined text-amber-500 text-3xl" style="font-variation-settings:'FILL' 1">card_giftcard</span>
                </div>
                <h4 class="font-headline font-bold text-on-secondary-fixed text-lg mb-1">Quà tặng kèm</h4>
                <p class="text-on-surface-variant text-sm">Bảo hiểm + vali miễn phí</p>
            </div>
        </div>
    </div>
</section>

<!-- ===== HOT DEALS SECTION ===== -->
<section class="py-24 bg-surface" id="deals">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-px w-12 bg-[#e84c3d]"></div>
                    <span class="text-[#e84c3d] font-bold tracking-[0.2em] uppercase text-xs">Ưu Đãi Nổi Bật</span>
                </div>
                <h2 class="text-on-secondary-fixed font-headline font-extrabold text-4xl">DEAL TOUR SIÊU HOT 🔥</h2>
            </div>
            <!-- Filter Tabs -->
            <div class="flex gap-2 flex-wrap">
                <button class="promo-tab active bg-[#00337c] text-white px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all" data-filter="all">Tất Cả</button>
                <button class="promo-tab bg-surface-container-high text-on-surface-variant px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider hover:bg-[#00337c] hover:text-white transition-all" data-filter="domestic">Trong Nước</button>
                <button class="promo-tab bg-surface-container-high text-on-surface-variant px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider hover:bg-[#00337c] hover:text-white transition-all" data-filter="international">Ngoài Nước</button>
                <button class="promo-tab bg-surface-container-high text-on-surface-variant px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider hover:bg-[#00337c] hover:text-white transition-all" data-filter="flash">Flash Sale</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="promo-grid">
            <?php if (empty($promoTours)): ?>
                <div class="md:col-span-3 bg-white border border-dashed border-slate-300 rounded-2xl p-10 text-center text-slate-500">
                    Chưa có dữ liệu tour bán chạy để hiển thị khuyến mãi.
                </div>
            <?php else: ?>
                <?php foreach ($promoTours as $index => $tour): ?>
                    <?php
                    $isDomestic = !empty($tour['domesticRegion']);
                    $isFlash = ((float) ($tour['promoDiscount'] ?? 0)) > 0;
                    $category = trim(($isDomestic ? 'domestic' : 'international') . ' ' . ($isFlash ? 'flash' : ''));
                    $discount = promoDiscountPercent($tour);
                    $price = (float) ($tour['priceAdult'] ?? $tour['price'] ?? 0);
                    $salePrice = $price > 0 ? $price * (100 - $discount) / 100 : 0;
                    $image = htmlspecialchars((string) ($tour['heroImage'] ?? ''), ENT_QUOTES, 'UTF-8');
                    $name = htmlspecialchars((string) ($tour['tour_name'] ?? 'Tour'), ENT_QUOTES, 'UTF-8');
                    $duration = htmlspecialchars((string) ($tour['duration'] ?? 'Đang cập nhật'), ENT_QUOTES, 'UTF-8');
                    $destination = htmlspecialchars((string) ($tour['destination'] ?? 'Đang cập nhật'), ENT_QUOTES, 'UTF-8');
                    $tourId = (int) ($tour['tourID'] ?? 0);
                    $purchaseCount = (int) ($tour['purchaseCount'] ?? 0);
                    ?>
                    <div class="promo-card bg-white rounded-2xl overflow-hidden group hover:shadow-2xl transition-all duration-500" data-category="<?php echo $category; ?>">
                        <div class="relative h-64 overflow-hidden">
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="<?php echo $image; ?>" alt="<?php echo $name; ?>" />
                            <div class="absolute top-4 left-4 bg-[#00337c] text-white px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider shadow-lg">
                                <?php echo $isFlash ? 'Đang sale' : 'Bán chạy'; ?>
                            </div>
                            <?php if ($discount > 0): ?>
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-[#e84c3d] px-3 py-1.5 rounded-lg text-xs font-extrabold shadow-lg">
                                    -<?php echo rtrim(rtrim(number_format($discount, 2, '.', ''), '0'), '.'); ?>%
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 text-xs text-outline font-medium mb-3">
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_today</span> <?php echo $duration; ?></span>
                                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">location_on</span> <?php echo $destination; ?></span>
                            </div>
                            <h3 class="text-on-secondary-fixed font-headline font-bold text-lg mb-4 line-clamp-2">
                                <?php echo $name; ?>
                            </h3>
                            <?php if ($discount > 0): ?>
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="text-outline line-through text-sm"><?php echo promoPriceText($tour); ?></span>
                                    <span class="text-[#e84c3d] font-headline font-extrabold text-2xl">
                                        <?php echo $salePrice > 0 ? number_format($salePrice, 0, ',', '.') . '₫' : 'Liên hệ'; ?>
                                    </span>
                                </div>
                            <?php else: ?>
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="text-[#e84c3d] font-headline font-extrabold text-2xl"><?php echo promoPriceText($tour); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2 text-xs text-on-surface-variant">
                                    <span class="material-symbols-outlined text-sm text-amber-500" style="font-variation-settings:'FILL' 1">shopping_bag</span>
                                    Đã mua: <?php echo $purchaseCount; ?>
                                </div>
                                <a href="index.php?controller=tour&action=detail&id=<?php echo $tourId; ?>" class="bg-[#00337c] text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-[#e84c3d] transition-colors flex items-center gap-1">
                                    Đặt Ngay <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Load More -->
        <div class="text-center mt-12">
            <a href="index.php?controller=tour"
                class="inline-flex items-center gap-2 border-2 border-[#00337c] text-[#00337c] px-10 py-3 rounded-full font-bold text-sm hover:bg-[#00337c] hover:text-white transition-all duration-300">
                <span class="material-symbols-outlined text-sm">grid_view</span>
                Xem Tất Cả Tour
            </a>
        </div>
    </div>
</section>

<!-- Filter Tab Script -->
<script>
(function() {
    const tabs = document.querySelectorAll('.promo-tab');
    const cards = document.querySelectorAll('.promo-card');

    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            // Update active state
            tabs.forEach(function(t) {
                t.classList.remove('bg-[#00337c]', 'text-white', 'active');
                t.classList.add('bg-surface-container-high', 'text-on-surface-variant');
            });
            this.classList.remove('bg-surface-container-high', 'text-on-surface-variant');
            this.classList.add('bg-[#00337c]', 'text-white', 'active');

            var filter = this.dataset.filter;

            cards.forEach(function(card) {
                if (filter === 'all' || card.dataset.category.includes(filter)) {
                    card.style.display = '';
                    card.style.animation = 'fadeInUp 0.5s ease forwards';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
})();
</script>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- ===== EXCLUSIVE COMBO BANNER ===== -->
<section class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-8">
        <div class="bg-gradient-to-br from-[#00337c] via-[#2b5bb5] to-[#00337c] rounded-3xl overflow-hidden shadow-2xl relative">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white transform translate-x-1/3 -translate-y-1/3"></div>
                <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full bg-white transform -translate-x-1/4 translate-y-1/4"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 relative z-10">
                <div class="p-12 md:p-16 flex flex-col justify-center">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-amber-400 text-2xl" style="font-variation-settings:'FILL' 1">workspace_premium</span>
                        <span class="text-amber-400 font-bold uppercase text-sm tracking-widest">Combo Độc Quyền</span>
                    </div>
                    <h2 class="text-white font-headline font-extrabold text-4xl md:text-5xl leading-tight mb-6">
                        Tour + Vé Máy Bay <br/><span class="text-[#ff645a]">Tiết kiệm 50%</span>
                    </h2>
                    <p class="text-white/80 text-lg leading-relaxed mb-8 max-w-md">
                        Đặt combo Tour kèm Vé máy bay để nhận ưu đãi khủng. Áp dụng cho tất cả các tour quốc tế từ nay đến hết tháng 6.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="index.php?controller=tour"
                            class="bg-[#ff645a] text-white px-8 py-4 rounded-xl font-bold text-lg hover:brightness-110 hover:scale-105 transition-all shadow-lg inline-flex items-center gap-2">
                            <span class="material-symbols-outlined">flight_takeoff</span>
                            Đặt Combo Ngay
                        </a>
                        <a href="index.php?controller=home&action=contact"
                            class="border-2 border-white/30 text-white px-8 py-4 rounded-xl font-bold hover:bg-white hover:text-[#00337c] transition-all inline-flex items-center gap-2">
                            <span class="material-symbols-outlined">call</span>
                            Tư Vấn Miễn Phí
                        </a>
                    </div>
                </div>
                <div class="relative h-[400px] md:h-auto">
                    <img class="w-full h-full object-cover"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDkke-5gE4RTTChbx2IbyK2KtZwVreiY5tBEPOx_NcNTG8YGVlABdIKOv0NOmtNnzYeSLxNm7qJMDyvCn1pG4VzoL0A2BZ9yijTErZznSb1uAf8fk49amTU-mbV7R3uiJNNj9RhHE0I-8lYvPJqvhr9EEgKuJ_4rjzCTmvyqJexvyRoI33sPiDGsp5-W_3UmSOuF4yut6xzlm2aKsg4YG2jMcYjI-TwH4z7L4X5m3cy7zFBOSBwFm91vxcAJdRnGT34CRObux-4E9Cm"
                        alt="Combo du lịch" />
                    <div class="absolute inset-0 bg-gradient-to-l from-transparent to-[#00337c]/40"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== VOUCHER / COUPON SECTION ===== -->
<section class="py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-8">
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-4">
                <span class="material-symbols-outlined text-[#e84c3d] text-2xl" style="font-variation-settings:'FILL' 1">confirmation_number</span>
                <span class="text-[#e84c3d] font-bold tracking-[0.2em] uppercase text-xs">Mã Giảm Giá</span>
            </div>
            <h2 class="text-on-secondary-fixed font-headline font-extrabold text-4xl mb-4">VOUCHER ĐẶC QUYỀN</h2>
            <p class="text-on-surface-variant max-w-xl mx-auto">Nhập mã ngay khi đặt tour để nhận ưu đãi thêm. Số lượng có hạn!</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Voucher 1 -->
            <div class="relative bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow group">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#e84c3d] to-[#ff645a]"></div>
                <div class="p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <span class="text-[#e84c3d] font-headline font-extrabold text-5xl">500K</span>
                            <p class="text-on-surface-variant text-sm mt-1">Giảm trực tiếp</p>
                        </div>
                        <div class="w-14 h-14 bg-[#e84c3d]/10 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-[#e84c3d] text-2xl" style="font-variation-settings:'FILL' 1">redeem</span>
                        </div>
                    </div>
                    <p class="text-on-surface-variant text-sm mb-6 leading-relaxed">Áp dụng cho tour trong nước từ 5 triệu. Không giới hạn số lần sử dụng.</p>
                    <div class="flex items-center justify-between">
                        <div class="bg-gray-50 border-2 border-dashed border-[#e84c3d] rounded-lg px-4 py-2">
                            <code class="text-[#e84c3d] font-mono font-bold text-lg tracking-widest">TRAVEL500</code>
                        </div>
                        <button class="copy-btn text-secondary font-bold text-sm hover:text-[#e84c3d] transition-colors flex items-center gap-1" data-code="TRAVEL500">
                            <span class="material-symbols-outlined text-sm">content_copy</span> Copy
                        </button>
                    </div>
                    <p class="text-xs text-outline mt-4">HSD: 30/06/2026 • Còn 156 mã</p>
                </div>
            </div>

            <!-- Voucher 2 -->
            <div class="relative bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow group">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#00337c] to-secondary"></div>
                <div class="p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <span class="text-[#00337c] font-headline font-extrabold text-5xl">1.5M</span>
                            <p class="text-on-surface-variant text-sm mt-1">Giảm trực tiếp</p>
                        </div>
                        <div class="w-14 h-14 bg-secondary/10 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings:'FILL' 1">redeem</span>
                        </div>
                    </div>
                    <p class="text-on-surface-variant text-sm mb-6 leading-relaxed">Áp dụng cho tour quốc tế từ 20 triệu. Đặc biệt ưu tiên khách VIP.</p>
                    <div class="flex items-center justify-between">
                        <div class="bg-gray-50 border-2 border-dashed border-[#00337c] rounded-lg px-4 py-2">
                            <code class="text-[#00337c] font-mono font-bold text-lg tracking-widest">VIP1500K</code>
                        </div>
                        <button class="copy-btn text-secondary font-bold text-sm hover:text-[#e84c3d] transition-colors flex items-center gap-1" data-code="VIP1500K">
                            <span class="material-symbols-outlined text-sm">content_copy</span> Copy
                        </button>
                    </div>
                    <p class="text-xs text-outline mt-4">HSD: 31/05/2026 • Còn 89 mã</p>
                </div>
            </div>

            <!-- Voucher 3 -->
            <div class="relative bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow group">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-amber-500 to-amber-400"></div>
                <div class="p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <span class="text-amber-600 font-headline font-extrabold text-5xl">10%</span>
                            <p class="text-on-surface-variant text-sm mt-1">Giảm tối đa 3 triệu</p>
                        </div>
                        <div class="w-14 h-14 bg-amber-500/10 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-amber-500 text-2xl" style="font-variation-settings:'FILL' 1">redeem</span>
                        </div>
                    </div>
                    <p class="text-on-surface-variant text-sm mb-6 leading-relaxed">Dành riêng cho thành viên mới đăng ký. Áp dụng tất cả các tour.</p>
                    <div class="flex items-center justify-between">
                        <div class="bg-gray-50 border-2 border-dashed border-amber-500 rounded-lg px-4 py-2">
                            <code class="text-amber-600 font-mono font-bold text-lg tracking-widest">NEWBIE10</code>
                        </div>
                        <button class="copy-btn text-secondary font-bold text-sm hover:text-[#e84c3d] transition-colors flex items-center gap-1" data-code="NEWBIE10">
                            <span class="material-symbols-outlined text-sm">content_copy</span> Copy
                        </button>
                    </div>
                    <p class="text-xs text-outline mt-4">HSD: 31/12/2026 • Không giới hạn</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Copy Voucher Script -->
<script>
(function() {
    document.querySelectorAll('.copy-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var code = this.dataset.code;
            navigator.clipboard.writeText(code).then(function() {
                btn.innerHTML = '<span class="material-symbols-outlined text-sm">check</span> Đã copy!';
                btn.classList.add('text-green-500');
                setTimeout(function() {
                    btn.innerHTML = '<span class="material-symbols-outlined text-sm">content_copy</span> Copy';
                    btn.classList.remove('text-green-500');
                }, 2000);
            });
        });
    });
})();
</script>

<!-- ===== NEWSLETTER CTA ===== -->
<section class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-8">
        <div class="bg-white rounded-3xl p-12 md:p-16 flex flex-col md:flex-row items-center gap-12 shadow-lg relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-[#ff645a]/5"></div>
            <div class="absolute -left-10 -bottom-10 w-60 h-60 rounded-full bg-secondary/5"></div>
            <div class="flex-1 relative z-10">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-[#ff645a]" style="font-variation-settings:'FILL' 1">notifications_active</span>
                    <span class="text-[#ff645a] font-bold text-sm uppercase tracking-wider">Đừng bỏ lỡ</span>
                </div>
                <h2 class="text-on-secondary-fixed font-headline font-extrabold text-3xl md:text-4xl mb-4">Nhận Ưu Đãi Sớm Nhất</h2>
                <p class="text-on-surface-variant text-lg max-w-md">Đăng ký ngay để nhận thông báo khuyến mãi, flash sale và voucher giảm giá độc quyền từ Travel Bling.</p>
            </div>
            <div class="flex-1 w-full max-w-md relative z-10">
                <div class="flex gap-3">
                    <input class="flex-1 bg-surface-container-low border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-secondary/30 font-medium text-on-surface" placeholder="Email của bạn..." type="email" />
                    <button class="bg-[#e84c3d] text-white px-8 py-4 rounded-xl font-bold hover:brightness-110 transition-all shadow-lg whitespace-nowrap flex items-center gap-2">
                        <span class="material-symbols-outlined">send</span>
                        Đăng Ký
                    </button>
                </div>
                <p class="text-xs text-outline mt-4 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm text-green-500">lock</span>
                    Thông tin của bạn được bảo mật tuyệt đối. Hủy đăng ký bất cứ lúc nào.
                </p>
            </div>
        </div>
    </div>
</section>
