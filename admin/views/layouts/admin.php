<?php
/**
 * Admin Layout Template
 * Shared layout with sidebar navigation for all admin pages
 *
 * Variables expected:
 * - $title: Page title
 * - $admin: Current admin user data
 * - $content: Page content (use ob_start/ob_get_clean in views)
 * - $flash: Flash messages (optional)
 * - $activeMenu: Current active menu item (optional)
 */

$currentController = isset($_GET['controller']) ? $_GET['controller'] : 'dashboard';

// Check if user is logged in, redirect to login if not (except for auth controller)
if ($currentController !== 'auth' && (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id']))) {
    header('Location: index.php?controller=auth&action=login');
    exit;
}

// Ensure $admin is defined and is an array
if (!isset($admin) || !is_array($admin)) {
    $admin = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'Admin Panel'); ?> - Travel Bling</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    <style>
        .sidebar-brand-text { font-size: 1rem; }
        .sidebar .sidebar-brand {
            height: auto;
            min-height: 86px;
            padding: 1rem 0.75rem;
        }
        .sidebar .sidebar-brand .sidebar-brand-icon {
            width: 72px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .sidebar .sidebar-brand .sidebar-brand-logo {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 0;
            background: transparent;
            padding: 0;
            display: block;
        }
        .sidebar .sidebar-brand .sidebar-brand-text {
            margin-left: 0.75rem !important;
            line-height: 1.15;
            text-align: left;
            white-space: normal;
        }
        .nav-item .nav-link { padding: 0.75rem 1rem; }
        .nav-item .nav-link i { width: 1.5rem; }
        .card-stats { border-left: 4px solid; }
        .card-stats.primary { border-left-color: #4e73df; }
        .card-stats.success { border-left-color: #1cc88a; }
        .card-stats.warning { border-left-color: #f6c23e; }
        .card-stats.danger { border-left-color: #e74a3b; }
        .card-stats.info { border-left-color: #36b9cc; }
        .badge-status { font-size: 0.75rem; padding: 0.35em 0.65em; }
        .table-actions .btn { padding: 0.25rem 0.5rem; font-size: 0.75rem; }
        .search-box { max-width: 300px; }
        .sidebar .nav-item.active .nav-link { font-weight: 700; }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?controller=dashboard">
                <div class="sidebar-brand-icon">
                    <img src="../img/travel-bling-logo-cropped.png"
                         alt="Travel Bling"
                         class="sidebar-brand-logo">
                </div>
                <div class="sidebar-brand-text mx-3">Travel Bling</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item <?php echo $currentController === 'dashboard' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=dashboard">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item <?php echo $currentController === 'thongke' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=thongke">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Thong Ke</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Tours & Bookings</div>

            <li class="nav-item <?php echo $currentController === 'tour' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=tour">
                    <i class="fas fa-fw fa-map-marked-alt"></i>
                    <span>Tours</span>
                </a>
            </li>

            <li class="nav-item <?php echo $currentController === 'booking' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=booking">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Bookings</span>
                </a>
            </li>

            <li class="nav-item <?php echo $currentController === 'image' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=image">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Images</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Finance</div>

            <li class="nav-item <?php echo $currentController === 'bill' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=bill">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Bills</span>
                </a>
            </li>

            <li class="nav-item <?php echo $currentController === 'checkout' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=checkout">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>Payments</span>
                </a>
            </li>

            <li class="nav-item <?php echo $currentController === 'promotion' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=promotion">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Promotions</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Users & Support</div>

            <li class="nav-item <?php echo $currentController === 'user' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=user">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item <?php echo $currentController === 'review' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=review">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Reviews</span>
                </a>
            </li>

            <li class="nav-item <?php echo $currentController === 'chat' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=chat">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Support Chat</span>
                    <?php if (isset($unreadChats) && $unreadChats > 0): ?>
                    <span class="badge badge-danger badge-counter"><?php echo $unreadChats; ?></span>
                    <?php endif; ?>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">System</div>

            <li class="nav-item <?php echo ($currentController === 'auth' && isset($_GET['action']) && $_GET['action'] === 'profile') ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?controller=auth&action=profile">
                    <i class="fas fa-fw fa-user-circle"></i>
                    <span>Ho so</span>
                </a>
            </li>

            <li class="nav-item <?php echo $currentController === 'history' ? 'active' : ''; ?>">
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

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

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
                                <a class="dropdown-item" href="index.php?controller=dashboard">
                                    <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Dashboard
                                </a>
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

                <div class="container-fluid">
                    <?php if (isset($flash) && $flash): ?>
                    <div class="alert alert-<?php echo htmlspecialchars($flash['type']); ?> alert-dismissible fade show" role="alert">
                        <?php echo $flash['message']; ?>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php echo $content ?? ''; ?>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Travel Bling Admin &copy; <?php echo date('Y'); ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>

    <script>
        $(document).ready(function() {
            if ($('.datatable').length) {
                $('.datatable').DataTable({
                    "pageLength": 25,
                    "ordering": true,
                    "info": true,
                    "language": {
                        "search": "Search:",
                        "lengthMenu": "Show _MENU_ entries",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries"
                    }
                });
            }
        });

        function confirmDelete(url, itemName) {
            if (confirm('Are you sure you want to delete this ' + (itemName || 'item') + '?')) {
                window.location.href = url;
            }
            return false;
        }
    </script>

    <?php echo $scripts ?? ''; ?>
</body>
</html>
