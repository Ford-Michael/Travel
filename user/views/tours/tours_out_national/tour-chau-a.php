<?php
$headExtra = <<<HTML
<style>
    .editorial-bleed {
        margin-right: -10vw;
    }
    .glass-badge {
        background: rgba(43, 91, 181, 0.4);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
</style>
HTML;
?>
<main class="pt-20">
<!-- Hero Section -->
<section class="relative h-[921px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="Cinematic wide shot of a traditional Japanese pagoda at sunset surrounded by cherry blossoms with soft golden lighting and mountain backdrop" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4NyKnF043DaVf3mBzAAs78g2lgFq1aMWrI0zkUh51KaWM3Rh8xi8fWK3rYMVeBHnEp_IgIt4j7_dInd8B8U-tBd-u2NKXY40W7X7Y5y5R0GxhuZxwQWNCGm3-J_lao-usKs1fFVupikYb56PN9cY8t7ldgk-803qwIG2qAQF08oGYXVQsXeJmwR5yJ7k96OnwuLL4DugDTpr30bK_V6hyGPirynw4vKHD1JNHJWPX_g5k2NQLrx0EmjAsdsvuJb5RVc4ES-tF3g68"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/80 to-transparent"></div>
</div>
<div class="container mx-auto px-8 relative z-10">
<div class="max-w-3xl">
<span class="text-on-primary-container font-bold tracking-[0.2em] uppercase text-sm mb-4 block">Trải Nghiệm Độc Bản</span>
<h1 class="text-display-lg text-white font-headline font-extrabold text-6xl md:text-8xl leading-none mb-8 tracking-tighter">
                        Asian Wonders
                    </h1>
<p class="text-body-lg text-surface-variant text-xl leading-relaxed mb-10 max-w-xl">
                        Hành trình curator đưa bạn chạm tới linh hồn của Phương Đông. Từ những góc phố rực rỡ tại Tokyo đến sự bình yên của Seoul.
                    </p>
<div class="flex space-x-4">
<button class="bg-on-primary-container text-white px-8 py-4 rounded-md font-bold flex items-center group">
                            Khám Phá Ngay
                            <span class="material-symbols-outlined ml-2 transition-transform group-hover:translate-x-1">arrow_forward</span>
</button>
</div>
</div>
</div>
</section>
<!-- Destinaton Bento Grid -->
<section class="py-24 bg-surface">
<div class="container mx-auto px-8">
<div class="flex justify-between items-end mb-16">
<div class="max-w-2xl">
<h2 class="text-headline-md font-headline font-extrabold text-on-secondary-fixed text-4xl mb-4">Điểm Đến Biểu Tượng</h2>
<p class="text-on-surface-variant text-lg">Những hành trình được thiết kế riêng cho người lữ hành tinh tế.</p>
</div>
<div class="hidden md:block">
<div class="h-1 w-48 bg-outline-variant/20 relative">
<div class="absolute top-0 left-0 h-full w-1/3 bg-on-primary-container"></div>
</div>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-auto md:h-[800px]">
<!-- Japan -->
<div class="md:col-span-8 group relative overflow-hidden rounded-xl bg-surface-container-low">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Modern Tokyo skyline at night with neon lights and bustling street traffic, vibrant urban aesthetic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2b3YpwBQQBTcdv4mEL4WC7Bfs5oI7ui9rTojgc6IMrEbiSxRldG8TXM5Dit_95UCbQZ8OyHXK8r7AdriD477gaSqYii5ei0wh1sXFxr2aZ0k1vsVLZFCsDBv-FCBF4JR32ZI5btcax0_VxCwUC_AZm-WNsLk8D45ZzR5FoGbVTVZrvP3s5KuYH2N0HAEnLJgZn4NIKbelR1gw3vqUjK9uM2htw-VNyQuQHmbm9tyfi-uqThhkXvgp1nLBerknTdMTuBzNb4CO9-Fk"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
<div class="absolute bottom-0 left-0 p-10">
<span class="glass-badge text-white px-3 py-1 rounded text-xs font-bold mb-4 inline-block">MỚI NHẤT</span>
<h3 class="text-white text-4xl font-headline font-bold mb-2">Nhật Bản</h3>
<p class="text-surface-variant mb-6 max-w-md">Vẻ đẹp giao thoa giữa truyền thống ngàn năm và tương lai rực rỡ.</p>
<a class="text-white font-bold flex items-center border-b border-white/30 pb-1 w-fit hover:border-on-primary-container transition-colors" href="#">
                                Chi tiết hành trình <span class="material-symbols-outlined ml-2">east</span>
</a>
</div>
</div>
<!-- Korea -->
<div class="md:col-span-4 group relative overflow-hidden rounded-xl bg-surface-container-low">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Gyeongbokgung Palace in Seoul during autumn with colorful maple trees and traditional architecture" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMMjnb0Wj-0z8kHZIWJWI8Jpudu0zRs8ws3wT7vqVCYS5hvLX53vGrR_xgHj5EFtIsdNt7XhZbdyvuRHb8nki6tYi2m1eyWs8_WW3LQuEhs9hedZekyRTpSIAV02Vf0vzohkxvbWByLqEny_O2drpam98fy2HaDvMvccvdymcG64gBE3NpYPuT5vXRO4ZxgTsMGHhGjzXvXOWgXjjXasAPWsF8twOZEopU6_BPT5IvT_fD5sYqqmd1M8AsWSdUBHol4lFt5JCSwsqa"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
<div class="absolute bottom-0 left-0 p-8">
<h3 class="text-white text-3xl font-headline font-bold mb-2">Hàn Quốc</h3>
<p class="text-surface-variant mb-4">Sắc màu rực rỡ của Seoul Soul.</p>
</div>
</div>
<!-- Thailand -->
<div class="md:col-span-4 group relative overflow-hidden rounded-xl bg-surface-container-low">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Golden Buddhist temple in Bangkok at sunrise with intricate details and serene atmosphere" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDd8YXAP-U1BnezlBLPrWVhK2MygNoOMCFHBBHg8FSW-uzv1y8Z9FEIFql0-qNrq2C7Tlv3Cqbf59w832fNRAlUUhgsvMtZ2DVHk2yiv0pLO5ZRFCilmHgT5gy-i7t0eYZPQscX_hQ3EAG-mvaLbgJEfr-qoaILNCBJZEBxQgn4tLdHWU1utjLOZNdSAEHVHfT9gqZ8VSM90VgsPJp7ZQ_lX-RqaTZIbxNaH6DXrDwzFj7ZhYyvgzZ9PrQgtKnL5Rne407EgZ4iwq0K"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
<div class="absolute bottom-0 left-0 p-8">
<h3 class="text-white text-3xl font-headline font-bold mb-2">Thái Lan</h3>
<p class="text-surface-variant mb-4">Bangkok Gems và nụ cười rạng rỡ.</p>
</div>
</div>
<!-- Singapore -->
<div class="md:col-span-8 group relative overflow-hidden rounded-xl bg-surface-container-low">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Gardens by the Bay in Singapore with illuminated supertrees at twilight and futuristic park design" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDsiaEzt7QWj1Bbw68nQmvp2uSIG1MrWw07a6XPT_z9vwYI_2L6ruRPp1jZLKLrIA_Yqo5oKnH_VSyKTuMoXjBiBUHW0JGoOiNGnkYg_Fk5dp6HBw8SMrbpjCxTkrHrUbEPUVPiKfMOrSRtmb3Gcj9nW00IpjjgnsEMtMYbs0a8eHSIf3DKVD2FXTHn3Y4qQf8CKyuWgopnAR4j3wAcZ81MzACBk5T8pCB-SCrLWhFwW9mf_xCMfXm023cOxQOGItxCAIg9mTYWaMTa"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
<div class="absolute bottom-0 left-0 p-10">
<h3 class="text-white text-4xl font-headline font-bold mb-2">Singapore</h3>
<p class="text-surface-variant mb-6 max-w-md">Thành phố tương lai trong lòng di sản xanh.</p>
</div>
</div>
</div>
</div>
</section>
<?php include __DIR__ . '/_db_tours_section.php'; ?>

<!-- Signature Gradient CTA -->
<section class="py-24 px-8 overflow-hidden">
<div class="container mx-auto max-w-6xl rounded-3xl bg-gradient-to-br from-secondary to-on-secondary-container p-12 md:p-24 relative overflow-hidden">
<div class="absolute top-0 right-0 w-1/2 h-full opacity-20 pointer-events-none">
<img class="w-full h-full object-cover" data-alt="Abstract artistic representation of Asian lanterns floating in a night sky with soft blur and warm light" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCqsKMTF90bmHqIUMcFFZYGNke1tA3Am4ctJGqdQcz9tuSMOfSGaEWz0PuciEcXzwBjgvwq-RE0e-J8udVY2UpiwnYpLpJNdRVxyq0T5_gGSibp_5FFkXs8QXXZGUOSPldoTBcLxO243eooaSHWZvqkiVa9xFZFPwiqo4h7DVnheUPzuiKuL61Y9EA3vnmaVmCBY6mfjHcwkcW1PhKKuUK2RxeO7oysTys9rFVfi0zYzruHd1N9TKbK9KAy_QVDBwRfcJlHsK6hv6qP"/>
</div>
<div class="relative z-10 max-w-xl">
<h2 class="text-4xl md:text-5xl font-headline font-black text-white mb-8 leading-tight">Bắt đầu hành trình lữ hành của riêng bạn.</h2>
<p class="text-white/80 text-lg mb-12">Viet Sun Travel cam kết mang lại trải nghiệm tinh hoa, chăm sóc từng chi tiết nhỏ nhất trong suốt chuyến đi.</p>
<div class="flex flex-col sm:flex-row gap-4">
<button class="bg-white text-secondary font-bold px-8 py-4 rounded-md transition-all hover:shadow-xl active:scale-95">Liên Hệ Tư Vấn</button>
<button class="border border-white/30 text-white font-bold px-8 py-4 rounded-md transition-all hover:bg-white/10">Xem Brochure 2024</button>
</div>
</div>
</div>
</section>
</main>
