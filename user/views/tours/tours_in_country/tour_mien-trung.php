<?php
$headExtra = <<<HTML
<style>
    .editorial-text-shadow {
        text-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .tour-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }
</style>
HTML;
?>
<main class="pt-24">
<!-- Hero Section -->
<section class="relative h-[614px] overflow-hidden">
<div class="absolute inset-0 bg-cover bg-center" data-alt="Panoramic aerial view of Hoi An ancient town at dusk with glowing lanterns along the Thu Bon River and traditional architecture." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBImT5ujj_oxq-4Qc85DStqLLVyLO4TMVLszckWFkO1B3BK5wHvdB2RwcNPnsZEmlEidi136i4HVx36LTyITggeqX1wmr93l3MQpYwbg1bkRKTtKff7JYexBIXtoHqO_3kbE7fs5--5RQWdamLRfTsQhEipFw8NwBCo8cJCDyB53E64SuykwasGvnZhX3uxrrDlSbZwjCsadjrCQakhDQM2Wg7kF7yZvdoSOJfXH8haUC9gm-VW1PMj0qLs4o1Nwcxma-qc7W48jE_6')">
<div class="absolute inset-0 bg-gradient-to-r from-on-secondary-fixed/80 to-transparent"></div>
</div>
<div class="relative max-w-7xl mx-auto px-8 h-full flex flex-col justify-center">
<nav class="flex items-center space-x-2 text-surface-variant mb-6 text-sm">
<span>Điểm đến</span>
<span class="material-symbols-outlined text-sm">chevron_right</span>
<span class="text-white font-bold">Miền Trung</span>
</nav>
<h1 class="font-headline text-6xl font-extrabold text-white leading-tight tracking-tight mb-4 editorial-text-shadow">
                    Miền Trung:<br/><span class="text-on-primary-container">Dấu Ấn Di Sản &amp; Biển Xanh</span>
</h1>
<p class="text-white/90 max-w-xl text-lg leading-relaxed mb-8">
                    Từ kinh thành Huế cổ kính đến những bãi cát vàng Nha Trang, trải nghiệm miền Trung qua những lăng kính tinh hoa nhất.
                </p>
</div>
</section>

<!-- Main Content Area -->
<div class="max-w-7xl mx-auto px-8 py-20 flex flex-col lg:flex-row gap-16">
<!-- Regional Sidebar -->
<aside class="w-full lg:w-72 flex-shrink-0">
<div class="sticky top-32 space-y-12">
<section>
<h3 class="font-headline text-on-secondary-fixed font-bold text-xl mb-6">Điểm Đến Nổi Bật</h3>
<ul class="space-y-4">
<li>
<a class="flex items-center justify-between group" href="index.php?controller=tour&action=search&q=Đà+Nẵng">
<span class="text-on-surface-variant hover:text-secondary transition-colors font-medium">Đà Nẵng</span>
</a>
</li>
<li>
<a class="flex items-center justify-between group" href="index.php?controller=tour&action=search&q=Hội+An">
<span class="text-on-secondary-fixed font-bold border-l-4 border-on-primary-container pl-3">Hội An</span>
<span class="text-xs bg-on-primary-container px-2 py-1 rounded text-white">Nổi bật</span>
</a>
</li>
<li>
<a class="flex items-center justify-between group" href="index.php?controller=tour&action=search&q=Huế">
<span class="text-on-surface-variant hover:text-secondary transition-colors font-medium">Cố Đô Huế</span>
</a>
</li>
<li>
<a class="flex items-center justify-between group" href="index.php?controller=tour&action=search&q=Nha+Trang">
<span class="text-on-surface-variant hover:text-secondary transition-colors font-medium">Vịnh Nha Trang</span>
</a>
</li>
</ul>
</section>
<section class="bg-on-secondary-fixed rounded-xl p-8 text-white relative overflow-hidden">
<div class="absolute -right-10 -bottom-10 opacity-10">
<span class="material-symbols-outlined text-[160px]">explore</span>
</div>
<h4 class="font-headline font-bold text-lg mb-4 relative z-10">Cần Tư Vấn Riêng?</h4>
<p class="text-sm text-secondary-fixed mb-6 relative z-10">Thiết kế trải nghiệm miền Trung theo cách riêng của bạn với các chuyên gia địa phương.</p>
<button class="w-full py-3 bg-surface-container-lowest text-on-secondary-fixed font-bold rounded-md hover:bg-secondary-fixed transition-colors relative z-10">Liên Hệ Ngay</button>
</section>
<section>
<h3 class="font-headline text-on-secondary-fixed font-bold text-xl mb-6">Loại Hình Trải Nghiệm</h3>
<div class="flex flex-wrap gap-2">
<span class="px-4 py-2 bg-surface-container-lowest border border-outline-variant/30 rounded-full text-xs font-medium text-on-surface-variant hover:border-secondary cursor-pointer transition-all">Di sản</span>
<span class="px-4 py-2 bg-surface-container-lowest border border-outline-variant/30 rounded-full text-xs font-medium text-on-surface-variant hover:border-secondary cursor-pointer transition-all">Nghỉ dưỡng</span>
<span class="px-4 py-2 bg-surface-container-lowest border border-outline-variant/30 rounded-full text-xs font-medium text-on-surface-variant hover:border-secondary cursor-pointer transition-all">Ẩm thực</span>
<span class="px-4 py-2 bg-surface-container-lowest border border-outline-variant/30 rounded-full text-xs font-medium text-on-surface-variant hover:border-secondary cursor-pointer transition-all">Thiên nhiên</span>
</div>
</section>
</div>
</aside>

