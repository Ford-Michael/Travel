<main class="bg-surface-container-low">
    <!-- Hero -->
    <section class="relative">
        <div class="h-[440px] w-full overflow-hidden">
            <img
                src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=1800&q=80"
                alt="Contact hero"
                class="h-full w-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-[#001945]/80 via-[#001945]/40 to-transparent"></div>
        </div>
        <div class="absolute inset-0 max-w-7xl mx-auto px-8 flex items-center">
            <div class="max-w-xl text-white">
                <span class="inline-block bg-secondary/40 rounded-full px-4 py-1 text-xs tracking-widest uppercase font-semibold mb-5">Liên hệ</span>
                <h1 class="font-headline text-5xl md:text-6xl font-extrabold leading-tight">
                    Kết nối <span class="text-on-primary-container italic">với chúng tôi</span>
                </h1>
                <p class="mt-4 text-white/85 leading-relaxed">
                    Dù bạn đang lên kế hoạch cho chuyến đi riêng hay cần tư vấn du lịch, đội ngũ chuyên gia của Travel Bling luôn sẵn sàng hỗ trợ 24/7.
                </p>
            </div>
        </div>
    </section>

    <!-- Offices -->
    <section class="py-16 bg-surface">
        <div class="max-w-7xl mx-auto px-8">
            <h2 class="font-headline text-4xl font-bold text-on-secondary-fixed">Mạng lưới văn phòng</h2>
            <div class="w-16 h-1 bg-on-primary-container mt-4 mb-10"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php
                $offices = [
                    [
                        'name' => 'Hà Nội (Trụ sở chính)',
                        'address' => '81 Lý Thường Kiệt, Quận Hoàn Kiếm, Hà Nội, Việt Nam',
                        'phone' => '+84 24 3924 8888',
                        'email' => 'hanoi@travelbling.com',
                    ],
                    [
                        'name' => 'TP. Hồ Chí Minh',
                        'address' => '268 Lý Thường Kiệt, Quận 10, TP. Hồ Chí Minh, Việt Nam',
                        'phone' => '+84 28 3822 9999',
                        'email' => 'saigon@travelbling.com',
                    ],
                    [
                        'name' => 'Văn phòng Paris',
                        'address' => '15 Rue de Rivoli, 75004 Paris, Pháp',
                        'phone' => '+33 1 42 72 88 86',
                        'email' => 'paris@travelbling.com',
                    ],
                ];
                foreach ($offices as $office):
                    ?>
                    <div class="bg-white border border-surface-variant rounded-xl p-7 shadow-sm">
                        <h3 class="font-headline font-bold text-on-secondary-fixed text-lg mb-5 flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary text-base">location_on</span>
                            <?php echo htmlspecialchars($office['name']); ?>
                        </h3>
                        <div class="space-y-3 text-sm text-on-surface-variant">
                            <p><span class="font-semibold text-on-surface">Địa chỉ:</span> <?php echo htmlspecialchars($office['address']); ?></p>
                            <p><span class="font-semibold text-on-surface">Điện thoại:</span> <?php echo htmlspecialchars($office['phone']); ?></p>
                            <p><span class="font-semibold text-on-surface">Email:</span> <?php echo htmlspecialchars($office['email']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Map visual -->
    <section class="h-[340px] relative overflow-hidden">
        <img
            src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=1800&q=80"
            alt="World map"
            class="w-full h-full object-cover grayscale" />
        <div class="absolute inset-0 bg-[#001945]/25"></div>
        <div class="absolute right-8 bottom-8 bg-white rounded-md shadow-lg overflow-hidden">
            <button class="block px-4 py-2 text-lg border-b border-surface-variant hover:bg-surface-container-low">+</button>
            <button class="block px-4 py-2 text-lg hover:bg-surface-container-low">-</button>
        </div>
    </section>

    <!-- Contact form + side card -->
    <section class="py-16 bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-xl p-8 shadow-sm border border-surface-variant">
                <h3 class="font-headline text-3xl font-bold text-on-secondary-fixed">Gửi yêu cầu tư vấn</h3>
                <p class="text-on-surface-variant mt-2 mb-8">Chúng tôi phản hồi trong vòng 24 giờ làm việc.</p>
                <form class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-xs font-semibold tracking-wider uppercase text-outline mb-2 block">Họ và tên</label>
                        <input type="text" class="w-full border border-surface-variant rounded-md px-4 py-3 focus:ring-2 focus:ring-secondary/30 focus:border-secondary outline-none" placeholder="Nhập họ và tên" />
                    </div>
                    <div>
                        <label class="text-xs font-semibold tracking-wider uppercase text-outline mb-2 block">Địa chỉ email</label>
                        <input type="email" class="w-full border border-surface-variant rounded-md px-4 py-3 focus:ring-2 focus:ring-secondary/30 focus:border-secondary outline-none" placeholder="name@example.com" />
                    </div>
                    <div>
                        <label class="text-xs font-semibold tracking-wider uppercase text-outline mb-2 block">Số điện thoại</label>
                        <input type="text" class="w-full border border-surface-variant rounded-md px-4 py-3 focus:ring-2 focus:ring-secondary/30 focus:border-secondary outline-none" placeholder="+84" />
                    </div>
                    <div>
                        <label class="text-xs font-semibold tracking-wider uppercase text-outline mb-2 block">Chủ đề</label>
                        <input type="text" class="w-full border border-surface-variant rounded-md px-4 py-3 focus:ring-2 focus:ring-secondary/30 focus:border-secondary outline-none" placeholder="Đăng ký tour" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs font-semibold tracking-wider uppercase text-outline mb-2 block">Nội dung</label>
                        <textarea rows="6" class="w-full border border-surface-variant rounded-md px-4 py-3 focus:ring-2 focus:ring-secondary/30 focus:border-secondary outline-none resize-none" placeholder="Bạn cần chúng tôi hỗ trợ gì cho chuyến đi sắp tới?"></textarea>
                    </div>
                    <div class="md:col-span-2 flex justify-end">
                        <button type="submit" class="bg-on-primary-container text-white px-8 py-3 rounded-md font-bold hover:brightness-110 transition-all">
                            Gửi tin nhắn
                        </button>
                    </div>
                </form>
            </div>

            <aside class="space-y-6">
                <div class="bg-secondary text-white rounded-xl p-6 shadow-md">
                    <div class="text-sm uppercase tracking-wider text-secondary-fixed">Hotline 24/7</div>
                    <p class="text-white/80 text-sm mt-2">Cần đặt tour gấp hoặc hỗ trợ khẩn? Hãy gọi cho chúng tôi bất cứ lúc nào.</p>
                    <p class="font-headline text-4xl font-bold mt-5">+84 1900 1234</p>
                </div>

                <div class="bg-white rounded-xl p-6 border border-surface-variant">
                    <h4 class="font-bold text-on-secondary-fixed mb-4 uppercase tracking-wider text-sm">Kết nối với chúng tôi</h4>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <a href="#" class="border border-surface-variant rounded-md px-3 py-2 hover:bg-surface-container-low transition-colors">Facebook</a>
                        <a href="#" class="border border-surface-variant rounded-md px-3 py-2 hover:bg-surface-container-low transition-colors">Instagram</a>
                        <a href="#" class="border border-surface-variant rounded-md px-3 py-2 hover:bg-surface-container-low transition-colors">LinkedIn</a>
                        <a href="#" class="border border-surface-variant rounded-md px-3 py-2 hover:bg-surface-container-low transition-colors">YouTube</a>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-surface-variant">
                    <p class="font-semibold text-on-secondary-fixed">Dịch vụ Travel Concierge?</p>
                    <p class="text-sm text-on-surface-variant mt-2">Bạn cần hỗ trợ cao cấp cho chuyến đi cá nhân hoặc công tác?</p>
                    <a href="mailto:concierge@travelbling.com" class="inline-block mt-3 text-secondary font-semibold hover:text-on-primary-container">
                        concierge@travelbling.com
                    </a>
                </div>
            </aside>
        </div>
    </section>
</main>
