<?php
/**
 * Base Controller Class
 * Provides common controller functionality
 */

require_once __DIR__ . '/../config/database.php';

class Controller {
    
    /**
     * Render a view file
     */
    protected function view($view, $data = []) {
        // Extract data to make variables available in view
        extract($data);
        
        // Build the view path
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View not found: {$view}");
        }
    }

    /**
     * Redirect to a URL
     */
    protected function redirect($url) {
        // If URL starts with http, use as-is, otherwise prepend BASE_URL
        if (strpos($url, 'http') === 0) {
            header("Location: " . $url);
        } else {
            header("Location: " . BASE_URL . '/' . ltrim($url, '/'));
        }
        exit;
    }

    /**
     * Redirect to external URL
     */
    protected function redirectTo($url) {
        header("Location: " . $url);
        exit;
    }

    /**
     * Return JSON response
     */
    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    /**
     * Get POST data
     */
    protected function post($key = null, $default = null) {
        if ($key === null) {
            return $_POST;
        }
        if (!isset($_POST[$key])) {
            return $default;
        }

        return $this->normalizeInputValue($_POST[$key]);
    }

    /**
     * Get GET data
     */
    protected function get($key = null, $default = null) {
        if ($key === null) {
            return $_GET;
        }
        if (!isset($_GET[$key])) {
            return $default;
        }

        return $this->normalizeInputValue($_GET[$key]);
    }

    /**
     * Normalize scalar and array request input values.
     */
    protected function normalizeInputValue($value) {
        if (is_array($value)) {
            return array_map([$this, 'normalizeInputValue'], $value);
        }

        return trim((string) $value);
    }

    /**
     * Check if request is POST
     */
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Set flash message in session
     */
    protected function setFlash($type, $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    /**
     * Get and clear flash message
     */
    protected function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    /**
     * Check if user is logged in
     */
    protected function isLoggedIn() {
        return isset($_SESSION['admin_id']);
    }

    /**
     * Require authentication
     */
    protected function requireAuth() {
        if (!$this->isLoggedIn()) {
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

    /**
     * Get current logged in admin
     */
    protected function getCurrentAdmin() {
        if ($this->isLoggedIn()) {
            return [
                'id' => $_SESSION['admin_id'],
                'username' => $_SESSION['admin_username'],
                'email' => $_SESSION['admin_email'],
                'role' => $_SESSION['admin_role'],
                'avatar' => $_SESSION['admin_avatar'] ?? null
            ];
        }
        return null;
    }

    /**
     * Sanitize input
     */
    protected function sanitize($input) {
        return htmlspecialchars(strip_tags(trim($input ?? '')), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Validate email format
     */
    protected function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Generate CSRF token
     */
    protected function generateCsrfToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Verify CSRF token
     */
    protected function verifyCsrfToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
