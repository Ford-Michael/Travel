<?php
/**
 * Register View - Viet Sun Travel
 * Matches provided register design
 */
?><!-- Register Section with Background -->
<div class="relative min-h-screen flex items-center justify-center overflow-hidden py-12 px-4 sm:px-6 lg:px-8">

    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img
            alt="Vịnh Hạ Long"
            class="w-full h-full object-cover"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAeNjuX9bY9stYRyj58sK9ylwIrSz1U8Lrr8mWf6B3AHl7mA_EQhCvFoRbPyqwWrJ_Gxqwr_WjGt_1JAPExXCnm-IIEkU4Zp031VTB7oDgItEde6wd0_Zu9d76IxV71v1ZR68Cds9LAHi5QyV1CBZ0nrXgz7X-4Y9Ahavvsb_PYuLiW8W0y-tbiNd0WV4qctVmzTj1VDygxycq0PUVhIkSyKTTGPHfl1u-fr_VNOC5K7SKDq9j745FkQUSIT84myIIvE6j2QJebN0cT"
        />
        <div class="absolute inset-0 bg-on-secondary-container/30 mix-blend-multiply"></div>
    </div>

    <!-- Registration Card -->
    <main class="relative z-10 w-full max-w-xl">
        <div class="bg-surface-container-lowest rounded-xl shadow-[0px_12px_32px_rgba(25,28,29,0.06)] overflow-hidden flex flex-col"
             style="background: rgba(255,255,255,0.92); backdrop-filter: blur(12px);">

            <!-- Card Header -->
            <div class="px-8 pt-10 pb-6 text-center">
                <div class="mb-4 inline-block">
                    <a href="index.php?controller=home">
                <img src="/travel.bling/img/travel-bling-logo-cropped.png"
                    alt="Travel Bling - Your Soulmate Knock"
                             class="h-16 w-auto object-contain mx-auto"
                        />
                    </a>
                </div>
                <h1 class="font-headline text-3xl font-bold text-on-secondary-fixed tracking-tight mb-2">Tạo Tài Khoản</h1>
                <p class="text-on-surface-variant">Bắt đầu hành trình khám phá thế giới cùng chúng tôi.</p>
            </div>

            <!-- Flash Message -->
            <?php if (isset($flash) && $flash): ?>
            <div class="mx-8 mb-2 px-4 py-3 rounded-lg text-sm font-medium
                <?php echo $flash['type'] === 'success'
                    ? 'bg-green-50 text-green-800 border border-green-200'
                    : 'bg-red-50 text-red-800 border border-red-200'; ?>">
                <?php echo $flash['message']; ?>
            </div>
            <?php endif; ?>

            <!-- Registration Form -->
            <form action="index.php?controller=auth&action=register" method="POST" class="px-8 pb-8 space-y-5">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token ?? ''); ?>"/>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5 ml-1" for="reg-username">Tên đăng nhập</label>
                    <input
                        class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface/50 focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all placeholder:text-outline/50"
                        id="reg-username"
                        name="username"
                        placeholder="Tên đăng nhập của bạn"
                        required
                        type="text"
                        autocomplete="username"
                    />
                </div>

                <!-- Email Address -->
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5 ml-1" for="reg-email">Địa chỉ Email</label>
                    <input
                        class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface/50 focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all placeholder:text-outline/50"
                        id="reg-email"
                        name="email"
                        placeholder="name@example.com"
                        required
                        type="email"
                        autocomplete="email"
                    />
                </div>

                <!-- Phone Number -->
                <div>
                    <label class="block text-sm font-medium text-on-surface mb-1.5 ml-1" for="reg-phone">Số điện thoại <span class="text-outline text-xs">(tuỳ chọn)</span></label>
                    <input
                        class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface/50 focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all placeholder:text-outline/50"
                        id="reg-phone"
                        name="phone"
                        placeholder="0912345678"
                        type="tel"
                        autocomplete="tel"
                        pattern="[0-9]{10}"
                        maxlength="10"
                        title="Vui lòng nhập đúng 10 chữ số"
                    />
                </div>

                <!-- Password Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-on-surface mb-1.5 ml-1" for="reg-password">Mật khẩu</label>
                        <input
                            class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface/50 focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all placeholder:text-outline/50"
                            id="reg-password"
                            name="password"
                            placeholder="••••••••"
                            required
                            type="password"
                            autocomplete="new-password"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-on-surface mb-1.5 ml-1" for="reg-confirm-password">Xác nhận mật khẩu</label>
                        <input
                            class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface/50 focus:ring-2 focus:ring-secondary/20 focus:border-secondary outline-none transition-all placeholder:text-outline/50"
                            id="reg-confirm-password"
                            name="confirm_password"
                            placeholder="••••••••"
                            required
                            type="password"
                            autocomplete="new-password"
                        />
                    </div>
                </div>

                <!-- Terms Checkbox -->
                <div class="flex items-start gap-3 pt-2">
                    <div class="flex items-center h-5">
                        <input
                            class="h-4 w-4 rounded border-outline-variant text-on-primary-container focus:ring-on-primary-container"
                            id="reg-terms"
                            name="terms"
                            required
                            type="checkbox"
                        />
                    </div>
                    <label class="text-sm text-on-surface-variant leading-relaxed" for="reg-terms">
                        Tôi đồng ý với
                        <a class="text-secondary hover:underline font-medium" href="#">Điều khoản Dịch vụ</a>
                        và
                        <a class="text-secondary hover:underline font-medium" href="#">Chính sách Bảo mật</a>.
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button
                        class="w-full py-4 px-6 bg-on-primary-container text-white font-headline font-bold rounded-lg shadow-lg shadow-on-primary-container/20 hover:brightness-110 transition-all active:scale-[0.98] focus:ring-4 focus:ring-on-primary-container/30"
                        type="submit">
                        Tạo Tài Khoản
                    </button>
                </div>

                <!-- Social Sign Up Divider -->
                <div class="relative py-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline-variant/30"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-surface-container-lowest text-on-surface-variant font-medium">Hoặc đăng ký với</span>
                    </div>
                </div>

                <!-- Social Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <button class="flex items-center justify-center gap-2 px-4 py-3 border border-outline-variant rounded-lg hover:bg-surface transition-colors active:scale-95" type="button">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span class="text-sm font-medium text-on-surface">Google</span>
                    </button>
                    <button class="flex items-center justify-center gap-2 px-4 py-3 border border-outline-variant rounded-lg hover:bg-surface transition-colors active:scale-95" type="button">
                        <svg class="w-5 h-5" fill="#1877F2" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="text-sm font-medium text-on-surface">Facebook</span>
                    </button>
                </div>

                <!-- Footer Link -->
                <div class="text-center pt-4 pb-2">
                    <p class="text-sm text-on-surface-variant">
                        Đã có tài khoản?
                        <a class="text-on-primary-container font-bold hover:text-primary transition-colors underline-offset-4 decoration-2 decoration-on-primary-container/20 hover:decoration-on-primary-container ml-1"
                           href="index.php?controller=auth&action=login">
                            Đăng nhập
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Trust Indicators -->
        <div class="mt-8 grid grid-cols-3 gap-4 text-center">
            <div class="p-3">
                <span class="material-symbols-outlined text-white/80 block mb-1">verified_user</span>
                <span class="text-[10px] uppercase tracking-widest text-white/60 font-bold">Bảo mật</span>
            </div>
            <div class="p-3">
                <span class="material-symbols-outlined text-white/80 block mb-1">workspace_premium</span>
                <span class="text-[10px] uppercase tracking-widest text-white/60 font-bold">Uy tín</span>
            </div>
            <div class="p-3">
                <span class="material-symbols-outlined text-white/80 block mb-1">support_agent</span>
                <span class="text-[10px] uppercase tracking-widest text-white/60 font-bold">24/7 Hỗ trợ</span>
            </div>
        </div>
    </main>
</div>

