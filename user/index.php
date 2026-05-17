<?php
/**
 * Main Router - Entry Point
 * Travel Bling User Site
 */

// Start session
session_name('travel_bling_user');
session_start();

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load configuration
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/UserModel.php';

if (empty($_SESSION['user_id']) && !empty($_COOKIE['travel_bling_user_remember'])) {
    $userModel = new UserModel();
    $rememberedUser = $userModel->findByRememberToken($_COOKIE['travel_bling_user_remember']);

    if ($rememberedUser) {
        $_SESSION['user_id'] = $rememberedUser['userID'] ?? $rememberedUser['usersID'];
        $_SESSION['user_username'] = $rememberedUser['username'] ?? $rememberedUser['usersname'] ?? '';
        $_SESSION['user_email'] = $rememberedUser['email'] ?? '';
        $_SESSION['user_phone'] = $rememberedUser['phoneNumber'] ?? ($rememberedUser['phone'] ?? '');
    } else {
        setcookie('travel_bling_user_remember', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }
}

// Get controller and action from URL
$controller = isset($_GET['controller']) ? strtolower($_GET['controller']) : 'home';
$action     = isset($_GET['action']) ? $_GET['action'] : null;

// Convert action with dashes to camelCase
if ($action) {
    $action = str_replace('-', '', ucwords($action, '-'));
    $action = lcfirst($action);
}

// Map of valid controllers
$validControllers = [
    'home'    => 'HomeController',
    'auth'    => 'AuthController',
    'tour'    => 'TourController',
    'review'  => 'ReviewController',
    'account' => 'AccountController',
    'service' => 'ServiceController',
    'booking' => 'BookingController',
    'chat'    => 'ChatController',
];

// Default actions per controller
$defaultActions = [
    'home'    => 'index',
    'auth'    => 'showLogin',
    'tour'    => 'index',
    'review'  => 'store',
    'account' => 'index',
    'service' => 'carRental',
    'booking' => 'index',
    'chat'    => 'index',
];

// Validate controller
if (!isset($validControllers[$controller])) {
    $controller = 'home';
}

// Get controller class name
$controllerClass = $validControllers[$controller];
$controllerFile  = __DIR__ . '/controllers/' . $controllerClass . '.php';

if (!file_exists($controllerFile)) {
    die("Controller not found: {$controllerClass}");
}

require_once $controllerFile;

$controllerInstance = new $controllerClass();

// Determine method
if ($controller === 'auth') {
    $authMethodMap = [
        'login'          => 'showLogin',
        'register'       => 'showRegister',
        'logout'         => 'logout',
        'forgotPassword' => 'showForgotPassword',
        'forgot-password'=> 'showForgotPassword',
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $method = $action ?? 'login';
    } else {
        if ($action && isset($authMethodMap[$action])) {
            $method = $authMethodMap[$action];
        } elseif ($action) {
            $method = $action;
        } else {
            $method = 'showLogin';
        }
    }
} else {
    $method = $action ?? $defaultActions[$controller] ?? 'index';
}

// Check if method exists
if (!method_exists($controllerInstance, $method)) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $showMethod = 'show' . ucfirst($method);
        if (method_exists($controllerInstance, $showMethod)) {
            $method = $showMethod;
        } elseif (method_exists($controllerInstance, 'index')) {
            $method = 'index';
        } else {
            die("Action not found: {$method}");
        }
    } else {
        die("Action not found: {$method}");
    }
}

// Call the method
$controllerInstance->$method();
