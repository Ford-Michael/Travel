<?php
/**
 * Base Controller Class
 * Provides common controller functionality for the user-facing site
 */

require_once __DIR__ . '/../config/database.php';

class Controller {

    /**
     * Render a view file, optionally inside a layout.
     * Pass 'layout' => 'layouts/about' in $data to use a custom layout.
     * Default layout: 'layouts/main'
     */
    protected function view($view, $data = []) {
        // Extract layout key (default = layouts/main)
        $layout = $data['layout'] ?? 'layouts/main';
        unset($data['layout']);

        extract($data);

        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        if (!file_exists($viewPath)) {
            die("View not found: {$view}");
        }

        // Capture the inner view into $content
        ob_start();
        require $viewPath;
        $content = ob_get_clean();

        // Render the layout with $content available
        $layoutPath = __DIR__ . '/../views/' . $layout . '.php';
        if (file_exists($layoutPath)) {
            require $layoutPath;
        } else {
            // Fallback: output content directly if no layout found
            echo $content;
        }
    }

    /**
     * Redirect to a URL
     */
    protected function redirect($url) {
        if (strpos($url, 'http') === 0) {
            header("Location: " . $url);
        } else {
            header("Location: " . BASE_URL . '/' . ltrim($url, '/'));
        }
        exit;
    }

    /**
     * Redirect to any URL
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
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Get POST data
     */
    protected function post($key = null, $default = null) {
        if ($key === null) {
            return $_POST;
        }
        return isset($_POST[$key]) ? trim($_POST[$key]) : $default;
    }

    /**
     * Get GET data
     */
    protected function get($key = null, $default = null) {
        if ($key === null) {
            return $_GET;
        }
        return isset($_GET[$key]) ? trim($_GET[$key]) : $default;
    }

    /**
     * Check if request is POST
     */
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Set flash message
     */
    protected function setFlash($type, $message) {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
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
        return isset($_SESSION['user_id']);
    }

    /**
     * Require authentication
     */
    protected function requireAuth() {
        if (!$this->isLoggedIn()) {
            $this->setFlash('warning', 'Vui lòng đăng nhập để tiếp tục.');
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

    /**
     * Get current logged in user
     */
    protected function getCurrentUser() {
        if ($this->isLoggedIn()) {
            return [
                'id'       => $_SESSION['user_id'],
                'username' => $_SESSION['user_username'],
                'email'    => $_SESSION['user_email'],
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
     * Validate email
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
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token ?? '');
    }
}
