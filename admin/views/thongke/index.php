<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Thống Kê - Travel Bling Admin'; ?></title>
    
    <!-- Google Fonts - Nunito -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=dashboard">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item active">
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
                <div class="container-fluid">
                    <!-- Banner Image -->
                    <div class="card shadow mb-4" style="border-radius: 15px; overflow: hidden; border: none;">
                        <div style="position: relative; height: 180px; background: url('../img/pexels-fotoaibe-1643383.jpg') center/cover no-repeat;">
                            <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(78,115,223,0.85), rgba(28,200,138,0.75));"></div>
                            <div style="position: relative; z-index: 1; height: 100%; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;">
                                <div>
                                    <h1 class="h3 mb-1 text-white font-weight-bold"><i class="fas fa-chart-bar mr-2"></i>Thống Kê</h1>
                                    <p class="text-white-50 mb-0">Tổng quan dữ liệu và phân tích hệ thống</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="index.php?controller=thongke&action=exportExcel" class="btn btn-light btn-sm shadow-sm mr-2">
                                        <i class="fas fa-file-excel fa-sm mr-1"></i> Export Excel
                                    </a>
                                    <a href="index.php?controller=thongke&action=exportPdf" class="btn btn-light btn-sm shadow-sm" target="_blank">
                                        <i class="fas fa-file-pdf fa-sm mr-1"></i> Export PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- System Status -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card shadow border-left-warning h-100 py-2">
                                <div class="card-body">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Trạng Thái Hệ Thống
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6 text-center">
                                            <div class="h4 text-success">
                                                <i class="fas fa-check-circle"></i> Online
                                            </div>
                                            <small class="text-gray-500">Database</small>
                                        </div>
                                        <div class="col-6 text-center">
                                            <div class="h4 text-success">
                                                <i class="fas fa-server"></i> Active
                                            </div>
                                            <small class="text-gray-500">Server</small>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <small class="text-muted">
                                            <i class="fas fa-clock mr-1"></i>
                                            Cập nhật lần cuối: <?php echo date('H:i:s'); ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Flash Messages -->
                    <?php if (isset($flash) && $flash): ?>
                    <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show" role="alert">
                        <?php echo $flash['message']; ?>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Statistics Cards Row -->
                    <div class="row">
                        <!-- Total Users Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tổng Người Dùng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($totalUsers ?? 0); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Active Users Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Người Dùng Hoạt Động</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($activeUsers ?? 0); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Checkouts Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Tổng Thanh Toán</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($totalCheckouts ?? 0); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Revenue Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Doanh Thu</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($totalRevenue ?? 0, 0, ',', '.'); ?> VNĐ
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row">
                        <!-- User Chart (Column Chart) -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-users mr-2"></i>Thống Kê Người Dùng (6 Tháng)
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area" style="height: 320px;">
                                        <canvas id="userChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Checkout Chart (Bar Chart) -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">
                                        <i class="fas fa-credit-card mr-2"></i>Thống Kê Thanh Toán (6 Tháng)
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area" style="height: 320px;">
                                        <canvas id="checkoutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Charts Row -->
                    <div class="row">
                        <!-- User Status Pie Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-chart-pie mr-2"></i>Tỷ Lệ Trạng Thái Người Dùng
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2" style="height: 280px;">
                                        <canvas id="userStatusPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-3">
                                            <i class="fas fa-circle text-success"></i> Hoạt Động
                                        </span>
                                        <span class="mr-3">
                                            <i class="fas fa-circle text-danger"></i> Không Hoạt Động
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Status Pie Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">
                                        <i class="fas fa-chart-pie mr-2"></i>Tỷ Lệ Trạng Thái Thanh Toán
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2" style="height: 280px;">
                                        <canvas id="paymentStatusPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-3">
                                            <i class="fas fa-circle text-success"></i> Hoàn Thành
                                        </span>
                                        <span class="mr-3">
                                            <i class="fas fa-circle text-warning"></i> Đang Chờ
                                        </span>
                                        <span class="mr-3">
                                            <i class="fas fa-circle text-danger"></i> Thất Bại
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Status Row -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Hoàn Thành</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($completedPayments ?? 0); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Đang Chờ</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($pendingPayments ?? 0); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Thất Bại</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo number_format($failedPayments ?? 0); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                                        </div>
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
                    <div class="copyright text-center my-auto">
                        <span>Travel Bling Admin &copy; <?php echo date('Y'); ?></span>
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
    
    <!-- Charts JavaScript -->
    <script>
        // User Chart Data from PHP
        const userLabels = <?php echo json_encode($userMonthlyData['labels'] ?? []); ?>;
        const userData = <?php echo json_encode($userMonthlyData['data'] ?? []); ?>;
        
        // Checkout Chart Data from PHP
        const checkoutLabels = <?php echo json_encode($checkoutMonthlyData['labels'] ?? []); ?>;
        const checkoutAmounts = <?php echo json_encode($checkoutMonthlyData['amounts'] ?? []); ?>;
        const checkoutCounts = <?php echo json_encode($checkoutMonthlyData['counts'] ?? []); ?>;
        
        // User Column Chart
        const userCtx = document.getElementById('userChart').getContext('2d');
        new Chart(userCtx, {
            type: 'bar',
            data: {
                labels: userLabels,
                datasets: [{
                    label: 'Người dùng đăng ký',
                    data: userData,
                    backgroundColor: 'rgba(78, 115, 223, 0.8)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        },
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // Checkout Bar Chart (Horizontal)
        const checkoutCtx = document.getElementById('checkoutChart').getContext('2d');
        new Chart(checkoutCtx, {
            type: 'bar',
            data: {
                labels: checkoutLabels,
                datasets: [
                    {
                        label: 'Số giao dịch',
                        data: checkoutCounts,
                        backgroundColor: 'rgba(28, 200, 138, 0.8)',
                        borderColor: 'rgba(28, 200, 138, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                        barThickness: 20
                    },
                    {
                        label: 'Doanh thu (triệu VNĐ)',
                        data: checkoutAmounts.map(a => a / 1000000),
                        backgroundColor: 'rgba(246, 194, 62, 0.8)',
                        borderColor: 'rgba(246, 194, 62, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                        barThickness: 20
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // User Status Data from PHP
        const activeUsersCount = <?php echo $activeUsers ?? 0; ?>;
        const inactiveUsersCount = <?php echo $inactiveUsers ?? 0; ?>;
        
        // Payment Status Data from PHP
        const completedCount = <?php echo $completedPayments ?? 0; ?>;
        const pendingCount = <?php echo $pendingPayments ?? 0; ?>;
        const failedCount = <?php echo $failedPayments ?? 0; ?>;
        
        // User Status Pie Chart
        const userPieCtx = document.getElementById('userStatusPieChart').getContext('2d');
        new Chart(userPieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Hoạt Động', 'Không Hoạt Động'],
                datasets: [{
                    data: [activeUsersCount, inactiveUsersCount],
                    backgroundColor: [
                        'rgba(28, 200, 138, 0.9)',
                        'rgba(231, 74, 59, 0.9)'
                    ],
                    borderColor: [
                        'rgba(28, 200, 138, 1)',
                        'rgba(231, 74, 59, 1)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.raw / total) * 100).toFixed(1) : 0;
                                return context.label + ': ' + context.raw + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
        
        // Payment Status Pie Chart
        const paymentPieCtx = document.getElementById('paymentStatusPieChart').getContext('2d');
        new Chart(paymentPieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Hoàn Thành', 'Đang Chờ', 'Thất Bại'],
                datasets: [{
                    data: [completedCount, pendingCount, failedCount],
                    backgroundColor: [
                        'rgba(28, 200, 138, 0.9)',
                        'rgba(246, 194, 62, 0.9)',
                        'rgba(231, 74, 59, 0.9)'
                    ],
                    borderColor: [
                        'rgba(28, 200, 138, 1)',
                        'rgba(246, 194, 62, 1)',
                        'rgba(231, 74, 59, 1)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.raw / total) * 100).toFixed(1) : 0;
                                return context.label + ': ' + context.raw + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
