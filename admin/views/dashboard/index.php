<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Dashboard - Travel Bling Admin'; ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Lunar New Year Theme Styles -->
    <style>
        :root {
            --tet-red: #C41E3A;
            --tet-gold: #FFD700;
            --tet-dark-red: #8B0000;
            --tet-light-gold: #FFF8DC;
            --tet-pink: #FFB7C5;
        }
        
        /* Festive Background */
        #content-wrapper {
            background: linear-gradient(135deg, #FFF8DC 0%, #FFEBEE 50%, #FFF8DC 100%);
            position: relative;
            overflow: hidden;
        }
        
        /* Floating Lanterns Animation */
        .lantern {
            position: fixed;
            font-size: 2rem;
            animation: float 6s ease-in-out infinite;
            opacity: 0.7;
            z-index: 0;
            pointer-events: none;
        }
        
        .lantern:nth-child(1) { left: 5%; top: 15%; animation-delay: 0s; }
        .lantern:nth-child(2) { left: 15%; top: 60%; animation-delay: 1s; }
        .lantern:nth-child(3) { right: 10%; top: 20%; animation-delay: 2s; }
        .lantern:nth-child(4) { right: 20%; top: 70%; animation-delay: 3s; }
        .lantern:nth-child(5) { left: 40%; top: 80%; animation-delay: 4s; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        /* Cherry Blossom Petals */
        .petal {
            position: fixed;
            width: 15px;
            height: 15px;
            background: var(--tet-pink);
            border-radius: 50% 0 50% 50%;
            opacity: 0.6;
            animation: fall linear infinite;
            z-index: 0;
            pointer-events: none;
        }
        
        @keyframes fall {
            0% { transform: translateY(-100px) rotate(0deg); opacity: 0; }
            10% { opacity: 0.6; }
            90% { opacity: 0.6; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }
        
        /* Welcome Banner */
        .tet-banner {
            background: linear-gradient(135deg, var(--tet-red) 0%, var(--tet-dark-red) 100%);
            border-radius: 20px;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(196, 30, 58, 0.3);
            margin-bottom: 2rem;
            z-index: 1;
        }
        
        .tet-banner::before {
            content: '🧧';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 5rem;
            opacity: 0.3;
        }
        
        .tet-banner h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .tet-banner .greeting {
            font-size: 1.2rem;
            color: var(--tet-gold);
            font-weight: 600;
        }
        
        .tet-banner .zodiac {
            display: inline-block;
            background: var(--tet-gold);
            color: var(--tet-dark-red);
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            margin-top: 0.5rem;
        }
        
        /* Festive Cards */
        .tet-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            z-index: 1;
        }
        
        .tet-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .tet-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--tet-red), var(--tet-gold));
        }
        
        .tet-card .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .tet-card .card-icon.users {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .tet-card .card-icon.revenue {
            background: linear-gradient(135deg, var(--tet-gold) 0%, #FFA500 100%);
            color: var(--tet-dark-red);
        }
        
        .tet-card .card-icon.bookings {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }
        
        .tet-card .card-icon.pending {
            background: linear-gradient(135deg, var(--tet-red) 0%, #FF6B6B 100%);
            color: white;
        }
        
        .tet-card .card-value {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 0.3rem;
        }
        
        .tet-card .card-label {
            color: #636e72;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Quick Actions */
        .quick-action {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            z-index: 1;
            position: relative;
        }
        
        .quick-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(196, 30, 58, 0.2);
            text-decoration: none;
            color: inherit;
        }
        
        .quick-action i {
            font-size: 2rem;
            color: var(--tet-red);
            margin-bottom: 0.8rem;
            display: block;
        }
        
        .quick-action span {
            font-weight: 600;
            color: #2d3436;
        }
        
        /* Fireworks Animation */
        .firework {
            position: fixed;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            animation: explode 1.5s ease-out infinite;
            z-index: 0;
            pointer-events: none;
        }
        
        @keyframes explode {
            0% { transform: scale(0); opacity: 1; box-shadow: 0 0 0 0 var(--tet-gold); }
            50% { transform: scale(1); opacity: 0.8; box-shadow: 0 0 20px 10px var(--tet-red); }
            100% { transform: scale(1.5); opacity: 0; box-shadow: 0 0 40px 20px transparent; }
        }
        
        /* Sidebar Lunar Theme Accent */
        .sidebar .nav-item.active .nav-link {
            background: linear-gradient(135deg, var(--tet-red) 0%, var(--tet-dark-red) 100%) !important;
        }
        
        /* Footer */
        .tet-footer {
            text-align: center;
            padding: 1rem;
            color: var(--tet-red);
            font-weight: 600;
            z-index: 1;
            position: relative;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?controller=dashboard">
                <div class="sidebar-brand-icon">
                    <img src="../img/travel-bling-logo-cropped.png"
                         alt="Travel Bling"
                         style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; background: white; padding: 3px;">
                </div>
                <div class="sidebar-brand-text mx-3">Travel Bling</div>
            </a>
            
            <hr class="sidebar-divider my-0">
            
            <li class="nav-item active">
                <a class="nav-link" href="index.php?controller=dashboard">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=thongke">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Thống Kê</span>
                </a>
            </li>
            
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Tours & Bookings</div>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=tour">
                    <i class="fas fa-fw fa-map-marked-alt"></i>
                    <span>Tours</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=booking">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Bookings</span>
                </a>
            </li>
            
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Finance</div>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=bill">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Bills</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=checkout">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>Payments</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=promotion">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Promotions</span>
                </a>
            </li>
            
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Users & Support</div>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=user">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=review">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Reviews</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=chat">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Support Chat</span>
                </a>
            </li>
            
            <hr class="sidebar-divider">
            <div class="sidebar-heading">System</div>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=history">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Activity Log</span>
                </a>
            </li>
            
            <hr class="sidebar-divider d-none d-md-block">
            
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Floating Decorations -->
            <div class="lantern">🏮</div>
            <div class="lantern">🏮</div>
            <div class="lantern">🏮</div>
            <div class="lantern">🏮</div>
            <div class="lantern">🏮</div>
            
            <!-- Cherry Blossom Petals (generated via JS) -->
            
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo htmlspecialchars($admin['username'] ?? 'Admin'); ?>
                                </span>
                                <?php
                                    $topbarAvatar = (!empty($admin['avatar']))
                                        ? '../img/avatars/' . htmlspecialchars($admin['avatar'])
                                        : 'assets/img/undraw_profile.svg';
                                ?>
                                <img class="img-profile rounded-circle" src="<?php echo $topbarAvatar; ?>" style="object-fit: cover;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="index.php?controller=auth&action=profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ho so
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.php?controller=auth&action=logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                
                <!-- Page Content -->
                <div class="container-fluid" style="position: relative; z-index: 1;">
                    <!-- Flash Messages -->
                    <?php if (isset($flash) && $flash): ?>
                    <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show" role="alert">
                        <?php echo $flash['message']; ?>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Lunar New Year Welcome Banner -->
                    <div class="tet-banner" style="background: linear-gradient(135deg, rgba(196,30,58,0.9), rgba(139,0,0,0.85)), url('../img/pexels-fotoaibe-1571470.jpg') center/cover no-repeat;">
                        <h1>🎊 Chúc Mừng Năm Mới <?php echo $currentYear ?? date('Y'); ?>! 🎊</h1>
                        <p class="greeting">Chào mừng đến với Travel Bling Admin Panel</p>
                        <span class="zodiac">🐍 Năm <?php echo $lunarAnimal ?? 'Tỵ (Rắn)'; ?></span>
                        <p class="mt-3 mb-0" style="opacity: 0.9;">
                            <i class="fas fa-user-circle mr-2"></i>
                            Xin chào, <strong><?php echo htmlspecialchars($admin['username'] ?? 'Admin'); ?></strong>! 
                            Chúc bạn một năm mới an khang thịnh vượng!
                        </p>
                    </div>
                    
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="tet-card">
                                <div class="card-icon users">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-value"><?php echo number_format($totalUsers ?? 0); ?></div>
                                <div class="card-label">Tổng Người Dùng</div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="tet-card">
                                <div class="card-icon revenue">
                                    <i class="fas fa-coins"></i>
                                </div>
                                <div class="card-value"><?php echo number_format($totalRevenue ?? 0, 0, ',', '.'); ?></div>
                                <div class="card-label">Doanh Thu (VNĐ)</div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="tet-card">
                                <div class="card-icon bookings">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <div class="card-value"><?php echo number_format($totalCheckouts ?? 0); ?></div>
                                <div class="card-label">Tổng Đơn Hàng</div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="tet-card">
                                <div class="card-icon pending">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="card-value"><?php echo number_format($pendingPayments ?? 0); ?></div>
                                <div class="card-label">Đang Chờ Xử Lý</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card shadow border-left-success h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Hành Động Nhanh
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6 col-md-3 mb-2">
                                            <a href="index.php?controller=tour&action=add" class="btn btn-sm btn-outline-primary btn-block">
                                                <i class="fas fa-plus mr-1"></i> Thêm Tour
                                            </a>
                                        </div>
                                        <div class="col-6 col-md-3 mb-2">
                                            <a href="index.php?controller=image&action=add" class="btn btn-sm btn-outline-info btn-block">
                                                <i class="fas fa-image mr-1"></i> Thêm Hình
                                            </a>
                                        </div>
                                        <div class="col-6 col-md-3 mb-2">
                                            <a href="index.php?controller=booking" class="btn btn-sm btn-outline-warning btn-block">
                                                <i class="fas fa-calendar mr-1"></i> Đặt Tour
                                            </a>
                                        </div>
                                        <div class="col-6 col-md-3 mb-2">
                                            <a href="index.php?controller=user" class="btn btn-sm btn-outline-secondary btn-block">
                                                <i class="fas fa-users mr-1"></i> Users
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Content -->
                    <h5 class="mb-3" style="color: var(--tet-dark-red);">
                        <i class="fas fa-bolt mr-2"></i>Truy Cập Nhanh
                    </h5>
                    <div class="row mb-4">
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="index.php?controller=thongke" class="quick-action">
                                <i class="fas fa-chart-pie"></i>
                                <span>Thống Kê</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="index.php?controller=tour" class="quick-action">
                                <i class="fas fa-map-marked-alt"></i>
                                <span>Tours</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="index.php?controller=booking" class="quick-action">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Bookings</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="index.php?controller=user" class="quick-action">
                                <i class="fas fa-user-friends"></i>
                                <span>Users</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="index.php?controller=checkout" class="quick-action">
                                <i class="fas fa-money-check-alt"></i>
                                <span>Payments</span>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="index.php?controller=promotion" class="quick-action">
                                <i class="fas fa-gift"></i>
                                <span>Khuyến Mãi</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Tết Greeting Card -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow" style="border-radius: 15px; overflow: hidden; border: none;">
                                <div class="card-body text-center py-5" style="background: linear-gradient(135deg, #FFF8DC 0%, #FFE4E1 100%);">
                                    <div style="font-size: 4rem; margin-bottom: 1rem;">🧧🎆🏮</div>
                                    <h3 style="color: var(--tet-red); font-weight: 700;">
                                        Xuân Về Tết Đến, Vạn Sự Như Ý
                                    </h3>
                                    <p style="color: #666; max-width: 600px; margin: 1rem auto;">
                                        Năm mới tràn đầy niềm vui và thành công!<br>
                                        Chúc đội ngũ Travel Bling và quý khách một năm mới thật nhiều may mắn!
                                    </p>
                                    <div style="font-size: 2rem;">
                                        🌸 🎋 🍊 🎐 🌸
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="tet-footer">
                        <span>🏮 Travel Bling Admin &copy; <?php echo date('Y'); ?> - Chúc Mừng Năm Mới! 🏮</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SB Admin 2 -->
    <script src="assets/js/sb-admin-2.min.js"></script>
    
    <!-- Cherry Blossom Petals Generator -->
    <script>
        // Create falling cherry blossom petals
        function createPetals() {
            const container = document.getElementById('content-wrapper');
            for (let i = 0; i < 15; i++) {
                const petal = document.createElement('div');
                petal.className = 'petal';
                petal.style.left = Math.random() * 100 + '%';
                petal.style.animationDuration = (Math.random() * 5 + 8) + 's';
                petal.style.animationDelay = Math.random() * 10 + 's';
                container.appendChild(petal);
            }
        }
        
        // Create fireworks
        function createFireworks() {
            const container = document.getElementById('content-wrapper');
            setInterval(() => {
                const firework = document.createElement('div');
                firework.className = 'firework';
                firework.style.left = Math.random() * 80 + 10 + '%';
                firework.style.top = Math.random() * 40 + 10 + '%';
                firework.style.background = ['#FFD700', '#C41E3A', '#FF6B6B'][Math.floor(Math.random() * 3)];
                container.appendChild(firework);
                
                setTimeout(() => firework.remove(), 1500);
            }, 2000);
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            createPetals();
            createFireworks();
        });
    </script>
</body>
</html>