<!-- Tour Listings -->
<div class="flex-1">
<div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
<div>
<h2 class="font-headline text-3xl font-extrabold text-on-secondary-fixed mb-2 tracking-tight">Hành Trình Chọn Lọc</h2>
<p class="text-on-surface-variant">Những trải nghiệm danh giá nhất tại khu vực Miền Trung.</p>
</div>
<div class="flex items-center space-x-4 bg-surface-container-low p-1.5 rounded-lg">
<button class="px-4 py-2 bg-surface-container-lowest shadow-sm rounded-md text-xs font-bold text-on-secondary-fixed">Đề xuất</button>
<button class="px-4 py-2 hover:bg-surface-container-high rounded-md text-xs font-medium text-outline transition-colors">Giá tốt nhất</button>
<button class="px-4 py-2 hover:bg-surface-container-high rounded-md text-xs font-medium text-outline transition-colors">Đánh giá cao</button>
</div>
</div>

<?php include __DIR__ . '/_db_domestic_tours_grid.php'; ?>

</div>
</div>
<!-- Signature Section -->
<section class="mt-20 py-24 bg-gradient-to-br from-secondary to-on-secondary-container text-white overflow-hidden relative">
<div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row items-center gap-16 relative z-10">
<div class="flex-1">
<h2 class="font-headline text-4xl font-extrabold mb-6 leading-tight">Travel.Bling x Viet Sun<br/>Bộ Sưu Tập Giới Hạn</h2>
<p class="text-secondary-fixed text-lg mb-8 max-w-lg leading-relaxed">Giới thiệu bộ sưu tập độc quyền: những hành trình siêu sang với villa riêng tư, phương tiện chuyên chở cao cấp, và đặc quyền truy cập các di tích lịch sử khép kín.</p>
<div class="flex flex-wrap gap-4">
<div class="flex items-center bg-white/10 backdrop-blur-md px-6 py-4 rounded-xl border border-white/20">
<span class="material-symbols-outlined mr-3 text-tertiary-fixed">diamond</span>
<div>
<span class="block text-xs uppercase font-bold text-white/60">Tier One</span>
<span class="font-bold">Dịch Vụ Đặc Quyền</span>
</div>
</div>
<div class="flex items-center bg-white/10 backdrop-blur-md px-6 py-4 rounded-xl border border-white/20">
<span class="material-symbols-outlined mr-3 text-tertiary-fixed">flight_takeoff</span>
<div>
<span class="block text-xs uppercase font-bold text-white/60">Private Air</span>
<span class="font-bold">Lối Đi Riêng</span>
</div>
</div>
</div>
</div>
<div class="w-full md:w-1/3 h-[400px] rounded-2xl overflow-hidden shadow-2xl relative rotate-3">
<img class="w-full h-full object-cover" data-alt="Sophisticated luxury travel scene featuring a glass of wine on a balcony overlooking the sea at sunset, soft warm lighting." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4IkD8IVJfi9tOSk5Ajj0tSGa3G8QHIzm4sAKniQ3tWGI6BiO6sYTT0q0GmmBWjnbWjXzrRKQu9KweEs0K-Zdi2x99DI2x_HrHfipZ7HIFjU9tywKzjGgBKgAqpjU7YaibFkiCChKvXK2c25LxoydX9CxGMFVBHz3kyS2moROjUvo5g3Gls3oaDznvjbTryHecx89AbmY-WgvrJxWeeQBBIzfAFg2-C6RC9Hz7Q-i4gc79osGRPbOblHjWenCEX6CBHgbsGMc8WaoQ"/>
</div>
</div>
<!-- Decorative circle -->
<div class="absolute -bottom-20 -right-20 w-96 h-96 bg-on-primary-container rounded-full blur-[120px] opacity-20"></div>
</section>
</main>
