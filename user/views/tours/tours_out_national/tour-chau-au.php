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
    .signature-gradient {
        background: linear-gradient(135deg, #2b5bb5 0%, #00337c 100%);
    }
</style>
HTML;
?>
<main class="pt-20">
<!-- Hero Section -->
<section class="relative h-[870px] flex items-center overflow-hidden">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="Dreamy sunset over the Eiffel Tower and Parisian rooftops with soft golden lighting and editorial fashion aesthetic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4P2JX3rKPzI5v_OYU-GfdkUshBRZ8fGVGOhg9hRHet_yMUTQZ7tNKKO07N4_c-_HStto5YwJ4Q7frwGWgXXQ4-jaMF65pvg6gK8okA6vXLPo21-KoDDYuw39i1jReH5kC8WUrOsdtxkbnmg97kd_imEC6sTqSOlqb0cw3jE27CElapdaLpRPMYgyP4GaiWyBtuTtKhBBgFD90WlLPKmdEAo4-znI2dCvGIQkkiOltA31-Cex0u1y_3J6ORQscJc4opUtVY9Vqjzvq"/>
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/60 to-transparent"></div>
</div>
<div class="relative z-10 px-12 md:px-24 max-w-4xl text-white">
<span class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-widest uppercase bg-on-primary-container rounded-sm">Premium Selection</span>
<h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter mb-6 leading-[0.9]">European Elegance</h1>
<p class="text-xl md:text-2xl font-light leading-relaxed max-w-2xl opacity-90 mb-10 font-body">
                    Hành trình tinh hoa đưa bạn đến với trái tim của Châu Âu cổ kính. Khám phá vẻ đẹp lãng mạn của Pháp, sự hùng vĩ của Thụy Sĩ và kho tàng văn hóa vĩ đại của Ý.
                </p>
<div class="flex gap-4">
<button class="bg-on-primary-container text-white px-8 py-4 rounded-md font-bold text-lg hover:opacity-90 transition-opacity">Khám Phá Ngay</button>
<button class="border border-white/40 backdrop-blur-md px-8 py-4 rounded-md font-bold text-lg hover:bg-white hover:text-on-secondary-fixed transition-all">Tư Vấn Miễn Phí</button>
</div>
</div>
</section>
<!-- Asymmetric Intro -->
<section class="py-24 bg-surface-container-low px-12">
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-16 items-center">
<div class="md:col-span-5 md:col-start-2">
<h2 class="text-4xl font-extrabold text-on-secondary-fixed mb-8 leading-tight">Tuyệt Tác Nghệ Thuật Của Những Chuyến Đi</h2>
<p class="text-on-surface-variant text-lg leading-relaxed mb-6">
                        Viet Sun Travel không chỉ bán những chuyến đi, chúng tôi kiến tạo những trải nghiệm biên niên sử. Mỗi hành trình được thiết kế như một tác phẩm nghệ thuật, nơi dịch vụ đẳng cấp gặp gỡ những giá trị văn hóa bản địa sâu sắc.
                    </p>
<a class="text-secondary font-bold flex items-center gap-2 group" href="#">
                        Tìm hiểu về phong cách Viet Sun 
                        <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
</a>
</div>
<div class="md:col-span-6 relative">
<img class="rounded-lg shadow-2xl w-full h-[500px] object-cover" data-alt="Stunning aerial view of Positano village on the Amalfi Coast Italy with colorful houses clinging to cliffs and turquoise sea" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBn5vvcY9tvhLRY2iMx20BrRk2eRNEqXYKUGuvI_W5uzJseUGafgNEthOwyJKyR87DsDQED2GVsfRc2UcmIe-sUEDFONlWN11QNb8jI2GVv1j6vHyDXpw2ZGMnJYf3KmfU90tpPqdtk6kGxNKWRV975xXqUJ67Ka6dzw6KZ9buP5DtKWa2HwDALOtjQkBfE5D3P4jbYTrn37sECCtvYQcU2RwvgMUabanH3xGLTP6ss5-1D6_fo2o0-ywY3ZgR8tpHTdlMc-L5Wa0L7"/>
<div class="absolute -bottom-8 -left-8 bg-white p-8 rounded-lg shadow-xl hidden md:block max-w-[240px]">
<p class="text-4xl font-black text-on-primary-container mb-2">15+</p>
<p class="text-sm font-bold text-on-secondary-fixed">Năm kinh nghiệm kiến tạo tour Châu Âu cao cấp</p>
</div>
</div>
</div>
</section>
<?php include __DIR__ . '/_db_tours_section.php'; ?>



<!-- Newsletter / Signature Section -->
<section class="py-24">
<div class="max-w-7xl mx-auto px-12">
<div class="signature-gradient rounded-3xl p-16 relative overflow-hidden flex flex-col md:flex-row items-center gap-12">
<div class="relative z-10 md:w-1/2">
<h3 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">Nhận Cẩm Nang Du Lịch Châu Âu Biên Soạn Riêng</h3>
<p class="text-secondary-fixed-dim text-lg mb-8 opacity-90">Đăng ký để nhận những gợi ý điểm đến ẩn mình và các ưu đãi đặc quyền dành riêng cho khách hàng thân thiết.</p>
<form class="flex flex-col sm:flex-row gap-4">
<input class="flex-1 px-6 py-4 rounded-md border-none focus:ring-2 focus:ring-on-primary-container text-on-surface" placeholder="Email của bạn..." type="email"/>
<button class="bg-on-primary-container text-white px-8 py-4 rounded-md font-bold hover:bg-white hover:text-on-primary-container transition-all">Đăng Ký Ngay</button>
</form>
</div>
<div class="md:w-1/2 relative z-10 flex justify-center">
<div class="relative">
<div class="w-64 h-80 rounded-lg overflow-hidden border-8 border-white/10 rotate-3">
<img class="w-full h-full object-cover" data-alt="Close up of a travel journal and vintage camera on a wooden table with a map of Europe" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3f0yFyLiZqVQUlCtEZ1Chtj26MVljW6ObRh5niRdhzCL8kX9in4qhh4zc6ebAj6FW-QkS72jjPmcmQmrXT4rstTZg5Uxpf0bXKYOpSFcZzEc9qZYAsDeEz9ibmHBGsQGpvB0iaU0b7zn778TeNaFX96Xv5K3ldBXy9_ICbNdbn5FR0OBWywF1YqWBxZSM_aXCDpPFdoIzEFo1yMVlkwKrObo-FqYhNMKAOeiz1w7TZMpHf1BZe_rTTiyS44riV6vqgt5OTyx_ykRK"/>
</div>
<div class="absolute -top-6 -right-6 w-48 h-64 rounded-lg overflow-hidden border-8 border-white/20 -rotate-6 shadow-2xl">
<img class="w-full h-full object-cover" data-alt="Scenic view of a medieval German town with half-timbered houses and cobblestone streets" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2mq7oGneuxTTSKpjwqY7DkGQz87sEekpjw-Ue6mXBiOybG4oz-3l5s4I3Qsse2vDChDb3t9j_xaqskud89bPW6ZdHzc8fwBKsPiEJNe49bysIu7YchwUYuM5BHBctaAonpHvE4Qr54RT1ZKYKU-sxJggZvgNrKn-IDmMtk663NzeJrIVOtq32YmtHtNtu82MHLaz0qUz8A704TNgLAlYn3ubiJpKIcGnageBPxmfMi0NaF1EenGAdMY5dAGJ1d-DtARN2SgkvNvZ_"/>
</div>
</div>
</div>
<!-- Decorative element -->
<div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -mr-48 -mt-48 blur-3xl"></div>
</div>
</div>
</section>
</main>
