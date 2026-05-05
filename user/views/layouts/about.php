<!DOCTYPE html>
<html class="light" lang="vi">

<?php
if ((!isset($user) || !$user) && !empty($_SESSION['user_id'])) {
    $user = [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['user_username'] ?? '',
        'email' => $_SESSION['user_email'] ?? '',
    ];
}
?>

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title><?php echo htmlspecialchars($title ?? 'Giới Thiệu | Travel Bling'); ?></title>
    <meta name="description"
        content="<?php echo htmlspecialchars($description ?? 'Tìm hiểu về Travel Bling - đơn vị lữ hành uy tín hàng đầu với hơn 20 năm kinh nghiệm.'); ?>" />

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-surface": "#191c1d",
                        "surface-container-low": "#f3f4f5",
                        "primary-fixed": "#ffdad6",
                        "surface": "#f8f9fa",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-highest": "#e1e3e4",
                        "on-surface-variant": "#454652",
                        "secondary": "#2b5bb5",
                        "on-secondary": "#ffffff",
                        "on-secondary-fixed": "#001945",
                        "on-secondary-container": "#00337c",
                        "secondary-fixed": "#d9e2ff",
                        "secondary-fixed-dim": "#b0c6ff",
                        "on-primary-container": "#ff645a",
                        "primary": "#400002",
                        "primary-container": "#680006",
                        "surface-container": "#edeeef",
                        "surface-container-high": "#e7e8e9",
                        "surface-dim": "#d9dadb",
                        "surface-bright": "#f8f9fa",
                        "outline": "#767683",
                        "outline-variant": "#c6c5d4",
                        "inverse-surface": "#2e3132",
                        "inverse-on-surface": "#f0f1f2",
                        "background": "#f8f9fa",
                        "on-background": "#191c1d",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "tertiary-fixed": "#ffdeac",
                        "tertiary-fixed-dim": "#ffba38"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg":  "0.25rem",
                        "xl":  "0.5rem",
                        "full":"0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Plus Jakarta Sans"],
                        "body":     ["Be Vietnam Pro"],
                        "label":    ["Be Vietnam Pro"]
                    }
                }
            }
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .editorial-bleed { margin-right: -10vw; }
        .glass-badge {
            background: rgba(43, 91, 181, 0.4);
            backdrop-filter: blur(20px);
        }
    </style>

    <?php echo $headExtra ?? ''; ?>
</head>

