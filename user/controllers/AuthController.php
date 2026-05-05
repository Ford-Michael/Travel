<?php
/**
 * Auth Controller
 * Handles user login, register, logout, and forgot password
 */

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController extends Controller {
    private $userModel;
    private $rememberCookieName = 'travel_bling_user_remember';

    public function __construct() {
        $this->userModel = new UserModel();
    }

    /**
     * Show login form
     */
    public function showLogin() {
        if ($this->isLoggedIn()) {
            $this->redirect('index.php?controller=home');
        }

        $this->view('auth/login', [
            'title' => 'Dang Nhap | Viet Sun Travel',
            'csrf_token' => $this->generateCsrfToken(),
            'flash' => $this->getFlash(),
            'hideTopBar' => true,
        ]);
    }

    /**
     * Process login
     */
    public function login() {
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=auth&action=login');
        }

        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Yeu cau khong hop le. Vui long thu lai.');
            $this->redirect('index.php?controller=auth&action=login');
        }

        $email = $this->sanitize($this->post('email'));
        $password = $this->post('password');
        $remember = $this->post('remember');

        if (empty($email) || empty($password)) {
            $this->setFlash('danger', 'Vui long dien day du thong tin.');
            $this->redirect('index.php?controller=auth&action=login');
        }

        $result = $this->userModel->login($email, $password);

        if ($result['success']) {
            $user = $result['user'];
            $this->setUserSession($user);

            if ($remember) {
                $token = $this->userModel->createRememberToken((int) ($user['usersID'] ?? $user['userID']), 30);
                $this->setRememberCookie($token);
            } else {
                $this->clearRememberCookie();
                $this->userModel->clearRememberTokensByUser((int) ($user['usersID'] ?? $user['userID']));
            }

            $this->setFlash('success', 'Chao mung tro lai, ' . ($user['username'] ?? $user['usersname'] ?? '') . '!');
            $this->redirect('index.php?controller=home');
        }

        $this->setFlash('danger', $result['message']);
        $this->redirect('index.php?controller=auth&action=login');
    }

    /**
     * Show register form
     */
    public function showRegister() {
        if ($this->isLoggedIn()) {
            $this->redirect('index.php?controller=home');
        }

        $this->view('auth/register', [
            'title' => 'Dang Ky | Viet Sun Travel',
            'csrf_token' => $this->generateCsrfToken(),
            'flash' => $this->getFlash(),
            'hideTopBar' => true,
        ]);
    }

    /**
     * Process registration
     */
    public function register() {
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=auth&action=register');
        }

        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Yeu cau khong hop le. Vui long thu lai.');
            $this->redirect('index.php?controller=auth&action=register');
        }

        $username = $this->sanitize($this->post('username'));
        $email = $this->sanitize($this->post('email'));
        $phone = $this->sanitize($this->post('phone'));
        $password = $this->post('password');
        $confirmPassword = $this->post('confirm_password');

        $errors = [];

        if (empty($username) || strlen($username) < 3) {
            $errors[] = 'Ten nguoi dung phai co it nhat 3 ky tu.';
        }
        if (empty($email) || !$this->validateEmail($email)) {
            $errors[] = 'Email khong hop le.';
        } elseif ($this->userModel->emailExists($email)) {
            $errors[] = 'Email nay da duoc dang ky.';
        }
        if (!empty($phone) && !preg_match('/^[0-9]{10}$/', $phone)) {
            $errors[] = 'So dien thoai phai co dung 10 chu so.';
        }
        if (empty($password) || strlen($password) < 6) {
            $errors[] = 'Mat khau phai co it nhat 6 ky tu.';
        }
        if ($password !== $confirmPassword) {
            $errors[] = 'Xac nhan mat khau khong khop.';
        }
        if ($this->userModel->usernameExists($username)) {
            $errors[] = 'Ten nguoi dung nay da duoc su dung.';
        }

        if (!empty($errors)) {
            $this->setFlash('danger', implode('<br>', $errors));
            $this->redirect('index.php?controller=auth&action=register');
        }

        $userId = $this->userModel->createUser([
            'username' => $username,
            'email' => $email,
            'phoneNumber' => $phone,
            'password' => $password,
        ]);

        if ($userId) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_username'] = $username;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_phone'] = $phone;

            $this->setFlash('success', 'Dang ky thanh cong! Chao mung ' . $username . '!');
            $this->redirect('index.php?controller=home');
        }

        $this->setFlash('danger', 'Dang ky that bai. Vui long thu lai.');
        $this->redirect('index.php?controller=auth&action=register');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword() {
        $this->view('auth/forgot_password', [
            'title' => 'Quen Mat Khau | Viet Sun Travel',
            'csrf_token' => $this->generateCsrfToken(),
            'flash' => $this->getFlash(),
            'hideTopBar' => true,
        ]);
    }

    /**
     * Process forgot password request
     */
    public function forgotPassword() {
        if (!$this->isPost()) {
            $this->redirect('index.php?controller=auth&action=forgotPassword');
        }

        if (!$this->verifyCsrfToken($this->post('csrf_token'))) {
            $this->setFlash('danger', 'Yeu cau khong hop le. Vui long thu lai.');
            $this->redirect('index.php?controller=auth&action=forgotPassword');
        }

        $email = $this->sanitize($this->post('email'));

        if (empty($email) || !$this->validateEmail($email)) {
            $this->setFlash('danger', 'Vui long nhap dia chi email hop le.');
            $this->redirect('index.php?controller=auth&action=forgotPassword');
        }

        $this->userModel->findByEmail($email);

        $this->setFlash('success', 'Neu email ton tai trong he thong, chung toi se gui lien ket dat lai mat khau cho ban.');
        $this->redirect('index.php?controller=auth&action=forgotPassword');
    }

    /**
     * Logout
     */
    public function logout() {
        if (!empty($_COOKIE[$this->rememberCookieName])) {
            $this->userModel->clearRememberToken($_COOKIE[$this->rememberCookieName]);
        }

        session_unset();
        session_destroy();
        $this->clearRememberCookie();
        session_start();
        $this->setFlash('success', 'Ban da dang xuat thanh cong.');
        $this->redirect('index.php?controller=auth&action=login');
    }

    private function setUserSession(array $user) {
        $_SESSION['user_id'] = $user['userID'] ?? $user['usersID'];
        $_SESSION['user_username'] = $user['username'] ?? $user['usersname'] ?? '';
        $_SESSION['user_email'] = $user['email'] ?? '';
        $_SESSION['user_phone'] = $user['phoneNumber'] ?? ($user['phone'] ?? '');
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
