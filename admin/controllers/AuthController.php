<?php
/**
 * Authentication Controller
 * Handles login, register, forgot password, and logout
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/AdminModel.php';
require_once __DIR__ . '/../models/HistoryModel.php';
require_once __DIR__ . '/../helpers/Mailer.php';

// Load Google OAuth config if exists
$googleConfigPath = __DIR__ . '/../config/google.php';
if (file_exists($googleConfigPath)) {
    require_once $googleConfigPath;
}

class AuthController extends Controller {
    private $adminModel;
    private $historyModel;
    private $mailer;
    private $rememberCookieName = 'travel_bling_admin_remember';

    public function __construct() {
        $this->adminModel = new AdminModel();
        $this->historyModel = new HistoryModel();
        $this->mailer = new Mailer();
    }

    /**
     * Display login form
     */
    public function showLogin() {
        // Redirect if already logged in
        if ($this->isLoggedIn()) {
            $this->redirect('index.php?controller=dashboard');
        }

        $data = [
            'title' => 'Login - Travel Bling Admin',
            'csrf_token' => $this->generateCsrfToken(),
            'flash' => $this->getFlash()
        ];

        $this->view('auth/login', $data);
    }

    /**
     * Process login
     */
    public function login() {
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=auth&action=login');
        }

        // Verify CSRF
        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Invalid request. Please try again.');
            $this->redirect('index.php?controller=auth&action=login');
        }

        $usernameOrEmail = $this->sanitize($this->post('email'));
        $password = $this->post('password');
        $remember = $this->post('remember');

        // Validate input
        if (empty($usernameOrEmail) || empty($password)) {
            $this->setFlash('danger', 'Please fill in all fields.');
            $this->redirect('index.php?controller=auth&action=login');
        }

        // Attempt login
        $result = $this->adminModel->login($usernameOrEmail, $password);

        if ($result['success']) {
            $this->setAdminSession($result['admin']);

            // Set remember me cookie
            if ($remember) {
                $token = $this->adminModel->createRememberToken((int) $result['admin']['adminID'], 30);
                $this->setRememberCookie($token);
            } else {
                $this->clearRememberCookie();
                $this->adminModel->clearRememberTokensByAdmin((int) $result['admin']['adminID']);
            }

            $this->historyModel->logAdminLogin(
                (int) $result['admin']['adminID'],
                $this->getClientIpAddress(),
                substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255)
            );

            $this->setFlash('success', 'Welcome back, ' . $result['admin']['usersname'] . '!');
            $this->redirect('index.php?controller=dashboard');
        } else {
            $this->setFlash('danger', $result['message']);
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

    /**
     * Display register form
     */
    public function showRegister() {
        if ($this->isLoggedIn()) {
            $this->redirect('index.php?controller=dashboard');
        }

        $data = [
            'title' => 'Create Account - Travel Bling Admin',
            'csrf_token' => $this->generateCsrfToken(),
            'flash' => $this->getFlash()
        ];

        $this->view('auth/register', $data);
    }

    /**
     * Process registration
     */
    public function register() {
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=auth&action=register');
        }

        // Verify CSRF
        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Invalid request. Please try again.');
            $this->redirect('index.php?controller=auth&action=register');
        }

        $username = $this->sanitize($this->post('username'));
        $email = $this->sanitize($this->post('email'));
        $password = $this->post('password');
        $confirmPassword = $this->post('confirm_password');

        // Validate input
        $errors = [];

        if (empty($username)) {
            $errors[] = 'Username is required';
        } elseif (strlen($username) < 3) {
            $errors[] = 'Username must be at least 3 characters';
        }

        if (empty($email)) {
            $errors[] = 'Email is required';
        } elseif (!$this->validateEmail($email)) {
            $errors[] = 'Invalid email format';
        } elseif ($this->adminModel->emailExists($email)) {
            $errors[] = 'Email already registered';
        }

        if (empty($password)) {
            $errors[] = 'Password is required';
        } elseif (strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters';
        }

        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match';
        }

        if ($this->adminModel->usernameExists($username)) {
            $errors[] = 'Username already taken';
        }

        if (!empty($errors)) {
            $this->setFlash('danger', implode('<br>', $errors));
            $this->redirect('index.php?controller=auth&action=register');
        }

        // Create admin
        $adminId = $this->adminModel->createAdmin([
            'usersname' => $username,
            'email' => $email,
            'password' => $password,
            'role' => 'moderator'
        ]);

        if ($adminId) {
            // Send welcome email
            if ($this->mailer) {
                $this->mailer->sendWelcomeEmail($email, $username);
            }

            // Automatically log in the user
            $_SESSION['admin_id'] = $adminId;
            $_SESSION['admin_username'] = $username;
            $_SESSION['admin_email'] = $email;
            $_SESSION['admin_role'] = 'moderator';

            $this->setFlash('success', 'Account created successfully! Welcome, ' . $username . '!');
            $this->redirect('index.php?controller=dashboard');
        } else {
            $this->setFlash('danger', 'Failed to create account. Please try again.');
            $this->redirect('index.php?controller=auth&action=register');
        }
    }

    /**
     * Display forgot password form
     */
    public function showForgotPassword() {
        $data = [
            'title' => 'Forgot Password - Travel Bling Admin',
            'csrf_token' => $this->generateCsrfToken(),
            'flash' => $this->getFlash()
        ];

        $this->view('auth/forgot_password', $data);
    }

    /**
     * Process forgot password - with Google verification support
     */
    public function forgotPassword() {
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=auth&action=forgot-password');
        }

        // Verify CSRF
        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Invalid request. Please try again.');
            $this->redirect('index.php?controller=auth&action=forgot-password');
        }

        $email = $this->sanitize($this->post('email'));
        $googleVerified = $this->post('google_verified') === '1';
        $googleToken = $this->post('google_token');

        if (empty($email)) {
            $this->setFlash('danger', 'Please enter your email address.');
            $this->redirect('index.php?controller=auth&action=forgot-password');
        }

        if (!$this->validateEmail($email)) {
            $this->setFlash('danger', 'Invalid email format.');
            $this->redirect('index.php?controller=auth&action=forgot-password');
        }

        // Verify Google token if provided
        if ($googleVerified && $googleToken) {
            $verifiedEmail = $this->verifyGoogleToken($googleToken);
            if ($verifiedEmail && strtolower($verifiedEmail) === strtolower($email)) {
                // Google verified - send reset link directly
                $result = $this->adminModel->createPasswordResetToken($email);
                
                if ($result['success']) {
                    $this->mailer->sendPasswordResetLink($email, $result['token'], $result['admin']['usersname']);
                    $this->setFlash('success', 'Google verified! Password reset link has been sent to your email.');
                } else {
                    $this->setFlash('danger', $result['message']);
                }
                $this->redirect('index.php?controller=auth&action=forgot-password');
                return;
            }
        }

        // Regular flow - send reset link
        $result = $this->adminModel->createPasswordResetToken($email);
        
        if ($result['success']) {
            $this->mailer->sendPasswordResetLink($email, $result['token'], $result['admin']['usersname']);
            $this->setFlash('success', 'Password reset link has been sent to your email.');
        } else {
            $this->setFlash('danger', $result['message']);
        }

        $this->redirect('index.php?controller=auth&action=forgot-password');
    }

    /**
     * Verify Google JWT token
     */
    private function verifyGoogleToken($token) {
        try {
            // Decode the JWT to get the payload
            $parts = explode('.', $token);
            if (count($parts) !== 3) {
                return false;
            }
            
            $payload = json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true);
            
            if (!$payload) {
                return false;
            }
            
            // Verify the token is from Google
            if (!isset($payload['iss']) || !in_array($payload['iss'], ['accounts.google.com', 'https://accounts.google.com'])) {
                return false;
            }
            
            // Verify client ID if configured
            if (defined('GOOGLE_CLIENT_ID') && GOOGLE_CLIENT_ID !== 'YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com') {
                if (!isset($payload['aud']) || $payload['aud'] !== GOOGLE_CLIENT_ID) {
                    return false;
                }
            }
            
            // Check if token is expired
            if (!isset($payload['exp']) || $payload['exp'] < time()) {
                return false;
            }
            
            // Check if email is verified by Google
            if (!isset($payload['email_verified']) || !$payload['email_verified']) {
                return false;
            }
            
            return $payload['email'] ?? false;
        } catch (Exception $e) {
            error_log('Google token verification error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Display reset password form
     */
    public function showResetPassword() {
        $token = $this->get('token');

        if (empty($token)) {
            $this->setFlash('danger', 'Invalid reset link.');
            $this->redirect('index.php?controller=auth&action=login');
        }

        // Validate token
        $validToken = $this->adminModel->validateToken($token);
        
        if (!$validToken) {
            $this->setFlash('danger', 'Invalid or expired reset link.');
            $this->redirect('index.php?controller=auth&action=login');
        }

        $data = [
            'title' => 'Reset Password - Travel Bling Admin',
            'token' => $token,
            'csrf_token' => $this->generateCsrfToken(),
            'flash' => $this->getFlash()
        ];

        $this->view('auth/reset_password', $data);
    }

    /**
     * Process reset password
     */
    public function resetPassword() {
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=auth&action=login');
        }

        // Verify CSRF
        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Invalid request. Please try again.');
            $this->redirect('index.php?controller=auth&action=login');
        }

        $token = $this->post('token');
        $password = $this->post('password');
        $confirmPassword = $this->post('confirm_password');

        // Validate
        if (empty($password)) {
            $this->setFlash('danger', 'Password is required.');
            $this->redirect('index.php?controller=auth&action=reset-password&token=' . $token);
        }

        if (strlen($password) < 6) {
            $this->setFlash('danger', 'Password must be at least 6 characters.');
            $this->redirect('index.php?controller=auth&action=reset-password&token=' . $token);
        }

        if ($password !== $confirmPassword) {
            $this->setFlash('danger', 'Passwords do not match.');
            $this->redirect('index.php?controller=auth&action=reset-password&token=' . $token);
        }

        // Reset password
        $result = $this->adminModel->resetPassword($token, $password);

        if ($result['success']) {
            // Send confirmation email
            if ($this->mailer) {
                $this->mailer->sendPasswordChangedEmail($result['admin']['email'], $result['admin']['usersname']);
            }

            $this->setFlash('success', 'Password changed successfully! Please login with your new password.');
            $this->redirect('index.php?controller=auth&action=login');
        } else {
            $this->setFlash('danger', $result['message']);
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

    /**
     * Display profile form
     */
    public function showProfile() {
        $this->requireAuth();
        $admin = $this->getCurrentAdmin();
        
        $data = [
            'title' => 'My Profile - Travel Bling Admin',
            'admin' => $admin,
            'csrf_token' => $this->generateCsrfToken(),
            'flash' => $this->getFlash()
        ];

        $this->view('auth/profile', $data);
    }

    /**
     * Process profile update
     */
    public function profile() {
        $this->requireAuth();

        if (!$this->isPost()) {
            $this->redirect('index.php?controller=auth&action=profile');
        }

        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Invalid request. Please try again.');
            $this->redirect('index.php?controller=auth&action=profile');
        }

        $admin = $this->getCurrentAdmin();
        $username = $this->sanitize($this->post('username'));
        $email = $this->sanitize($this->post('email'));
        $password = $this->post('password');
        
        $errors = [];

        if (empty($username)) $errors[] = 'Username is required.';
        if (empty($email)) $errors[] = 'Email is required.';
        
        // Handle Avatar Upload
        $avatarPath = $admin['avatar'];
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($_FILES['avatar']['type'], $allowedTypes)) {
                $errors[] = 'Invalid avatar image type. Only JPG, PNG, GIF, WEBP are allowed.';
            } else {
                // Ensure avatars directory exists
                $uploadDir = __DIR__ . '/../../img/avatars/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
                $filename = 'admin_' . $admin['id'] . '_' . time() . '.' . $extension;
                $targetFile = $uploadDir . $filename;
                
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                    $avatarPath = $filename;
                } else {
                    $errors[] = 'Failed to upload avatar image.';
                }
            }
        }

        if (!empty($errors)) {
            $this->setFlash('danger', implode('<br>', $errors));
            $this->redirect('index.php?controller=auth&action=profile');
            return;
        }

        // Update data
        $updateData = [
            'usersname' => $username,
            'email' => $email,
            'avatar' => $avatarPath
        ];

        // Also update password if provided
        if (!empty($password)) {
            if (strlen($password) < 6) {
                $this->setFlash('danger', 'Password must be at least 6 characters.');
                $this->redirect('index.php?controller=auth&action=profile');
                return;
            }
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $result = $this->adminModel->update($admin['id'], $updateData);

        if ($result) {
            // Update session info
            $_SESSION['admin_username'] = $username;
            $_SESSION['admin_email'] = $email;
            $_SESSION['admin_avatar'] = $avatarPath;

            $this->setFlash('success', 'Profile updated successfully.');
        } else {
            $this->setFlash('danger', 'Failed to update profile.');
        }

        $this->redirect('index.php?controller=auth&action=profile');
    }

    /**
     * Logout
     */
    public function logout() {
        if (!empty($_COOKIE[$this->rememberCookieName])) {
            $this->adminModel->clearRememberToken($_COOKIE[$this->rememberCookieName]);
        }

        // Clear session
        session_unset();
        session_destroy();

        $this->clearRememberCookie();

        // Start new session for flash message
        session_start();
        $this->setFlash('success', 'You have been logged out successfully.');
        $this->redirect('index.php?controller=auth&action=login');
    }

    private function getClientIpAddress() {
        $candidates = [
            $_SERVER['HTTP_CF_CONNECTING_IP'] ?? null,
            $_SERVER['HTTP_X_FORWARDED_FOR'] ?? null,
            $_SERVER['REMOTE_ADDR'] ?? null,
        ];

        foreach ($candidates as $candidate) {
            if (empty($candidate)) {
                continue;
            }

            $ip = trim(explode(',', $candidate)[0]);
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }

        return null;
    }

    private function setAdminSession(array $admin) {
        $_SESSION['admin_id'] = $admin['adminID'];
        $_SESSION['admin_username'] = $admin['usersname'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_role'] = $admin['role'];
        $_SESSION['admin_avatar'] = $admin['avatar'] ?? null;
    }

    private function setRememberCookie($token) {
        setcookie($this->rememberCookieName, $token, [
            'expires' => time() + (86400 * 30),
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }

    private function clearRememberCookie() {
        setcookie($this->rememberCookieName, '', [
            'expires' => time() - 3600,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }
}
