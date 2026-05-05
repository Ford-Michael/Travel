<?php
/**
 * Đặt Phòng Khách Sạn / Hotel Booking
 * Travel Bling User Site
 */
?>

<style>
    .editorial-shadow { box-shadow: 0px 12px 32px rgba(25, 28, 29, 0.06); }
    .glass-badge {
        background: rgba(43, 91, 181, 0.4);
        backdrop-filter: blur(20px);
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<!-- Hero Section -->
<section class="relative h-[580px] w-full flex items-center overflow-hidden">
    <img class="absolute inset-0 w-full h-full object-cover"
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAzs5HRq4ev_lkZd0LKW76W6CBsRqXoBP1xoIEVvKNqdBEsnYIHPYbE-BLy2eVnKJ7kIwhFg78lRAw_BtqrdYS-CCIu0ohrCDAsI65HrP2mXNkrnfrKX8RQ22vgO_0d6aOve22i6K-yVxEjkT5MnwXURXaYIsljRyaGLk3Cc1RL7lOtk2iZ3ZMuBJSbtyb8J2k5tyCxhkm79Q0fNCIo3Ow9kcdvyJPKDAhl55U6hc6eMoLBdtGsosvGpeQcQ3wUrgIRFzFlLrtqhDjE"
        alt="Luxury Hotel" />
    <div class="absolute inset-0 bg-gradient-to-r from-[#001945]/70 to-transparent"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-8 w-full">
        <div class="max-w-2xl">
            <h1 class="text-white text-5xl md:text-7xl font-extrabold font-headline tracking-tighter leading-[1.1] mb-8">
                Đặt Phòng <br/><span class="text-on-primary-container">Khách Sạn</span> Cao Cấp
            </h1>
            <!-- Search Overlay -->
            <div class="bg-surface-container-lowest p-2 rounded-xl flex flex-col md:flex-row items-stretch gap-2 editorial-shadow max-w-4xl">
                <div class="flex-1 flex items-center px-4 py-3 gap-3 border-r border-outline-variant/20">
                    <span class="material-symbols-outlined text-secondary">location_on</span>
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-widest font-bold text-outline">Điểm Đến</span>
                        <input class="bg-transparent border-none p-0 text-on-surface font-semibold focus:ring-0 placeholder:text-outline-variant" placeholder="Bạn muốn đi đâu?" type="text" />
                    </div>
                </div>
                <div class="flex-1 flex items-center px-4 py-3 gap-3 border-r border-outline-variant/20">
                    <span class="material-symbols-outlined text-secondary">calendar_today</span>
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-widest font-bold text-outline">Nhận - Trả Phòng</span>
                        <input class="bg-transparent border-none p-0 text-on-surface font-semibold focus:ring-0 placeholder:text-outline-variant" placeholder="Chọn ngày" type="text" />
                    </div>
                </div>
                <div class="flex-1 flex items-center px-4 py-3 gap-3 border-r border-outline-variant/20">
                    <span class="material-symbols-outlined text-secondary">person</span>
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-widest font-bold text-outline">Khách</span>
                        <input class="bg-transparent border-none p-0 text-on-surface font-semibold focus:ring-0 placeholder:text-outline-variant" placeholder="Số khách" type="text" />
                    </div>
                </div>
                <button class="bg-on-primary-container text-white px-10 py-4 rounded-lg font-bold hover:brightness-110 transition-all flex items-center justify-center gap-2">
                    Tìm Phòng
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Area -->
<section class="max-w-7xl mx-auto px-8 py-24 flex flex-col md:flex-row gap-12">
    <!-- Sidebar Filters -->
    <aside class="w-full md:w-64 flex-shrink-0">
        <div class="sticky top-28 space-y-10">
            <div>
                <h3 class="text-[#001945] font-bold text-lg mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">tune</span> Bộ Lọc
                </h3>
                <div class="space-y-8">
                    <!-- Price Range -->
                    <div>
                        <h4 class="text-xs uppercase tracking-widest font-black text-outline mb-4">Khoảng Giá</h4>
                        <div class="space-y-3">
                            <input class="w-full accent-on-primary-container" type="range" />
                            <div class="flex justify-between text-sm font-medium text-on-surface-variant">
                                <span>500K</span>
                                <span>10.000K+</span>
                            </div>
                        </div>
                    </div>
                    <!-- Star Rating -->
                    <div>
                        <h4 class="text-xs uppercase tracking-widest font-black text-outline mb-4">Hạng Sao</h4>
                        <div class="space-y-2">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input class="rounded border-outline-variant text-secondary focus:ring-secondary" type="checkbox" />
                                <span class="text-sm font-medium text-on-surface-variant group-hover:text-secondary transition-colors">5 Sao Luxury</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input checked class="rounded border-outline-variant text-secondary focus:ring-secondary" type="checkbox" />
                                <span class="text-sm font-medium text-on-surface-variant group-hover:text-secondary transition-colors">4 Sao Boutique</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input class="rounded border-outline-variant text-secondary focus:ring-secondary" type="checkbox" />
                                <span class="text-sm font-medium text-on-surface-variant group-hover:text-secondary transition-colors">Di Sản Heritage</span>
                            </label>
                        </div>
                    </div>
                    <!-- Amenities -->
                    <div>
                        <h4 class="text-xs uppercase tracking-widest font-black text-outline mb-4">Tiện Nghi Phổ Biến</h4>
                        <div class="space-y-2">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input checked class="rounded border-outline-variant text-secondary focus:ring-secondary" type="checkbox" />
                                <span class="text-sm font-medium text-on-surface-variant group-hover:text-secondary transition-colors">Hồ Bơi Riêng</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input class="rounded border-outline-variant text-secondary focus:ring-secondary" type="checkbox" />
                                <span class="text-sm font-medium text-on-surface-variant group-hover:text-secondary transition-colors">Spa & Wellness</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input class="rounded border-outline-variant text-secondary focus:ring-secondary" type="checkbox" />
                                <span class="text-sm font-medium text-on-surface-variant group-hover:text-secondary transition-colors">Nhà Hàng Cao Cấp</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input class="rounded border-outline-variant text-secondary focus:ring-secondary" type="checkbox" />
                                <span class="text-sm font-medium text-on-surface-variant group-hover:text-secondary transition-colors">Mặt Biển</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 space-y-24">
        <!-- Curated Collections -->
        <section>
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold font-headline text-on-secondary-container tracking-tight mb-2">Bộ Sưu Tập Nổi Bật</h2>
                    <p class="text-on-surface-variant max-w-md">Các chủ đề chọn lọc dành cho du khách sành điệu, được biên tập bởi đội ngũ chuyên gia.</p>
                </div>
            </div>
            <div class="flex gap-6 overflow-x-auto pb-8 no-scrollbar scroll-smooth">
                <div class="min-w-[320px] relative group overflow-hidden rounded-xl">
                    <img class="w-full h-[400px] object-cover transition-transform duration-700 group-hover:scale-110"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBNlBNtPQtGwet1w2g9JLJstBNydmndkV5kevYmfL4V7YqQSjtgEN4UI_ucOZWPUPsB5DSUEKp2GEV0wepfpegg-wzl7uJCftqrd5lVw-CQ3zF1y2sobo2g883V_4yY6QuXrFcgRIPoWguO5uKdFYXuGkb9A_sFPgM6CBJxZNBSlSmvbo1zvCKQErpM8b_HfMcGpe6Wjkl9MBUTQWRfpbMC4gWvIkrOdkyl5nQuceTrDhBtDiqRp2sQFIrfp6rRXzR9OyMg-stfpMQw"
                        alt="Wellness" />
                    <div class="absolute inset-0 bg-black/40 flex flex-col justify-end p-8">
                        <h3 class="text-white text-2xl font-bold mb-1">Nghỉ Dưỡng Sức Khỏe</h3>
                        <p class="text-white/80 text-sm">Tìm lại sự cân bằng bên trong</p>
                    </div>
                </div>
                <div class="min-w-[320px] relative group overflow-hidden rounded-xl">
                    <img class="w-full h-[400px] object-cover transition-transform duration-700 group-hover:scale-110"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCqhvLWlhNFkXKyZd3th4bzTo-kJ1sruHrXndLVD6DuqR8w-vj5_KB3LHLnVcpyF0XdAbSOJaxXOrZZqHtlgnWGbKD2og046NABGo3WEr-m518o1uJrfeWzHkhDyEgzrYcujZlZsM53AUjEiT34PH1nglgsNy8o5h8cdAKTNFhWCRroDiXrPUoRJHTTqVVzfqRaQyL31jxwLYOcRhUW9e5pyKdnVETo6a3pOgX98WFbzcafXYJl-A2rBa4jVJwGVKlH6AIs84-R6-c0"
                        alt="City" />
                    <div class="absolute inset-0 bg-black/40 flex flex-col justify-end p-8">
                        <h3 class="text-white text-2xl font-bold mb-1">Khách Sạn Thành Phố</h3>
                        <p class="text-white/80 text-sm">Sang trọng giữa trung tâm</p>
                    </div>
                </div>
                <div class="min-w-[320px] relative group overflow-hidden rounded-xl">
                    <img class="w-full h-[400px] object-cover transition-transform duration-700 group-hover:scale-110"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQlrm1xif62v9aJ1r2miOVlD4a_FC8K-yD8stQyBV34Q1CkFY9T8OytpUzoVLuwAmc_pWlWdvUsqPxO0GTqz8C7moyoCk_CpoyfCkovyc3mx7i8FfHTFj0ZG13UIGvMSLCU2o-A5gZ6CpNTYV40ElVy2-FAytPa3pe4Hhbm32iENF9_9DHGVMgmC02PTMm4Qot9Yx73HEr6KseQsOpju4zXMicZuubvR1BpmB4UA6N_2B6M__jYaFA1nEwiLO2gdO0a6CmsAYnyTIU"
                        alt="Tropical" />
                    <div class="absolute inset-0 bg-black/40 flex flex-col justify-end p-8">
                        <h3 class="text-white text-2xl font-bold mb-1">Resort Nhiệt Đới</h3>
                        <p class="text-white/80 text-sm">Thiên đường giữa biển xanh</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Properties -->
        <section>
            <div class="flex justify-between items-end mb-10">
                <h2 class="text-3xl font-extrabold font-headline text-on-secondary-container tracking-tight">Khách Sạn Nổi Bật</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Property 1 -->
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden group cursor-pointer transition-all hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative h-64">
                        <img class="w-full h-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAq_de2UngSrcA0vipnrhYzhtBJg3yK1fyxMC8GqFzWhHOENyVg8k3L_u8EjKsif1c7PCbmB_j5-CYkAQLK_81xrg2KzypyDd44EG2-mkjjH0mAIUAkulpCAq7hYKEVIMz6XgPECWsTeWSV0p6uJh4iV3Co0baXtcmamsuPHiGIotFFlmrjvcKo9ePkjAe6mZzM87gfKJHDYuvpaVe-ijggkVyi0rVGDTTyEO1cuEFJr40Qofy68j0H2VZTkJ5mZxHAQmubARv9jvyd"
                            alt="The Grand Heritage" />
                        <span class="absolute top-4 left-4 glass-badge px-3 py-1 rounded text-[10px] uppercase font-black tracking-widest text-white">Nổi Bật</span>
                        <button class="absolute top-4 right-4 text-white hover:text-on-primary-container transition-colors">
                            <span class="material-symbols-outlined">favorite</span>
                        </button>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-on-secondary-container">The Grand Heritage</h3>
                                <p class="text-sm text-outline flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">location_on</span> Paris, Pháp
                                </p>
                            </div>
                            <div class="flex items-center gap-1 text-[#ffb438]">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-sm font-bold text-on-surface">4.9</span>
                            </div>
                        </div>
                        <div class="flex gap-4 py-2 border-y border-surface-container-low">
                            <span class="material-symbols-outlined text-outline text-[20px]" title="Pool">pool</span>
                            <span class="material-symbols-outlined text-outline text-[20px]" title="Spa">spa</span>
                            <span class="material-symbols-outlined text-outline text-[20px]" title="WiFi">wifi</span>
                            <span class="material-symbols-outlined text-outline text-[20px]" title="Restaurant">restaurant</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col">
                                <span class="text-2xl font-black text-on-primary-container">$850</span>
                                <span class="text-[10px] text-outline font-bold uppercase tracking-wider">/ Đêm</span>
                            </div>
                            <button class="text-secondary font-bold hover:underline">Xem Chi Tiết</button>
                        </div>
                    </div>
                </div>
                <!-- Property 2 -->
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden group cursor-pointer transition-all hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative h-64">
                        <img class="w-full h-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCnhl3ibt37TUytI4fVISBWYLDTAikDasOJGBTRzzJR2YygM-bAj5F7hnAr34LWuiFS1jRsYe72KTYkNSdVB9qOi--ATyraTy8SHQSRr5mMQPKO73jpe7wZEJ4hTkg11rRMY_xxwPZSBylF7rbVbpIrWz3GLr-OAePe3zaQMCwfsW9b6EIAqzBPEhO32vdZcEULu1u29NkFmaDFANUD9INdOfCfeEI3ZyrhnM9zxOasWO82NHOauxm9Ln56PXhP4H1R7HWG3Mp1_FZs"
                            alt="Azure Bay Resort" />
                        <button class="absolute top-4 right-4 text-white hover:text-on-primary-container transition-colors">
                            <span class="material-symbols-outlined">favorite</span>
                        </button>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-on-secondary-container">Azure Bay Resort</h3>
                                <p class="text-sm text-outline flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">location_on</span> Amalfi Coast, Ý
                                </p>
                            </div>
                            <div class="flex items-center gap-1 text-[#ffb438]">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-sm font-bold text-on-surface">5.0</span>
                            </div>
                        </div>
                        <div class="flex gap-4 py-2 border-y border-surface-container-low">
                            <span class="material-symbols-outlined text-outline text-[20px]">beach_access</span>
                            <span class="material-symbols-outlined text-outline text-[20px]">fitness_center</span>
                            <span class="material-symbols-outlined text-outline text-[20px]">wifi</span>
                            <span class="material-symbols-outlined text-outline text-[20px]">local_bar</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col">
                                <span class="text-2xl font-black text-on-primary-container">$1,200</span>
                                <span class="text-[10px] text-outline font-bold uppercase tracking-wider">/ Đêm</span>
                            </div>
                            <button class="text-secondary font-bold hover:underline">Xem Chi Tiết</button>
                        </div>
                    </div>
                </div>
                <!-- Property 3 -->
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden group cursor-pointer transition-all hover:-translate-y-1 hover:shadow-xl">
                    <div class="relative h-64">
                        <img class="w-full h-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBdd1eDT08hA3114Sh8ehZHgtiRydD1JoQ-9dohY9_unzAOXc-fZoSwm9nxju-lrWsJorTx7HZmT-dzh546xDSvIbXwwqExKPNPu07ALbNUoQ7nM3KaMRCj86jFw4EOVofQ5SFTm6yn-IU_kXSxhp478W6Fh6OW2Hot1ut9YYIC7SCTLimCSwfv-aM_55M1n16r7qTLHH0KhQOblL1vzzfhzQuW5vk99pqL9qQR20CtNkJZzdWG1y5S9QF9LU5wQRDACv_VQCDoqIv-"
                            alt="Summit Peaks Lodge" />
                        <button class="absolute top-4 right-4 text-white hover:text-on-primary-container transition-colors">
                            <span class="material-symbols-outlined">favorite</span>
                        </button>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-on-secondary-container">Summit Peaks Lodge</h3>
                                <p class="text-sm text-outline flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">location_on</span> Aspen, Mỹ
                                </p>
                            </div>
                            <div class="flex items-center gap-1 text-[#ffb438]">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-sm font-bold text-on-surface">4.8</span>
                            </div>
                        </div>
                        <div class="flex gap-4 py-2 border-y border-surface-container-low">
                            <span class="material-symbols-outlined text-outline text-[20px]">fireplace</span>
                            <span class="material-symbols-outlined text-outline text-[20px]">spa</span>
                            <span class="material-symbols-outlined text-outline text-[20px]">wifi</span>
                            <span class="material-symbols-outlined text-outline text-[20px]">restaurant</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col">
                                <span class="text-2xl font-black text-on-primary-container">$640</span>
                                <span class="text-[10px] text-outline font-bold uppercase tracking-wider">/ Đêm</span>
                            </div>
                            <button class="text-secondary font-bold hover:underline">Xem Chi Tiết</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Member Banner -->
        <section class="relative bg-[#001945] rounded-2xl overflow-hidden p-12 md:p-16">
            <div class="absolute top-0 right-0 w-1/2 h-full opacity-30">
                <img class="w-full h-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaFhcaB3NKCvOHuTNNJuu1winu4WQdIjjZb40HjUU6GfqVNkqfPjUwDF4BzYuCnVW8Itny1cOq5qyq1Mc_pe10ZTm5gnpMa-TR7CzQ7tJvO76t0QcYGgl7Vj7-jc0byJkqvkwx3QDRy6mP8pol5EhAPpdkfqCVkTWnp4mFSn0ut0zbQ-cnMa9q0de0dCN76ZPH4aLZsfCKYQlZZV9etoOVz6Egrq4HKRoRnbjP0qIpImW_ZBLhJwjuHoBVO9aS7FWLxD_E7DOCp8ZK"
                    alt="Luxury Texture" />
            </div>
            <div class="relative z-10 max-w-lg space-y-6">
                <span class="text-on-primary-container font-black tracking-widest text-xs uppercase">Ưu Đãi Thành Viên</span>
                <h2 class="text-white text-4xl font-extrabold font-headline tracking-tight">Tiết kiệm đến 30% cho kỳ nghỉ tiếp theo.</h2>
                <p class="text-outline-variant text-lg">Thành viên Travel.Bling được hưởng giá ưu đãi, nhận phòng sớm và nâng cấp phòng miễn phí.</p>
                <div class="flex gap-4">
                    <a href="index.php?controller=auth&action=register" class="bg-on-primary-container text-white px-8 py-3 rounded-lg font-bold">Đăng Ký Miễn Phí</a>
                    <a href="index.php?controller=auth&action=login" class="bg-transparent border border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white/10 transition-all">Đăng Nhập</a>
                </div>
            </div>
        </section>
    </div>
</section>
