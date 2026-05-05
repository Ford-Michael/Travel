<?php
/**
 * Login View - Viet Sun Travel
 * Matches provided design: top bar + header + hero + sections + footer layout
 */
?>
<!-- ===== HERO LOGIN SECTION ===== -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden py-16 px-4">

    <!-- Background: reuse hero image -->
    <div class="absolute inset-0 z-0">
        <img
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3ngIQCL5AeGOREUnb5KCs98ALVc6lvFXmx8GSQTmO-EdWj8PqTBzmFXvALsvbHNDLZ8ZXL8wGC6udjgG0eLiSOeJxnkamut8lgVXN1vZsbXc8Vt4H79Pu00isAGLI-Xhhc2R8VELRR4w1vQNJQaZJ1Aw2zxuH1YrM0L3BKqF2TpaSQXRlC-vrU4igGkrJ0a0HTcri8tQ4XLTgSIyeckEYV8n3lrVyuJsMdPzvQD6IVDELLtKE_iEFof4aWT42jM2YEsG4fIyIctOL"
            alt="Vịnh Hạ Long"
            class="w-full h-full object-cover brightness-75"
        />
        <div class="absolute inset-0 bg-gradient-to-tr from-on-secondary-fixed/50 to-transparent"></div>
    </div>

    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-md">
        <div class="bg-surface-container-lowest rounded-xl shadow-[0px_12px_32px_rgba(25,28,29,0.12)] overflow-hidden"
             style="background: rgba(255,255,255,0.92); backdrop-filter: blur(12px);">

            <!-- Card Header -->
            <div class="px-8 pt-10 pb-6 text-center border-b border-outline-variant/20">
                <a href="index.php?controller=home" class="inline-block mb-3">
                <img src="/travel.bling/img/travel-bling-logo-cropped.png"
                    alt="Travel Bling - Your Soulmate Knock"
                         class="h-16 w-auto object-contain mx-auto"
                    />
                </a>
                <h1 class="font-headline text-2xl font-bold text-on-secondary-fixed tracking-tight mb-1">Đăng nhập</h1>
                <p class="text-on-surface-variant text-sm">Chào mừng trở lại! Hãy tiếp tục hành trình của bạn.</p>
            </div>

            <!-- Flash Message -->
            <?php if (isset($flash) && $flash): ?>
            <div class="mx-8 mt-6 px-4 py-3 rounded-lg text-sm font-medium
                <?php echo $flash['type'] === 'success'
                    ? 'bg-green-50 text-green-800 border border-green-200'
                    : 'bg-red-50 text-red-800 border border-red-200'; ?>">
                <?php echo $flash['message']; ?>
            </div>
            <?php endif; ?>

            <!-- Form -->
            <form action="index.php?controller=auth&action=login" method="POST" class="px-8 pt-6 pb-8 space-y-5">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token ?? ''); ?>"/>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-on-surface mb-2" for="login-email">Email hoặc Tên đăng nhập</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline group-focus-within:text-on-primary-container transition-colors">
                            <span class="material-symbols-outlined text-[20px]">person</span>
                        </div>
                        <input
                            id="login-email"
                            type="text"
                            name="email"
                            required
                            autocomplete="username"
                            placeholder="email@example.com"
                            class="block w-full pl-11 pr-4 py-3.5 bg-surface border-none ring-1 ring-outline-variant/30 rounded-lg focus:ring-2 focus:ring-on-primary-container text-on-surface placeholder:text-outline/60 transition-all outline-none"
                        />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-on-surface" for="login-password">Mật khẩu</label>
                        <a href="index.php?controller=auth&action=forgotPassword"
                           class="text-xs text-secondary hover:text-on-primary-container font-medium transition-colors">
                            Quên mật khẩu?
                        </a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline group-focus-within:text-on-primary-container transition-colors">
                            <span class="material-symbols-outlined text-[20px]">lock</span>
                        </div>
                        <input
                            id="login-password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="block w-full pl-11 pr-12 py-3.5 bg-surface border-none ring-1 ring-outline-variant/30 rounded-lg focus:ring-2 focus:ring-on-primary-container text-on-surface placeholder:text-outline/60 transition-all outline-none"
                        />
                        <button type="button" id="toggleLoginPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-on-secondary-fixed transition-colors">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Remember -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="login-remember" name="remember"
                           class="h-4 w-4 rounded border-outline-variant text-on-primary-container focus:ring-on-primary-container"/>
                    <label for="login-remember" class="text-sm text-on-surface-variant cursor-pointer">Ghi nhớ đăng nhập</label>
                </div>

                <!-- Submit -->
                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-4 px-6 bg-on-primary-container text-white font-headline font-bold rounded-xl shadow-lg shadow-on-primary-container/20 hover:brightness-110 active:scale-[0.98] transition-all focus:ring-4 focus:ring-on-primary-container/30">
                        ĐĂNG NHẬP
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative py-2">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-outline-variant/30"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-surface-container-lowest text-on-surface-variant font-medium">Hoặc đăng nhập với</span>
                    </div>
                </div>

                <!-- Social Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <button type="button"
                            class="flex items-center justify-center gap-2 px-4 py-3 border border-outline-variant rounded-lg hover:bg-surface transition-colors active:scale-95">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span class="text-sm font-medium text-on-surface">Google</span>
                    </button>
                    <button type="button"
                            class="flex items-center justify-center gap-2 px-4 py-3 border border-outline-variant rounded-lg hover:bg-surface transition-colors active:scale-95">
                        <svg class="w-5 h-5" fill="#1877F2" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="text-sm font-medium text-on-surface">Facebook</span>
                    </button>
                </div>

                <!-- Footer link -->
                <div class="text-center pt-2 pb-1">
                    <p class="text-sm text-on-surface-variant">
                        Chưa có tài khoản?
                        <a href="index.php?controller=auth&action=register"
                           class="text-on-primary-container font-bold hover:text-primary transition-colors underline-offset-4 decoration-2 decoration-on-primary-container/20 hover:decoration-on-primary-container ml-1">
                            Đăng ký ngay
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
                <span class="text-[10px] uppercase tracking-widest text-white/60 font-bold">Chất lượng</span>
            </div>
            <div class="p-3">
                <span class="material-symbols-outlined text-white/80 block mb-1">support_agent</span>
                <span class="text-[10px] uppercase tracking-widest text-white/60 font-bold">24/7 Hỗ trợ</span>
            </div>
        </div>
    </div>
</section>

<?php
$scripts = <<<'JS'
<script>
    document.getElementById('toggleLoginPassword').addEventListener('click', function () {
        const pw = document.getElementById('login-password');
        const icon = this.querySelector('.material-symbols-outlined');
        if (pw.type === 'password') {
            pw.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            pw.type = 'password';
            icon.textContent = 'visibility';
        }
    });
</script>
JS;
