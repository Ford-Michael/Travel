<?php
$headExtra = <<<HTML
<style>
    .glass-badge {
        background: rgba(43, 91, 181, 0.4);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    .editorial-shadow:hover {
        box-shadow: 0px 12px 32px rgba(25, 28, 29, 0.06);
    }
    .bleed-img {
        width: calc(100% + 40px);
        margin-left: -20px;
    }
</style>
HTML;
?>
<main class="bg-background text-on-surface">
<!-- Hero Section -->
<section class="relative h-[870px] w-full overflow-hidden flex items-center">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="Sydney Opera House and Harbour Bridge at dusk with glowing city lights and colorful sunset sky" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMsZ5_i93t1mC3R566sPSTsW2vJ_0e90cW0O17X51_x22zN5Ea-s10E9NlXmNWeE3X5gO9r7ZkG2yLpX3f5n360p21mZ0O1a6yM26g-8N4wMhV9T01W_NusxN5K0m_kI5_y1A9UuK1JqQ1H0T0x3zT2r1uXl1o2b52o18WnL81k1T0c2w6q58aR10Vf5hZz940yH5_dO383q2yq7R3l2t0iH8WJm5s6D9O"/>
<div class="absolute inset-0 bg-gradient-to-r from-[#00337c]/80 via-transparent to-transparent"></div>
</div>
<div class="container mx-auto px-8 lg:px-12 relative z-10">
<div class="max-w-2xl text-white">
<div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md rounded-full mb-6">
<span class="material-symbols-outlined text-sm">explore</span>
<span class="text-xs font-bold tracking-widest uppercase">Nam Bán Cầu Chờ Đón</span>
</div>
<h1 class="text-6xl md:text-8xl font-headline font-black mb-6 leading-[0.9] tracking-tighter">
                    Oceania <br/> <span class="text-[#759efd]">Odyssey</span>
</h1>
<p class="text-lg md:text-xl text-white/90 leading-relaxed mb-10 max-w-xl">
                    Chạm đến thiên nhiên nguyên sơ, trải nghiệm cuộc sống thanh bình của nước Úc và vẻ đẹp hùng vĩ của New Zealand. Một hành trình khơi dậy mọi giác quan.
                </p>
<div class="flex flex-wrap gap-4">
<button class="bg-[#ff645a] text-white px-8 py-4 rounded-md font-bold transition-all hover:bg-white hover:text-[#ff645a]">Khám Phá Tour Úc</button>
<button class="border border-white/50 text-white px-8 py-4 rounded-md font-bold transition-all hover:bg-white/10">Tour New Zealand</button>
</div>
</div>
</div>
</section>
<!-- Content Sections -->
<section class="bg-surface-container-low pt-24 pb-32">
<div class="container mx-auto px-8 lg:px-12">
<!-- Intro -->
<div class="flex flex-col md:flex-row justify-between items-end mb-16 border-b border-outline-variant/30 pb-10">
<div class="max-w-3xl">
<h2 class="text-4xl font-headline font-extrabold text-on-secondary-fixed mb-4">Điểm Chạm Thiên Nhiên Đích Thực</h2>
<p class="text-xl text-on-surface-variant">Không chỉ là những thành phố hiện đại, Châu Úc là bức tranh tuyệt mỹ của tự nhiên.</p>
</div>
<div class="mt-8 md:mt-0">
<div class="text-5xl font-black text-[#2b5bb5] opacity-20">01</div>
</div>
</div>
<!-- Destinations Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-24">
<!-- Destination 1 -->
<div class="group cursor-pointer">
<div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-6">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Aerial view of the Great Barrier Reef in Australia showing vibrant turquoise waters and intricate coral formations" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAn-R1k9W-I8-o95I-7cT5m8a52x_ZpQ7R3nQ0Tq41w-sT37lU_o6aX_R0O_R41e24-6h9Q8GZ8K1zE9yQ6wJ9yT8F-rT_g-n9nZ2x0aH2tZqX9U_E69G3e6G8oZ-8yK3x2t6G_b5K1L9pQ5_H8E4fO_kZ1eT3_1I3Y3x1D7o8_tL5Y-x9aL1uH7y3sA2vG_Z8rD1d_E9dE4cO8h-K2X6z9D8m2T1Q"/>
<div class="absolute bottom-4 left-4 glass-badge px-3 py-1 rounded text-white text-xs font-bold uppercase tracking-wider">Úc</div>
</div>
<h3 class="text-3xl font-bold font-headline text-on-secondary-fixed mb-3">Great Barrier Reef</h3>
<p class="text-on-surface-variant line-clamp-2">Kỳ quan san hô lớn nhất thế giới, nơi bạn có thể bơi lặn cùng hàng ngàn loài sinh vật biển độc đáo.</p>
<div class="mt-4 flex items-center text-[#ff645a] font-bold text-sm">
                        Xem chi tiết <span class="material-symbols-outlined ml-1 text-sm">arrow_outward</span>
</div>
</div>
<!-- Destination 2 -->
<div class="group cursor-pointer lg:mt-24">
<div class="relative rounded-2xl overflow-hidden aspect-[4/3] mb-6">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Breathtaking view of Milford Sound in New Zealand with dramatic cliffs waterfalls and calm dark waters" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBC3E0zQpXgH9F_uI2tP-1kH_Xm5uC-wI8_8u7nO-3u_1P7nU-6mH8vA2zR3gW_bH0g-O9n2wT7eQ_1Y_zJ9hU7I8fA9b-7uY8kG-X5wH1u_4pE6-I7nI-2oF9qK-X1P8pW5aG5-M2sE3_pZ8yN_o2X_a2yF7aV7iO-0iI_3hA-Y2r_V8xT_kE6wN5zX_5vY7G_7U5f_Z0nB7T9zJ-x_M4uT_1P"/>
<div class="absolute bottom-4 left-4 glass-badge px-3 py-1 rounded text-white text-xs font-bold uppercase tracking-wider">New Zealand</div>
</div>
<h3 class="text-3xl font-bold font-headline text-on-secondary-fixed mb-3">Milford Sound</h3>
<p class="text-on-surface-variant line-clamp-2">Bản hòa ca của đá và nước, một trong những vịnh biển ngoạn mục nhất hành tinh.</p>
<div class="mt-4 flex items-center text-[#ff645a] font-bold text-sm">
                        Xem chi tiết <span class="material-symbols-outlined ml-1 text-sm">arrow_outward</span>
</div>
</div>
</div>
</div>
</section>
<!-- Tour Listing -->
<?php include __DIR__ . '/_db_tours_section.php'; ?>



<!-- Mini Editorial CTA -->
<section class="py-24 bg-surface">
<div class="container mx-auto px-8 lg:px-12 max-w-4xl text-center">
<span class="material-symbols-outlined text-6xl text-[#ff645a] mb-6">flight_takeoff</span>
<h2 class="text-4xl md:text-5xl font-headline font-bold text-on-secondary-fixed mb-8">Bạn Đã Sẵn Sàng Bay?</h2>
<p class="text-lg text-on-surface-variant mb-10 max-w-2xl mx-auto">Thủ tục Visa Úc và New Zealand sẽ được Viet Sun Travel hỗ trợ toàn diện từ A-Z với tỷ lệ đậu cao. Bạn chỉ cần lên kế hoạch trải nghiệm.</p>
<div class="bg-surface-container-low p-8 rounded-2xl inline-block editorial-shadow text-left">
<div class="flex items-center gap-4 mb-4">
<span class="material-symbols-outlined text-[#2b5bb5] text-3xl">contact_support</span>
<div>
<p class="font-bold text-on-secondary-fixed">Tổng đài Tư vấn Visa &amp; Tour</p>
<p class="text-[#ff645a] font-black text-2xl">1900 2323 23</p>
</div>
</div>
<p class="text-sm text-outline-variant">Giờ làm việc: 8:00 - 18:00 (Thứ 2 - Thứ 7)</p>
</div>
</div>
</section>
</main>
