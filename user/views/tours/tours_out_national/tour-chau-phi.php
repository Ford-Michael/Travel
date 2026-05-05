<?php
$headExtra = <<<HTML
<style>
    .glass-badge {
        background: rgba(43, 91, 181, 0.4);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    .editorial-shadow {
        box-shadow: 0px 12px 32px rgba(25, 28, 29, 0.06);
    }
    .signature-gradient {
        background: linear-gradient(135deg, #2b5bb5 0%, #00337c 100%);
    }
</style>
HTML;
?>
<main class="pt-20">
<!-- Minimalist Hero with Large Typography -->
<section class="bg-[#1A1A1A] text-white pt-32 pb-24 px-8 relative overflow-hidden">
<div class="absolute inset-0 opacity-40">
<img class="w-full h-full object-cover" data-alt="Black and white artistic photograph of an African elephant walking on the savannah dust swirling around its feet" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAx89kL4rB7n6m5q2g7l5o2K0u4_3J9p1M8Z6a3d9zT5b7S1e6N8wY4p0f2x9s7H4a1k3R5n2b6Z9y2P5m9x7L8g1v4V3h7X5z0D9T2l5e8C6k4O9M3q6Y0b8W1i3X7y5U4x2z6P9h7s5t4_A1m6n2G9_Z8D4c2o9C5b1a3d5e7V8r0j2y6_M4q9_7N1x3c5M0b8y4T"/>
<div class="absolute inset-0 bg-gradient-to-t from-[#1A1A1A] to-transparent"></div>
</div>
<div class="max-w-7xl mx-auto relative z-10">
<div class="flex flex-col lg:flex-row justify-between items-end">
<div class="max-w-3xl">
<p class="text-[#ff645a] font-bold tracking-[0.3em] text-sm mb-6 uppercase">The Wild Frontier</p>
<h1 class="font-headline text-6xl md:text-8xl font-black leading-none mb-6">Châu Phi <br/><span class="text-white/50 italic font-light">Hoang Dã</span></h1>
</div>
<div class="max-w-sm mb-4 lg:mb-0">
<p class="text-lg text-white/80 leading-relaxed mb-8">Nơi sinh mệnh bắt đầu. Trải nghiệm thiên nhiên nguyên bản và sự vĩ đại của thế giới động vật trong các chuyến đi Safari đẳng cấp.</p>
<button class="bg-white text-[#1A1A1A] px-8 py-4 rounded-none font-bold uppercase tracking-wider text-sm hover:bg-[#ff645a] hover:text-white transition-colors duration-300 w-full md:w-auto">Bắt Đầu Thám Hiểm</button>
</div>
</div>
</div>
</section>
<!-- Editorial Photo Layout -->
<section class="py-24 bg-surface">
<div class="max-w-7xl mx-auto px-8">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<!-- Column 1 -->
<div class="space-y-8 mt-12">
<h2 class="font-headline text-4xl font-bold text-on-secondary-fixed leading-tight">Vẻ Đẹp <br/>Nguyên Sơ</h2>
<p class="text-on-surface-variant leading-relaxed">Nam Phi không chỉ có thiên nhiên hoang dã mà còn sở hữu những cung đường tuyệt mỹ, các xưởng rượu vang danh tiếng và thành phố Cape Town hiện đại nằm dưới chân Núi Bàn.</p>
<div class="aspect-[3/4] overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" data-alt="Close up of a lioness resting in tall golden grass illuminated by warm sunset light" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2m7x8Z9n3y1A4w5V6k7O8c9P0q1D2l3G4x5s6T7u8V9N0m1a2b3C4d5E6f7G8h9I0j1k2L3m4n5O6p7Q8r9S0t1u2V3w4X5y6Z7A8b9C0d1e2F3g4H5i6J7k8L9m0N1o2P3q4R5s6T7u8V9W0x1y2Z3A4B5c6D7e8F9g0H1i2J3k4L5m6N7o8P9q0R1s2T3u4V5w6X7y8Z9"/>
</div>
</div>
<!-- Column 2 -->
<div class="space-y-8">
<div class="aspect-[4/5] overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" data-alt="Iconic view of Table Mountain in Cape Town South Africa with the city and harbor below under a clear blue sky" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC1n2y3X4z5A6b7C8d9E0f1G2h3I4j5K6l7M8n9O0p1Q2r3S4t5U6v7W8x9Y0z1A2b3C4d5E6f7G8h9I0j1k2L3m4n5O6p7Q8r9S0t1u2V3w4X5y6Z7A8b9C0d1e2F3g4H5i6J7k8L9m0N1o2P3q4R5s6T7u8V9W0x1y2Z3A4B5c6D7e8F9g0H1i2J3k4L5m6N7o8P9q0R1s2T3u4V5w6X7y8Z9"/>
</div>
<div class="bg-surface-container-low p-8 editorial-shadow">
<h3 class="font-bold text-xl mb-3">Trải Nghiệm Safari</h3>
<p class="text-sm text-outline-variant mb-4">Chiêm ngưỡng "Big Five" (Sư tử, Báo, Voi, Tê giác, Trâu rừng) trong môi trường sống tự nhiên của chúng tại Kruger National Park.</p>
<a class="text-[#2b5bb5] font-bold text-sm uppercase tracking-wider hover:underline" href="#">Tìm Hiểu Thêm</a>
</div>
</div>
<!-- Column 3 -->
<div class="space-y-8 mt-24">
<div class="aspect-square overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" data-alt="Elegant glass of red wine being held in front of lush green vineyards in South Africa's wine region" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9e0F1g2H3i4J5k6L7m8N9o0P1q2R3s4T5u6V7w8X9y0Z1a2B3c4D5e6F7g8H9i0J1k2L3m4N5o6P7q8R9s0T1u2V3w4X5y6Z7A8b9C0d1e2F3g4H5i6J7k8L9m0N1o2P3q4R5s6T7u8V9W0x1y2Z3A4B5c6D7e8F9g0H1i2J3k4L5m6N7o8P9q0R1s2T3u4V5w6X7y8Z9"/>
</div>
<p class="text-on-surface-variant italic font-serif text-lg">"Châu Phi thay đổi bạn vĩnh viễn, giống như không có nơi nào khác trên trái đất." - Richard Mullin</p>
</div>
</div>
</div>
</section>
<?php include __DIR__ . '/_db_tours_section.php'; ?>

<!-- Deep Dive Notice -->
<section class="signature-gradient py-20 text-white text-center">
<div class="max-w-4xl mx-auto px-8">
<span class="material-symbols-outlined text-5xl mb-6 text-white/50">info</span>
<h2 class="text-3xl font-bold mb-4">Lưu Ý Về Tiêm Chủng &amp; Visa Châu Phi</h2>
<p class="text-white/80 text-lg mb-8">Một số quốc gia Châu Phi yêu cầu giấy chứng nhận tiêm phòng sốt vàng da (Yellow Fever). Đội ngũ chuyên gia của Viet Sun Travel sẽ tư vấn và hỗ trợ chi tiết các thủ tục Visa và Y tế cho hành trình của bạn.</p>
<button class="border-2 border-white px-8 py-3 font-bold hover:bg-white hover:text-[#00337c] transition-colors">Tư Vấn Thêm</button>
</div>
</section>
</main>
