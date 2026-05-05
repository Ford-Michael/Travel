<?php
/**
 * Forgot Password View - Viet Sun Travel
 * Matches provided forgot password design
 */

<!-- Forgot Password -->
<main class="relative min-h-screen flex items-center justify-center pt-12 pb-12">

    <!-- Background -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img
            alt="Vịnh Hạ Long"
            class="w-full h-full object-cover filter brightness-[0.85] contrast-[1.05]"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCSUtTGSPp52TQQxz29f2Oq5mXN32UaY6kck-xJc2lbE-ugsLYGlmBnPcbC8qfUCG6nI3sEpSyHuodGQSabNjJ9Ss_Nmg2hFVU0xewCRUSgTJJsJpclSKiV3qWtoBWJFFt3vnja_oLrULGkvqQaxox4-SkaIF5ZoYBHbgQ4-AuIIBgHcoBCuUxnyoI82RNqf3daz08ssM8QGlUTjIoQR4kRWsCKaw8F7AJ_R6y9Kspo2aDg6MiR6cH8cwivWoB1V-CO6HxBRjsK6Bbx"
        />
        <div class="absolute inset-0 bg-gradient-to-tr from-on-secondary-fixed/40 to-transparent"></div>
    </div>

    <!-- Reset Card -->
    <div class="relative z-10 w-full max-w-md px-6">
        <div class="bg-surface-container-lowest rounded-xl shadow-[0px_12px_32px_rgba(25,28,29,0.06)] p-10 border border-outline-variant/10"
             style="background: rgba(255,255,255,0.93); backdrop-filter: blur(12px);">

            <!-- Brand -->
            <div class="text-center mb-8">
                <a href="index.php?controller=home" class="block mb-4">
                <img src="/travel.bling/img/travel-bling-logo-cropped.png"
                    alt="Travel Bling - Your Soulmate Knock"
                         class="h-16 w-auto object-contain mx-auto"
                    />
                </a>
                <h1 class="text-2xl font-extrabold text-on-secondary-fixed tracking-tight mb-3">Đặt Lại Mật Khẩu</h1>
                <p class="text-on-surface-variant leading-relaxed text-sm">
                    Nhập địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu.
                </p>
            </div>

            <!-- Flash Message -->
            <?php if (isset($flash) && $flash): ?>
            <div class="mb-6 px-4 py-3 rounded-lg text-sm font-medium
                <?php echo $flash['type'] === 'success'
                    ? 'bg-green-50 text-green-800 border border-green-200'
                    : 'bg-red-50 text-red-800 border border-red-200'; ?>">
                <?php echo $flash['message']; ?>
            </div>
            <?php endif; ?>

            <!-- Form -->
            <form action="index.php?controller=auth&action=forgotPassword" method="POST" class="space-y-6">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token ?? ''); ?>"/>

                <div>
                    <label class="block text-sm font-semibold text-on-surface mb-2" for="forgot-email">Địa chỉ Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-outline group-focus-within:text-on-primary-container transition-colors">
                            <span class="material-symbols-outlined text-[20px]">mail</span>
                        </div>
                        <input
                            class="block w-full pl-11 pr-4 py-3.5 bg-surface border-none ring-1 ring-outline-variant/30 rounded-lg focus:ring-2 focus:ring-on-primary-container text-on-surface placeholder:text-outline/60 transition-all outline-none"
                            id="forgot-email"
                            name="email"
                            placeholder="name@example.com"
                            required
                            type="email"
                            autocomplete="email"
                        />
                    </div>
                </div>

                <button
                    class="w-full bg-on-primary-container text-white font-bold py-4 rounded-xl shadow-sm hover:brightness-110 active:scale-[0.98] transition-all relative overflow-hidden group"
                    type="submit">
                    <span class="relative z-10 font-headline">Gửi Liên Kết Đặt Lại</span>
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"
                         style="border-top: 1px solid rgba(255,255,255,0.2)"></div>
                </button>
            </form>

            <!-- Back to Login -->
            <div class="mt-8 pt-8 border-t border-outline-variant/20 text-center">
                <a class="inline-flex items-center gap-2 text-secondary font-medium hover:text-on-secondary-container transition-colors group"
                   href="index.php?controller=auth&action=login">
                    <span class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                    Quay lại Đăng nhập
                </a>
            </div>
        </div>

        <!-- Branding Accent -->
        <div class="mt-6 flex justify-center opacity-40">
            <div class="h-1 w-12 bg-on-primary-container rounded-full"></div>
        </div>
    </div>
</main>