<body class="bg-surface text-on-surface font-body selection:bg-on-primary-container selection:text-white">

    <!-- ============================================================
         TOP BAR
    ============================================================ -->
    <div class="bg-[#00337c] text-white py-2 px-8 text-xs font-medium">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex gap-6">
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">call</span> Hotline: 0365 690 399
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">mail</span> info@travel.bling
                </span>
            </div>
            <div class="flex gap-4 items-center">
                <a class="hover:text-yellow-300 transition-colors" href="#">
                    <span class="material-symbols-outlined text-sm">facebook</span>
                </a>
                <a class="hover:text-yellow-300 transition-colors" href="#">
                    <span class="material-symbols-outlined text-sm">photo_camera</span>
                </a>
                <span class="text-white/30">|</span>
                <a class="hover:text-yellow-300 transition-colors" href="#">Trở thành đối tác</a>
            </div>
        </div>
    </div>

    <!-- ============================================================
         NAVBAR
    ============================================================ -->
    <header class="sticky top-0 w-full z-50 bg-white shadow-md">
        <nav class="flex justify-between items-center px-6 py-1 max-w-7xl mx-auto">

            <!-- Logo -->
            <a href="index.php?controller=home" class="flex items-center shrink-0">
                <img src="/travel.bling/img/travel-bling-logo-cropped.png"
                    alt="Travel Bling" class="h-16 w-auto object-contain" />
            </a>

            <!-- Desktop Nav -->
            <div class="hidden xl:flex items-center gap-0 font-['Plus_Jakarta_Sans'] font-semibold text-[12px] tracking-wide uppercase">

                <!-- Giới Thiệu (active) -->
                <a class="text-white bg-[#00337c] px-3 py-5 transition-colors duration-200 whitespace-nowrap"
                    href="index.php?controller=home&action=about">Giới Thiệu</a>

                <!-- Du Lịch Trong Nước -->
                <div class="relative group">
                    <a class="text-[#00337c] hover:bg-[#00337c] hover:text-white px-3 py-5 transition-colors duration-200 flex items-center gap-0.5 whitespace-nowrap cursor-pointer"
                        href="index.php?controller=tour&action=search&q=trong+nuoc">
                        Du Lịch Trong Nước
                        <span class="material-symbols-outlined text-[16px] leading-none">expand_more</span>
                    </a>
                    <div class="absolute top-full left-0 bg-white shadow-xl border-t-2 border-[#e84c3d] min-w-[200px] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="index.php?controller=tour&action=search&q=Miền+Bắc"   class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Miền Bắc</a>
                        <a href="index.php?controller=tour&action=search&q=Miền+Trung" class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Miền Trung</a>
                        <a href="index.php?controller=tour&action=search&q=Miền+Nam"   class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Miền Nam</a>
                        <a href="index.php?controller=tour&action=search&q=Hải+Đảo"   class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider">Hải Đảo</a>
                    </div>
                </div>

                <!-- Du Lịch Ngoài Nước -->
                <div class="relative group">
                    <a class="text-[#00337c] hover:bg-[#00337c] hover:text-white px-3 py-5 transition-colors duration-200 flex items-center gap-0.5 whitespace-nowrap cursor-pointer"
                        href="index.php?controller=tour">
                        Du Lịch Ngoài Nước
                        <span class="material-symbols-outlined text-[16px] leading-none">expand_more</span>
                    </a>
                    <div class="absolute top-full left-0 bg-white shadow-xl border-t-2 border-[#e84c3d] min-w-[200px] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="index.php?controller=tour&action=search&q=Châu+Âu" class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Châu Âu</a>
                        <a href="index.php?controller=tour&action=search&q=Châu+Á"  class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Châu Á</a>
                        <a href="index.php?controller=tour&action=search&q=Châu+Mỹ" class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Châu Mỹ</a>
                        <a href="index.php?controller=tour&action=search&q=Châu+Úc" class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Châu Úc</a>
                        <a href="index.php?controller=tour&action=search&q=Châu+Phi" class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider">Châu Phi</a>
                    </div>
                </div>

                <!-- Tour Khách Đoàn -->
                <div class="relative group">
                    <a class="text-[#00337c] hover:bg-[#00337c] hover:text-white px-3 py-5 transition-colors duration-200 flex items-center gap-0.5 whitespace-nowrap cursor-pointer" href="#">
                        Tour Khách Đoàn
                        <span class="material-symbols-outlined text-[16px] leading-none">expand_more</span>
                    </a>
                    <div class="absolute top-full left-0 bg-white shadow-xl border-t-2 border-[#e84c3d] min-w-[210px] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="index.php?controller=tour&action=mice-delegation&type=doanh-nghiep" class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Tour Doanh Nghiệp</a>
                        <a href="index.php?controller=tour&action=mice-delegation&type=gia-dinh" class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Tour Gia Đình</a>
                        <a href="index.php?controller=tour&action=mice-delegation&type=nhom" class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Tour Nhóm</a>
                        <a href="index.php?controller=tour&action=mice-delegation&type=team-building" class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Tour Team Building</a>
                        <a href="index.php?controller=tour&action=mice-delegation&type=sinh-vien-hoc-sinh" class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider">Tour Sinh Viên - Học Sinh</a>
                    </div>
                </div>

                <!-- Khuyến Mãi -->
                <a class="text-[#e84c3d] hover:bg-[#e84c3d] hover:text-white px-3 py-5 transition-colors duration-200 flex items-center gap-1 font-bold whitespace-nowrap" href="#">
                    <span class="material-symbols-outlined text-[16px]" style="font-variation-settings:'FILL' 1">local_offer</span>
                    Khuyến Mãi
                </a>

                <!-- Tin Tức (dropdown: Cẩm Nang + Liên Hệ) -->
                <div class="relative group">
                    <a class="text-[#00337c] hover:bg-[#00337c] hover:text-white px-3 py-5 transition-colors duration-200 flex items-center gap-1 whitespace-nowrap cursor-pointer"
                        href="index.php?controller=home&action=news">
                        <span class="material-symbols-outlined text-[16px]">newspaper</span>
                        Tin Tức
                        <span class="material-symbols-outlined text-[16px] leading-none">expand_more</span>
                    </a>
                    <div class="absolute top-full left-0 bg-white shadow-xl border-t-2 border-[#e84c3d] min-w-[210px] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <a href="index.php?controller=home&action=blog"
                            class="flex items-center gap-2 px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">
                            <span class="material-symbols-outlined text-sm">menu_book</span> Cẩm Nang Du Lịch
                        </a>
                        <a href="index.php?controller=home&action=contact"
                            class="flex items-center gap-2 px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider">
                            <span class="material-symbols-outlined text-sm">call</span> Liên Hệ
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Search + Auth -->
            <div class="flex items-center gap-2 shrink-0">
                <form method="get" action="index.php" class="hidden lg:flex items-center bg-gray-100 rounded-full px-3 py-1.5 gap-1">
                    <input type="hidden" name="controller" value="tour">
                    <input type="hidden" name="action" value="search">
                    <input type="text" name="q" placeholder="Tìm tour..." class="bg-transparent text-xs text-gray-600 outline-none w-24 font-['Plus_Jakarta_Sans']">
                    <button type="submit" class="material-symbols-outlined text-[#00337c] text-lg leading-none">search</button>
                </form>

                <?php if (isset($user) && $user): ?>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#00337c] text-2xl" style="font-variation-settings:'FILL' 1">account_circle</span>
                        <span class="text-xs text-gray-600 font-semibold hidden lg:inline"><?php echo htmlspecialchars($user['username']); ?></span>
                        <a href="index.php?controller=account"
                            class="border border-[#00337c] text-[#00337c] px-3 py-1.5 rounded-full font-bold text-xs hover:bg-[#00337c] hover:text-white transition-all">
                            Tai khoan
                        </a>
                        <a href="index.php?controller=auth&action=logout"
                            class="border border-gray-300 text-gray-600 px-3 py-1.5 rounded-full font-bold text-xs hover:bg-gray-100 transition-all">
                            Đăng xuất
                        </a>
                    </div>
                <?php else: ?>
                    <a href="index.php?controller=auth&action=login"
                        class="border-2 border-[#00337c] text-[#00337c] px-4 py-2 rounded-full font-bold text-xs hover:bg-[#00337c] hover:text-white transition-all whitespace-nowrap">
                        Đăng Nhập
                    </a>
                    <a href="index.php?controller=auth&action=register"
                        class="bg-[#e84c3d] text-white px-4 py-2 rounded-full font-bold text-xs shadow hover:brightness-110 active:scale-95 transition-all whitespace-nowrap">
                        Đăng Ký
                    </a>
                <?php endif; ?>

                <button id="mobile-menu-btn" class="xl:hidden p-2 text-[#00337c]" aria-label="Menu">
                    <span class="material-symbols-outlined text-2xl">menu</span>
                </button>
            </div>
        </nav>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="hidden xl:hidden bg-white border-t border-gray-200 px-6 py-4 space-y-1 text-sm font-semibold text-[#00337c]">
            <a class="flex items-center gap-2 py-2.5 border-b border-gray-100 bg-[#00337c] text-white px-3 rounded" href="index.php?controller=home&action=about">Giới Thiệu</a>
            <a class="flex items-center gap-2 py-2.5 border-b border-gray-100" href="index.php?controller=tour&action=search&q=trong+nuoc">Du Lịch Trong Nước</a>
            <a class="flex items-center gap-2 py-2.5 border-b border-gray-100" href="index.php?controller=tour">Du Lịch Ngoài Nước</a>
            <a class="flex items-center gap-2 py-2.5 border-b border-gray-100" href="index.php?controller=tour&action=mice-delegation&type=doanh-nghiep">Tour Khách Đoàn</a>
            <div class="pl-4 space-y-1 pb-2 border-b border-gray-100">
                <a class="block py-1.5 text-xs text-[#00337c]/85" href="index.php?controller=tour&action=mice-delegation&type=gia-dinh">· Tour Gia đình</a>
                <a class="block py-1.5 text-xs text-[#00337c]/85" href="index.php?controller=tour&action=mice-delegation&type=nhom">· Tour nhóm</a>
                <a class="block py-1.5 text-xs text-[#00337c]/85" href="index.php?controller=tour&action=mice-delegation&type=team-building">· Team building</a>
                <a class="block py-1.5 text-xs text-[#00337c]/85" href="index.php?controller=tour&action=mice-delegation&type=sinh-vien-hoc-sinh">· Sinh viên — học sinh</a>
            </div>
            <a class="flex items-center gap-2 py-2.5 border-b border-gray-100 text-[#e84c3d]" href="#">
                <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1">local_offer</span> Khuyến Mãi
            </a>
            <div>
                <a class="flex items-center gap-2 py-2.5 border-b border-gray-100" href="index.php?controller=home&action=news">
                    <span class="material-symbols-outlined text-base">newspaper</span> Tin Tức
                </a>
                <div class="pl-6 space-y-1 mt-1">
                    <a class="flex items-center gap-2 py-2 text-xs text-[#00337c]/80 border-b border-gray-50" href="index.php?controller=home&action=blog">
                        <span class="material-symbols-outlined text-sm">menu_book</span> Cẩm Nang Du Lịch
                    </a>
                    <a class="flex items-center gap-2 py-2 text-xs text-[#00337c]/80" href="index.php?controller=home&action=contact">
                        <span class="material-symbols-outlined text-sm">call</span> Liên Hệ
                    </a>
                </div>
            </div>
        </div>
    </header>
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    <!-- Flash Messages (always shown) -->
    <?php if (isset($flash) && $flash): ?>
        <div class="fixed top-20 right-4 z-[100] max-w-sm">
            <div
                class="flex items-start gap-3 px-5 py-4 rounded-xl shadow-xl
            <?php echo $flash['type'] === 'success' ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800'; ?>">
                <span class="material-symbols-outlined text-lg flex-shrink-0">
                    <?php echo $flash['type'] === 'success' ? 'check_circle' : 'error'; ?>
                </span>
                <p class="text-sm font-medium"><?php echo $flash['message']; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- ============================================================
         PAGE CONTENT (injected from about.php view)
    ============================================================ -->
    <?php echo $content ?? ''; ?>

    <!-- ============================================================
         FOOTER
    ============================================================ -->
    <footer class="bg-[#2e3132] dark:bg-black w-full pt-20 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 px-8 max-w-7xl mx-auto font-['Be_Vietnam_Pro'] text-base leading-relaxed">

            <!-- Brand -->
            <div class="space-y-6">
                <img src="/travel.bling/img/travel-bling-logo-cropped.png"
                    alt="Travel Bling" class="h-16 w-auto object-contain" style="mix-blend-mode: screen;" />
                <p class="text-[#c6c5d4] text-sm">Tự hào là đơn vị lữ hành uy tín hàng đầu, chuyên cung cấp các tour du lịch trong và ngoài nước chất lượng cao.</p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:text-[#ff645a] hover:border-[#ff645a] transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:text-[#ff645a] hover:border-[#ff645a] transition-all">
                        <span class="material-symbols-outlined text-lg">photo_camera</span>
                    </a>
                </div>
            </div>

            <!-- Khám Phá -->
            <div class="space-y-6">
                <h4 class="text-white font-bold uppercase tracking-widest text-sm">Khám Phá</h4>
                <ul class="space-y-4 text-[#c6c5d4]">
                    <li><a class="hover:text-[#ff645a] transition-all duration-300 hover:translate-x-1 inline-block" href="index.php?controller=tour">Tours Trong Nước</a></li>
                    <li><a class="hover:text-[#ff645a] transition-all duration-300 hover:translate-x-1 inline-block" href="index.php?controller=tour">Tours Quốc Tế</a></li>
                    <li><a class="hover:text-[#ff645a] transition-all duration-300 hover:translate-x-1 inline-block" href="index.php?controller=tour&action=mice-delegation&type=doanh-nghiep">Tour Đoàn / MICE</a></li>
                    <li><a class="hover:text-[#ff645a] transition-all duration-300 hover:translate-x-1 inline-block" href="#">Khuyến Mãi</a></li>
                </ul>
            </div>

            <!-- Công Ty -->
            <div class="space-y-6">
                <h4 class="text-white font-bold uppercase tracking-widest text-sm">Công Ty</h4>
                <ul class="space-y-4 text-[#c6c5d4]">
                    <li><a class="hover:text-[#ff645a] transition-all duration-300 hover:translate-x-1 inline-block" href="index.php?controller=home&action=about">Về Chúng Tôi</a></li>
                    <li><a class="hover:text-[#ff645a] transition-all duration-300 hover:translate-x-1 inline-block" href="index.php?controller=home&action=news">Tin Tức Du Lịch</a></li>
                    <li><a class="hover:text-[#ff645a] transition-all duration-300 hover:translate-x-1 inline-block" href="#">Điều khoản dịch vụ</a></li>
                    <li><a class="hover:text-[#ff645a] transition-all duration-300 hover:translate-x-1 inline-block" href="index.php?controller=home&action=contact">Hỗ Trợ</a></li>
                </ul>
            </div>

            <!-- Liên Hệ -->
            <div class="space-y-6">
                <h4 class="text-white font-bold uppercase tracking-widest text-sm">Liên Hệ</h4>
                <div class="text-[#c6c5d4] space-y-4 text-sm">
                    <p class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-[#ff645a]">location_on</span>
                        268 Lý Thường Kiệt, Phường 14, Quận 10, TP.HCM
                    </p>
                    <p class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#ff645a]">phone_iphone</span>
                        0365 690 399
                    </p>
                    <p class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#ff645a]">alternate_email</span>
                        info@travelbling.com
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-8 mt-20 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-[#c6c5d4] text-xs">© <?php echo date('Y'); ?> Travel Bling. All rights reserved.</p>
            <div class="flex gap-8 text-[#c6c5d4] text-xs">
                <a class="hover:text-[#ff645a] transition-colors" href="#">Chính sách bảo mật</a>
                <a class="hover:text-[#ff645a] transition-colors" href="#">Điều khoản dịch vụ</a>
                <span>Giấy phép kinh doanh lữ hành quốc tế số 01-698/2002/TCDL</span>
            </div>
        </div>
    </footer>

    <?php echo $scripts ?? ''; ?>

</body>
</html>
