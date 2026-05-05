<?php
$headExtra = <<<HTML
<style>
    .tonal-shift-bg-to-surface-low {
        background-color: #f3f4f5;
    }
    .signature-gradient {
        background: linear-gradient(135deg, #2b5bb5 0%, #00337c 100%);
    }
    .glass-badge {
        background: rgba(225, 227, 228, 0.4);
        backdrop-filter: blur(20px);
    }
    .editorial-shadow:hover {
        box-shadow: 0px 12px 32px rgba(25, 28, 29, 0.06);
    }
</style>
HTML;
?>
<main class="pt-20">
<!-- Hero Section: Editorial Style -->
<section class="relative h-[870px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="Modern New York City skyline at sunset with golden light reflecting off skyscrapers and the Hudson River" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAd4mIlQpoGHQfgSu1Aq7287uYpCGOAgO-0tXG8fzkJF0MDH1jiuNEpqnqBqsOhrYok3rWq857vLRxOEfOdf3txFlaPpqQ_iHnkn8bjNEXYbg5_WIXnzQfwGdc5M5kP862MMbPLWCWwMH203swLTKBu4pBoxcP_fUNgg-gFLpYyt8VDaKhxICjIn3NZeKrQCCPaqUnOFoz39UCHrPro_3hcBVfnR_H6jmCqOa94oMh2_GWi7XQN9J07ERoqzJHm6RQpj3o90cNbCvF6"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/60 to-transparent"></div>
</div>
<div class="relative z-10 max-w-7xl mx-auto px-8 w-full">
<div class="max-w-2xl">
<span class="text-on-primary-container font-bold tracking-widest uppercase text-sm mb-4 block">Hành trình Khám phá Châu Mỹ</span>
<h1 class="font-headline text-white text-6xl md:text-8xl font-extrabold tracking-tighter leading-[0.9] mb-6">
                        The New World <br/>Discovery
                    </h1>
<p class="text-white/90 text-xl leading-relaxed mb-8 max-w-lg">
                        Trải nghiệm sự hùng vĩ từ những dãy núi Rocky tuyết phủ đến nhịp sống sôi động của Manhattan. Một hành trình được biên tập riêng cho những tâm hồn khao khát tự do.
                    </p>
<div class="flex gap-4">
<button class="bg-on-primary-container text-white px-8 py-4 rounded-md font-bold hover:scale-95 transition-all">Khám phá ngay</button>
<button class="border border-white/40 text-white px-8 py-4 rounded-md font-bold hover:bg-white/10 transition-all">Tư vấn miễn phí</button>
</div>
</div>
</div>
</section>
<!-- Destination Highlights: Asymmetric Bento Grid -->
<section class="py-24 bg-surface-container-low">
<div class="max-w-7xl mx-auto px-8">
<div class="flex flex-col md:flex-row justify-between items-end mb-16">
<div>
<h2 class="font-headline text-4xl font-extrabold text-on-secondary-fixed mb-4">Điểm đến tâm điểm</h2>
<p class="text-on-surface-variant max-w-md">Những vùng đất hứa với vẻ đẹp kỳ quan thiên nhiên và tinh hoa kiến trúc hiện đại.</p>
</div>
<div class="mt-6 md:mt-0">
<span class="text-secondary font-bold cursor-pointer flex items-center gap-2 group">
                            Xem tất cả điểm đến 
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
</span>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-[800px]">
<div class="md:col-span-8 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Golden Gate Bridge in San Francisco shrouded in morning fog with soft blue and orange hues" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAt7Jjz7OY9D22MCMrywPV0iirfcorjf_5lQFN7L09syXWkwNxolLKU6hYPK9bLJF-UiRR_02JPWbWhRJyUhEZEanvXjeQRnjQcgj4kVP-P7dsxEtb1Fs3rPRKkTNyWGowDl17XKwXCfXNPqVdXoyK0pQPF_TbTERPretIInnUvkchI0y3P16QwLQtAJoyHPl4lWli7wnbIFUXrl3BG-NqBGYv9MhN_54dwVLghOEzhuSpdoknpsPCE40xeWm7OQ7jNAtf6HGrKkicM"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">MỸ</span>
<h3 class="text-3xl font-bold">USA: Miền Đất Hứa</h3>
</div>
</div>
<div class="md:col-span-4 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Aerial view of Christ the Redeemer statue in Rio de Janeiro overlooking the lush green mountains and bay" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwW4m3eyNi9OTYrxjyLy-cPY5ZrdKLZ2daF5mxucrwIDKA7mf5VStd1mcSJ65DHJ10AVcAg04zxpMizqh7VLmBftEWcyDyANQ9iy-PK1NGgL_H7HjGY_3pAzn01fs4cL-mq0HXVe_Xm7UibCOz3ZSpPdNcUzL_iEmnA6f2BIUXXr6M8qSp_s5Yb8NZ2fHRHdvLSGw736wxqxlYnXPhgCr03EQmYjj87jLf_-nE6X0OvB8YOzS9hIU_nBsW3UVAfg9MZoOTqqSQfjW5"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">BRAZIL</span>
<h3 class="text-2xl font-bold">Sắc màu Latin</h3>
</div>
</div>
<div class="md:col-span-4 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Ancient ruins of Machu Picchu in Peru with green terraced mountains under a clear blue sky" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBnGih2cV12VWelE02rNU5DTrkOOqbAxUbr_36TI1xlJlyCEhUTvZDtwatSdc92d5hsCP7MfMD4uSFLMaOKG6-I5vKF6pqY7aWSgXJS0QH8PhVuTcMySGT51AxSDyJFaTwv0SGLpJvZ_Cj_-0_dyEv2DMy0xQFZvdp8KW3Ilhbk10FYS_mhaHRsbXiNhaeY9VrAZWFGgjMqaKw4cGnOfcPgfyTzdgOPMWhseuQlY90PLphOAEK3VRVLEU5_QIWskbQqEBGyVcWEM8pI"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">PERU</span>
<h3 class="text-2xl font-bold">Huyền thoại Inca</h3>
</div>
</div>
<div class="md:col-span-8 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Snow-capped Canadian Rockies reflected in a crystal clear turquoise glacial lake surrounded by pine trees" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD7aog5oAAsYR3sMnOaPKb99HdOk0P6CO0_LmYlWChCyhIqWkS6JkpaFFh7Y52k5FgkRoTaqRLhmscEN6vCtzxYILreAwfktEFJrGJ3Yml4HGdhi2M565Qr0aZn10Bi08gZlP5vZt0pQ1pHC97_cRiwiQNssFYfcIRaoTXDPYPOcCrHF_PIee_LLoPJqTo9T6aFN7T8W14Xft5XxqKSWcBCf2Iqofl0EfCRmPd5YrWsdObPgrPaTapUsuhu3LmFAHuO86Zh8tcmsjKn"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
<div class="absolute bottom-8 left-8 text-white">
<span class="glass-badge px-3 py-1 rounded text-xs font-bold mb-2 inline-block">CANADA</span>
<h3 class="text-3xl font-bold">Kỳ quan Rockies</h3>
</div>
</div>
</div>
</div>
</section>
<?php include __DIR__ . '/_db_tours_section.php'; ?>


<!-- Signature Experience Banner -->
<section class="signature-gradient py-24 relative overflow-hidden">
<div class="absolute right-0 top-0 opacity-10 pointer-events-none">
<span class="material-symbols-outlined text-[400px]" style="font-variation-settings: 'FILL' 1;">public</span>
</div>
<div class="max-w-7xl mx-auto px-8 relative z-10 text-center lg:text-left">
<div class="flex flex-col lg:flex-row items-center gap-16">
<div class="lg:w-3/5">
<h2 class="font-headline text-white text-5xl font-extrabold mb-6 leading-tight">Dịch vụ Curated cho <br/>Trải nghiệm Thượng lưu</h2>
<p class="text-white/80 text-xl mb-10 max-w-2xl">
                            Chúng tôi không chỉ bán tour. Chúng tôi thiết kế những trải nghiệm mang đậm dấu ấn cá nhân, từ việc chọn khách sạn Boutique đến các bữa tối Michelin độc bản.
                        </p>
<div class="grid grid-cols-2 md:grid-cols-3 gap-8 mb-10">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">verified_user</span>
<span class="text-white font-medium">Bảo hiểm Cao cấp</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">support_agent</span>
<span class="text-white font-medium">Hỗ trợ 24/7</span>
</div>
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-primary-container">hotel</span>
<span class="text-white font-medium">Khách sạn 5 sao</span>
</div>
</div>
<button class="bg-white text-secondary px-10 py-4 rounded-md font-black hover:bg-on-primary-container hover:text-white transition-all shadow-xl">Liên hệ thiết kế Tour riêng</button>
</div>
<div class="lg:w-2/5">
<div class="relative p-4 bg-white/10 rounded-2xl backdrop-blur-md">
<img class="rounded-xl shadow-2xl" data-alt="Happy couple toast with champagne on a luxury private yacht during a sunset cruise" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDw-CN1cKxV4K9u8G00NPxTiP7sBpJXsZAbRwpGlRBJskz3s_0ft-wDQIihWmDEFIkOCuVKYBj4SxUvKHgItXIxlkX0n6KH-UeEs3BjITy4E5gRZjt0BbQF8RnzT5hIj5p6lkpwXQJAfjYM7VRJauGJm0WTwHOLw2qHKmiuhRa1Pv25_joImKUBGmHkedcKqvDy03PEPDwgTdVo8bsyFY0F5QLL1duPULmQ-lrhKYbvW57bLgas-2o4SgIIOtA50EvvFEjXGNGWPUll"/>
</div>
</div>
</div>
</div>
</section>
<!-- Social Proof / Press -->
<section class="py-16 bg-surface">
<div class="max-w-7xl mx-auto px-8">
<p class="text-center text-outline-variant font-bold tracking-[0.2em] uppercase text-xs mb-8">Đối tác &amp; Tạp chí Du lịch</p>
<div class="flex flex-wrap justify-center gap-12 lg:gap-24 opacity-40 grayscale hover:grayscale-0 transition-all duration-500">
<span class="font-headline text-2xl font-black text-on-surface">VOGUE</span>
<span class="font-headline text-2xl font-black text-on-surface">Travel+Leisure</span>
<span class="font-headline text-2xl font-black text-on-surface">MONOCLE</span>
<span class="font-headline text-2xl font-black text-on-surface">Condé Nast</span>
<span class="font-headline text-2xl font-black text-on-surface">Forbes Travel</span>
</div>
</div>
</section>
</main>
