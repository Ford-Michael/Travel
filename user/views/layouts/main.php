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
    <title><?php echo htmlspecialchars($title ?? 'Travel Bling | Your Soulmate Knock'); ?></title>
    <meta name="description"
        content="<?php echo htmlspecialchars($description ?? 'Khám phá thế giới cùng Travel Bling - đơn vị lữ hành uy tín hàng đầu.'); ?>" />

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap"
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
                        "on-secondary-fixed": "#001945",
                        "secondary-fixed-dim": "#b0c6ff",
                        "inverse-surface": "#2e3132",
                        "surface-bright": "#f8f9fa",
                        "background": "#f8f9fa",
                        "surface-variant": "#e1e3e4",
                        "on-error-container": "#93000a",
                        "on-primary-fixed": "#410002",
                        "secondary-fixed": "#d9e2ff",
                        "tertiary": "#271800",
                        "outline": "#767683",
                        "secondary": "#2b5bb5",
                        "on-tertiary": "#ffffff",
                        "outline-variant": "#c6c5d4",
                        "tertiary-container": "#422c00",
                        "inverse-on-surface": "#f0f1f2",
                        "tertiary-fixed-dim": "#ffba38",
                        "on-primary-container": "#ff645a",
                        "surface-tint": "#bb171c",
                        "surface-dim": "#d9dadb",
                        "surface-container-highest": "#e1e3e4",
                        "error": "#ba1a1a",
                        "primary-container": "#680006",
                        "secondary-container": "#759efd",
                        "on-surface-variant": "#454652",
                        "on-background": "#191c1d",
                        "inverse-primary": "#ffb4ac",
                        "surface-container-lowest": "#ffffff",
                        "error-container": "#ffdad6",
                        "primary": "#400002",
                        "primary-fixed-dim": "#ffb4ac",
                        "on-secondary": "#ffffff",
                        "on-secondary-container": "#00337c",
                        "surface-container-high": "#e7e8e9",
                        "on-error": "#ffffff",
                        "on-primary": "#ffffff",
                        "surface-container": "#edeeef"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Be Vietnam Pro"],
                        "label": ["Be Vietnam Pro"]
                    }
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .editorial-gradient {
            background: linear-gradient(135deg, #2b5bb5 0%, #00337c 100%);
        }

        .glass-badge {
            background: rgba(225, 227, 228, 0.4);
            backdrop-filter: blur(20px);
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <?php echo $headExtra ?? ''; ?>
</head>

<body class="bg-surface text-on-surface font-body selection:bg-on-primary-container selection:text-white">

    <!-- Top Bar -->
    <?php if (!isset($hideTopBar) || !$hideTopBar): ?>
        <div class="bg-[#00337c] text-white py-2 px-8 text-xs font-medium">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex gap-6">
                    <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-sm">call</span>
                        Hotline: 0365 690 399</span>
                    <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-sm">mail</span>
                        info@travel.bling</span>
                    <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-sm">language</span>
                        travel.bling</span>
                </div>
                <div class="flex gap-4 items-center">
                    <a class="flex items-center gap-1 hover:text-yellow-300 transition-colors" href="#"><span
                            class="material-symbols-outlined text-sm">facebook</span></a>
                    <a class="flex items-center gap-1 hover:text-yellow-300 transition-colors" href="#"><span
                            class="material-symbols-outlined text-sm">photo_camera</span></a>
                    <span class="text-white/30">|</span>
                    <a class="hover:text-yellow-300 transition-colors" href="#">Trở thành đối tác</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Header / Navigation -->
    <?php if (!isset($hideTopBar) || !$hideTopBar): ?>
        <header class="sticky top-0 w-full z-50 bg-white shadow-md">
            <nav class="flex justify-between items-center px-6 py-1 max-w-7xl mx-auto">

                <!-- Logo -->
                <a href="index.php?controller=home" class="flex items-center shrink-0">
                    <img src="/travel.bling/img/travel-bling-logo-cropped.png" alt="Travel Bling - Your Soulmate Knock"
                        class="h-16 w-auto object-contain" />
                </a>

                <!-- Desktop Nav -->
                <div
                    class="hidden xl:flex items-center gap-0 font-['Plus_Jakarta_Sans'] font-semibold text-[12px] tracking-wide uppercase">

                    <!-- Giới Thiệu -->
                    <a class="<?php echo (isset($_GET['controller']) && $_GET['controller'] === 'home' && isset($_GET['action']) && $_GET['action'] === 'about') ? 'text-white bg-[#00337c]' : 'text-[#00337c] hover:bg-[#00337c] hover:text-white'; ?> px-3 py-5 transition-colors duration-200 whitespace-nowrap"
                        href="index.php?controller=home&action=about">Giới Thiệu</a>

                    <!-- Du lich Trong Nuoc -->
                    <div class="relative group">
                        <a class="<?php echo (isset($_GET['controller']) && $_GET['controller'] === 'tour') ? 'text-white bg-[#00337c]' : 'text-[#00337c] hover:bg-[#00337c] hover:text-white'; ?> px-3 py-5 transition-colors duration-200 flex items-center gap-0.5 whitespace-nowrap cursor-pointer"
                            href="index.php?controller=tour&action=domestic">
                            Du lịch trong nước
                            <span class="material-symbols-outlined text-[16px] leading-none">expand_more</span>
                        </a>
                        <div
                            class="absolute top-full left-0 bg-white shadow-xl border-t-2 border-[#e84c3d] min-w-[200px] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="index.php?controller=tour&action=domesticRegion&region=north"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Miền
                                Bắc</a>
                            <a href="index.php?controller=tour&action=domesticRegion&region=central"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Miền
                                Trung</a>
                            <a href="index.php?controller=tour&action=domesticRegion&region=south"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Miền
                                Nam</a>

                            <a href="index.php?controller=tour&action=domesticRegion&region=islands"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider">Hải
                                Đảo</a>
                        </div>
                    </div>
                    <!-- Du Lịch Ngoài Nước -->
                    <div class="relative group">
                        <a class="text-[#00337c] hover:bg-[#00337c] hover:text-white px-3 py-5 transition-colors duration-200 flex items-center gap-0.5 whitespace-nowrap cursor-pointer"
                            href="index.php?controller=tour">
                            Du Lịch Ngoài Nước
                            <span class="material-symbols-outlined text-[16px] leading-none">expand_more</span>
                        </a>
                        <div
                            class="absolute top-full left-0 bg-white shadow-xl border-t-2 border-[#e84c3d] min-w-[200px] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="index.php?controller=tour&action=continent&region=europe"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Châu
                                Âu</a>
                            <a href="index.php?controller=tour&action=continent&region=asia"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Châu
                                Á</a>
                            <a href="index.php?controller=tour&action=continent&region=america"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Châu
                                Mỹ</a>
                            <a href="index.php?controller=tour&action=continent&region=oceania"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Châu
                                Úc</a>
                            <a href="index.php?controller=tour&action=continent&region=africa"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider">Châu
                                Phi</a>
                        </div>
                    </div>

                    <!-- Tour Đoàn -->
                    <div class="relative group">
                        <a class="text-[#00337c] hover:bg-[#00337c] hover:text-white px-3 py-5 transition-colors duration-200 flex items-center gap-0.5 whitespace-nowrap cursor-pointer"
                            href="index.php?controller=tour&action=mice-delegation&type=doanh-nghiep">
                            Tour Khách Đoàn
                            <span class="material-symbols-outlined text-[16px] leading-none">expand_more</span>
                        </a>
                        <div
                            class="absolute top-full left-0 bg-white shadow-xl border-t-2 border-[#e84c3d] min-w-[200px] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="index.php?controller=tour&action=mice-delegation&type=doanh-nghiep"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Tour
                                Doanh Nghiệp</a>
                            <a href="index.php?controller=tour&action=mice-delegation&type=gia-dinh"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Tour
                                Gia Đình</a>
                            <a href="index.php?controller=tour&action=mice-delegation&type=nhom"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">Tour
                                Nhóm</a>
                            <a href="index.php?controller=tour&action=mice-delegation&type=team-building"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider">Tour
                                Team Building</a>
                            <a href="index.php?controller=tour&action=mice-delegation&type=sinh-vien-hoc-sinh"
                                class="block px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider">Tour
                                Sinh Viên - Học Sinh</a>
                        </div>
                    </div>

                    <!-- Khuyến Mãi -->
                    <a class="<?php echo (isset($_GET['controller']) && $_GET['controller'] === 'home' && isset($_GET['action']) && $_GET['action'] === 'promotion') ? 'text-white bg-[#e84c3d]' : 'text-[#e84c3d] hover:bg-[#e84c3d] hover:text-white'; ?> px-3 py-5 transition-colors duration-200 flex items-center gap-1 font-bold whitespace-nowrap"
                        href="index.php?controller=home&action=promotion">
                        <span class="material-symbols-outlined text-[16px]"
                            style="font-variation-settings:'FILL' 1">local_offer</span>
                        Khuyến Mãi
                    </a>



                    <div class="relative group">
                        <a class="text-[#00337c] hover:bg-[#00337c] hover:text-white px-3 py-5 transition-colors duration-200 flex items-center gap-1 whitespace-nowrap cursor-pointer"
                            href="index.php?controller=home&action=news">

                            Dịch vụ
                            <span class="material-symbols-outlined text-[16px] leading-none">expand_more</span>
                        </a>
                        <div
                            class="absolute top-full left-0 bg-white shadow-xl border-t-2 border-[#e84c3d] min-w-[210px] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="index.php?controller=service&action=carRental"
                                class="flex items-center gap-2 px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">
                                <span class="material-symbols-outlined text-sm">directions_car</span>Đặt xe
                            </a>
                            <a href="index.php?controller=service&action=flight"
                                class="flex items-center gap-2 px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">
                                <span class="material-symbols-outlined text-sm">flight_takeoff</span> Đặt vé máy bay
                            </a>
                            <a href="index.php?controller=service&action=hotel"
                                class="flex items-center gap-2 px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider border-b border-gray-100">
                                <span class="material-symbols-outlined text-sm">hotel</span> Đặt phòng khách sạn
                            </a>

                            <a href="index.php?controller=service&action=visa"
                                class="flex items-center gap-2 px-5 py-3 text-[#333] hover:bg-[#00337c] hover:text-white text-[11px] font-semibold uppercase tracking-wider">
                                <span class="material-symbols-outlined text-sm">public</span>VISA
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Tin Tức (dropdown: Cẩm Nang Du Lịch + Liên Hệ) -->
                <div class="relative group">
                    <a class="text-[#00337c] hover:bg-[#00337c] hover:text-white px-3 py-5 transition-colors duration-200 flex items-center gap-1 whitespace-nowrap cursor-pointer"
                        href="index.php?controller=home&action=news">
                        <span class="material-symbols-outlined text-[16px]">newspaper</span>
                        Tin Tức
                        <span class="material-symbols-outlined text-[16px] leading-none">expand_more</span>
                    </a>
                    <div
                        class="absolute top-full left-0 bg-white shadow-xl border-t-2 border-[#e84c3d] min-w-[210px] z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
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

                <!-- Right: Search + Auth -->
                <div class="flex items-center gap-2 shrink-0">
                    <!-- Search -->
                    <form method="get" action="index.php"
                        class="hidden lg:flex items-center bg-gray-100 rounded-full px-3 py-1.5 gap-1">
                        <input type="hidden" name="controller" value="tour">
                        <input type="hidden" name="action" value="search">
                        <input type="text" name="q" placeholder="Tìm tour..."
                            class="bg-transparent text-xs text-gray-600 outline-none w-24 font-['Plus_Jakarta_Sans']">
                        <button type="submit"
                            class="material-symbols-outlined text-[#00337c] text-lg leading-none">search</button>
                    </form>

                    <?php if (isset($user) && $user): ?>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#00337c] text-2xl"
                                style="font-variation-settings:'FILL' 1">account_circle</span>
                            <span
                                class="text-xs text-gray-600 font-semibold hidden lg:inline"><?php echo htmlspecialchars($user['username']); ?></span>
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

                    <!-- Mobile menu toggle -->
                    <button id="mobile-menu-btn" class="xl:hidden p-2 text-[#00337c]" aria-label="Menu">
                        <span class="material-symbols-outlined text-2xl">menu</span>
                    </button>
                </div>
            </nav>

            <!-- Mobile Drawer -->

        </header>
        <script>
            document.getElementById('mobile-menu-btn').addEventListener('click', function () {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });
        </script>
    <?php endif; ?>

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

    <!-- Page Content -->
    <?php echo $content ?? ''; ?>

    <!-- Footer -->
    <?php if (!isset($hideTopBar) || !$hideTopBar): ?>
        <footer class="bg-[#2e3132] dark:bg-black w-full pt-20 pb-10">
            <div
                class="grid grid-cols-1 md:grid-cols-4 gap-12 px-8 max-w-7xl mx-auto font-['Be_Vietnam_Pro'] text-base leading-relaxed">
                <!-- Brand -->
                <div class="space-y-6">
                    <div>
                        <img src="/travel.bling/img/travel-bling-logo-cropped.png" alt="Travel Bling"
                            class="h-16 w-auto object-contain" style="mix-blend-mode: screen;" />
                    </div>
                    <p class="text-[#c6c5d4] text-sm">Tự hào là đơn vị lữ hành uy tín hàng đầu, chuyên cung cấp các tour du
                        lịch trong và ngoài nước chất lượng cao.</p>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-10 h-10 rounded-full border border-outline-variant/30 flex items-center justify-center text-white hover:text-[#ff645a] hover:border-[#ff645a] cursor-pointer transition-all">
                            <svg class="w-5 h-5 fill-current" viewbox="0 0 24 24">
                                <path
                                    d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full border border-outline-variant/30 flex items-center justify-center text-white hover:text-[#ff645a] hover:border-[#ff645a] cursor-pointer transition-all">
                            <svg class="w-5 h-5 fill-current" viewbox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Links -->
                <div class="space-y-6">
                    <h4 class="text-white font-bold uppercase tracking-widest text-sm">Khám Phá</h4>
                    <ul class="space-y-4 text-[#c6c5d4]">
                        <li><a class="hover:text-[#ff645a] transition-all duration-300 underline-offset-4 hover:underline"
                                href="index.php?controller=tour">Tours Trong Nước</a></li>
                        <li><a class="hover:text-[#ff645a] transition-all duration-300 underline-offset-4 hover:underline"
                                href="index.php?controller=tour">Tours Quốc Tế</a></li>
                        <li><a class="hover:text-[#ff645a] transition-all duration-300 underline-offset-4 hover:underline"
                                href="index.php?controller=tour&action=mice-delegation&type=doanh-nghiep">Tour Đoàn / MICE</a></li>
                        <li><a class="hover:text-[#ff645a] transition-all duration-300 underline-offset-4 hover:underline"
                                href="#">Khuyến Mãi</a></li>
                    </ul>
                </div>

                <div class="space-y-6">
                    <h4 class="text-white font-bold uppercase tracking-widest text-sm">Công Ty</h4>
                    <ul class="space-y-4 text-[#c6c5d4]">
                        <li><a class="hover:text-[#ff645a] transition-all duration-300 underline-offset-4 hover:underline"
                                href="index.php?controller=home&action=about">Về Chúng Tôi</a></li>
                        <li><a class="hover:text-[#ff645a] transition-all duration-300 underline-offset-4 hover:underline"
                                href="index.php?controller=home&action=terms">Điều khoản dịch vụ</a></li>
                        <li><a class="hover:text-[#ff645a] transition-all duration-300 underline-offset-4 hover:underline"
                                href="index.php?controller=home&action=privacy">Chính sách bảo mật</a></li>
                        <li><a class="hover:text-[#ff645a] transition-all duration-300 underline-offset-4 hover:underline"
                                href="index.php?controller=home&action=contact">Hỗ Trợ</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="space-y-6">
                    <h4 class="text-white font-bold uppercase tracking-widest text-sm">Liên Hệ</h4>
                    <div class="text-[#c6c5d4] space-y-4 text-sm">
                        <p class="flex items-start gap-3"><span
                                class="material-symbols-outlined text-on-primary-container">location_on</span> 268 Lý Thường
                            Kiệt, Phường 14, Quận 10, TP.HCM</p>
                        <p class="flex items-center gap-3"><span
                                class="material-symbols-outlined text-on-primary-container">phone_iphone</span> 0365 690 399
                        </p>
                        <p class="flex items-center gap-3"><span
                                class="material-symbols-outlined text-on-primary-container">alternate_email</span>
                            info@travelbling.com</p>
                    </div>
                </div>
            </div>

            <div
                class="max-w-7xl mx-auto px-8 mt-20 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[#c6c5d4] text-xs">© <?php echo date('Y'); ?> Travel Bling. All rights reserved.</p>
                <div class="flex gap-8 text-[#c6c5d4] text-xs">
                    <span>Giấy phép kinh doanh lữ hành quốc tế số 01-698/2002/TCDL</span>
                </div>
            </div>
        </footer>
    <?php endif; ?>

    <?php echo $scripts ?? ''; ?>

    <script>
        // Auto-hide flash after 4s
        setTimeout(function () {
            const flash = document.querySelector('.fixed.top-20');
            if (flash) {
                flash.style.transition = 'opacity 0.5s ease';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }
        }, 4000);
    </script>
    <?php require_once __DIR__ . '/../chat/widget.php'; ?>
</body>

</html>
