<?php
/**
 * Main Router - Entry Point
 * Travel Bling Admin Panel
 */

// Start session
session_name('travel_bling_admin');
session_start();

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load configuration
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/AdminModel.php';

if (empty($_SESSION['admin_id']) && !empty($_COOKIE['travel_bling_admin_remember'])) {
    $adminModel = new AdminModel();
    $rememberedAdmin = $adminModel->findByRememberToken($_COOKIE['travel_bling_admin_remember']);

    if ($rememberedAdmin) {
        $_SESSION['admin_id'] = $rememberedAdmin['adminID'];
        $_SESSION['admin_username'] = $rememberedAdmin['usersname'];
        $_SESSION['admin_email'] = $rememberedAdmin['email'];
        $_SESSION['admin_role'] = $rememberedAdmin['role'];
        $_SESSION['admin_avatar'] = $rememberedAdmin['avatar'] ?? null;
    } else {
        setcookie('travel_bling_admin_remember', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }
}

// Get controller and action from URL
$controller = isset($_GET['controller']) ? strtolower($_GET['controller']) : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : null;

// Convert action with dashes to camelCase
if ($action) {
    $action = str_replace('-', '', ucwords($action, '-'));
    $action = lcfirst($action);
}

// Map of valid controllers
$validControllers = [
    'auth' => 'AuthController',
    'dashboard' => 'DashboardController',
    'thongke' => 'ThongkeController',
    'tour' => 'TourController',
    'booking' => 'BookingController',
    'user' => 'UserController',
    'image' => 'ImageController',
    'bill' => 'BillController',
    'checkout' => 'CheckoutController',
    'promotion' => 'PromotionController',
    'review' => 'ReviewController',
    'chat' => 'ChatController',
    'history' => 'HistoryController',
];

// Default actions per controller
$defaultActions = [
    'auth' => 'showLogin',
    'dashboard' => 'index',
    'thongke' => 'index',
    'tour' => 'index',
    'booking' => 'index',
    'user' => 'index',
    'image' => 'index',
    'bill' => 'index',
    'checkout' => 'index',
    'promotion' => 'index',
    'review' => 'index',
    'chat' => 'index',
    'history' => 'index',
];

// Check if controller is valid
if (!isset($validControllers[$controller])) {
    $controller = 'auth';
}

// Get controller class name
$controllerClass = $validControllers[$controller];
$controllerFile = __DIR__ . '/controllers/' . $controllerClass . '.php';

// Check if controller file exists
if (!file_exists($controllerFile)) {
    die("Controller not found: {$controllerClass}");
}

// Include controller
require_once $controllerFile;

// Create controller instance
$controllerInstance = new $controllerClass();

// Determine method to call based on controller type and request method
if ($controller === 'auth') {
    // Auth controller action mapping
    $authMethodMap = [
        'login' => 'showLogin',
        'register' => 'showRegister',
        'forgotPassword' => 'showForgotPassword',
        'resetPassword' => 'showResetPassword',
        'profile' => 'showProfile',
        'logout' => 'logout',
    ];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // For POST - call the action directly
        $method = $action ?? 'login';
    } else {
        // For GET - map to show methods
        if ($action && isset($authMethodMap[$action])) {
            $method = $authMethodMap[$action];
        } elseif ($action) {
            $method = $action;
        } else {
            $method = 'showLogin';
        }
    }
} else {
    // Other controllers - use action directly or default
    $method = $action ?? $defaultActions[$controller] ?? 'index';
}

// Check if method exists
if (!method_exists($controllerInstance, $method)) {
    // Try with 'show' prefix for GET requests
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $showMethod = 'show' . ucfirst($method);
        if (method_exists($controllerInstance, $showMethod)) {
            $method = $showMethod;
        } else {
            // Try 'index' as fallback
            if (method_exists($controllerInstance, 'index')) {
                $method = 'index';
            } else {
                die("Action not found: {$method}");
            }
        }
    } else {
        die("Action not found: {$method}");
    }
}

// Call the method
$controllerInstance->$method();

