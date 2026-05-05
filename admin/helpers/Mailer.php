<?php
/**
 * Mailer Helper Class
 * Handles all email sending functionality
 * Uses PHPMailer if available, otherwise falls back to PHP mail()
 */

require_once __DIR__ . '/../config/mail.php';

class Mailer {
    private $usePHPMailer = false;
    private $mail = null;

    public function __construct() {
        // Try to load PHPMailer
        $phpmailerPath = __DIR__ . '/../lib/PHPMailer/src/PHPMailer.php';
        
        if (file_exists($phpmailerPath)) {
            require_once __DIR__ . '/autoload.php';
            $this->usePHPMailer = true;
            $this->mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            $this->configurePHPMailer();
        }
    }

    /**
     * Configure PHPMailer with SMTP settings
     */
    private function configurePHPMailer() {
        try {
            $this->mail->SMTPDebug = MAIL_DEBUG;
            $this->mail->isSMTP();
            $this->mail->Host = MAIL_HOST;
            $this->mail->SMTPAuth = true;
            $this->mail->Username = MAIL_USERNAME;
            $this->mail->Password = MAIL_PASSWORD;
            $this->mail->SMTPSecure = MAIL_ENCRYPTION;
            $this->mail->Port = MAIL_PORT;
            $this->mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
            $this->mail->isHTML(true);
            $this->mail->CharSet = 'UTF-8';
        } catch (Exception $e) {
            error_log("Mailer configuration error: " . $e->getMessage());
            $this->usePHPMailer = false;
        }
    }

    /**
     * Send email using PHP mail() function
     */
    private function sendWithPHPMail($to, $subject, $htmlBody) {
        $headers = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/html; charset=UTF-8";
        $headers[] = "From: " . MAIL_FROM_NAME . " <" . MAIL_FROM_ADDRESS . ">";
        $headers[] = "Reply-To: " . MAIL_FROM_ADDRESS;
        $headers[] = "X-Mailer: PHP/" . phpversion();
        
        $headerString = implode("\r\n", $headers);
        
        return mail($to, $subject, $htmlBody, $headerString);
    }

    /**
     * Send email (automatically chooses method)
     */
    private function send($to, $subject, $htmlBody) {
        if ($this->usePHPMailer && $this->mail) {
            try {
                $this->mail->clearAddresses();
                $this->mail->addAddress($to);
                $this->mail->Subject = $subject;
                $this->mail->Body = $htmlBody;
                $this->mail->AltBody = strip_tags($htmlBody);
                $this->mail->send();
                return true;
            } catch (Exception $e) {
                error_log("PHPMailer error: " . $this->mail->ErrorInfo);
                // Fallback to PHP mail()
                return $this->sendWithPHPMail($to, $subject, $htmlBody);
            }
        } else {
            return $this->sendWithPHPMail($to, $subject, $htmlBody);
        }
    }

    /**
     * Send welcome email after registration
     */
    public function sendWelcomeEmail($email, $username) {
        $subject = 'Welcome to Travel Bling!';
        $body = $this->getWelcomeTemplate($username);
        
        if ($this->send($email, $subject, $body)) {
            return ['success' => true, 'message' => 'Welcome email sent successfully'];
        }
        return ['success' => false, 'message' => 'Failed to send welcome email'];
    }

    /**
     * Send password reset email with clickable link
     */
    public function sendPasswordResetLink($email, $token, $username) {
        $subject = 'Reset Your Password - Travel Bling';
        $resetLink = BASE_URL . '/index.php?controller=auth&action=reset-password&token=' . $token;
        $body = $this->getResetLinkTemplate($username, $resetLink);
        
        if ($this->send($email, $subject, $body)) {
            return ['success' => true, 'message' => 'Password reset link sent to your email'];
        }
        return ['success' => false, 'message' => 'Failed to send reset email'];
    }

    /**
     * Send password reset email with temporary password
     */
    public function sendTemporaryPassword($email, $tempPassword, $username) {
        $subject = 'Your New Password - Travel Bling';
        $body = $this->getTempPasswordTemplate($username, $tempPassword);
        
        if ($this->send($email, $subject, $body)) {
            return ['success' => true, 'message' => 'New password sent to your email'];
        }
        return ['success' => false, 'message' => 'Failed to send new password'];
    }

    /**
     * Send password changed confirmation
     */
    public function sendPasswordChangedEmail($email, $username) {
        $subject = 'Password Changed Successfully - Travel Bling';
        $body = $this->getPasswordChangedTemplate($username);
        
        if ($this->send($email, $subject, $body)) {
            return ['success' => true, 'message' => 'Confirmation email sent'];
        }
        return ['success' => false, 'message' => 'Failed to send confirmation email'];
    }

    /**
     * Welcome email template
     */
    private function getWelcomeTemplate($username) {
        $baseUrl = BASE_URL;
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f8f9fc;">
    <div style="max-width: 600px; margin: 0 auto; padding: 40px 20px;">
        <div style="background: white; border-radius: 10px; padding: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="text-align: center; margin-bottom: 30px;">
                <h1 style="color: #4e73df; margin: 0;">Travel Bling</h1>
            </div>
            <h2 style="color: #5a5c69; text-align: center;">Welcome, {$username}!</h2>
            <p style="color: #858796; line-height: 1.6; text-align: center;">
                Your account has been created successfully. You can now login to the admin panel 
                to manage tours, bookings, and users.
            </p>
            <div style="text-align: center; margin: 30px 0;">
                <a href="{$baseUrl}" style="background: #4e73df; color: white; padding: 15px 40px; text-decoration: none; border-radius: 50px; display: inline-block;">
                    Go to Admin Panel
                </a>
            </div>
            <p style="color: #b7b9cc; font-size: 12px; text-align: center; margin-top: 30px;">
                If you did not create this account, please contact support immediately.
            </p>
        </div>
    </div>
</body>
</html>
HTML;
    }

    /**
     * Password reset link template
     */
    private function getResetLinkTemplate($username, $resetLink) {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f8f9fc;">
    <div style="max-width: 600px; margin: 0 auto; padding: 40px 20px;">
        <div style="background: white; border-radius: 10px; padding: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="text-align: center; margin-bottom: 30px;">
                <h1 style="color: #4e73df; margin: 0;">Travel Bling</h1>
            </div>
            <h2 style="color: #5a5c69; text-align: center;">Reset Your Password</h2>
            <p style="color: #858796; line-height: 1.6;">Hello {$username},</p>
            <p style="color: #858796; line-height: 1.6;">
                We received a request to reset your password. Click the button below to set a new password:
            </p>
            <div style="text-align: center; margin: 30px 0;">
                <a href="{$resetLink}" style="background: #4e73df; color: white; padding: 15px 40px; text-decoration: none; border-radius: 50px; display: inline-block;">
                    Reset Password
                </a>
            </div>
            <p style="color: #858796; line-height: 1.6; font-size: 14px;">
                This link will expire in <strong>1 hour</strong>. If you didn't request this, 
                please ignore this email.
            </p>
            <hr style="border: none; border-top: 1px solid #e3e6f0; margin: 30px 0;">
            <p style="color: #b7b9cc; font-size: 12px; text-align: center;">
                Can't click the button? Copy and paste this link:<br>
                <a href="{$resetLink}" style="color: #4e73df;">{$resetLink}</a>
            </p>
        </div>
    </div>
</body>
</html>
HTML;
    }

    /**
     * Temporary password template
     */
    private function getTempPasswordTemplate($username, $tempPassword) {
        $baseUrl = BASE_URL;
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f8f9fc;">
    <div style="max-width: 600px; margin: 0 auto; padding: 40px 20px;">
        <div style="background: white; border-radius: 10px; padding: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="text-align: center; margin-bottom: 30px;">
                <h1 style="color: #4e73df; margin: 0;">Travel Bling</h1>
            </div>
            <h2 style="color: #5a5c69; text-align: center;">Your New Password</h2>
            <p style="color: #858796; line-height: 1.6;">Hello {$username},</p>
            <p style="color: #858796; line-height: 1.6;">
                Your password has been reset. Here is your new temporary password:
            </p>
            <div style="text-align: center; margin: 30px 0;">
                <div style="background: #f8f9fc; border: 2px dashed #4e73df; border-radius: 10px; padding: 20px; display: inline-block;">
                    <span style="font-size: 24px; font-weight: bold; letter-spacing: 2px; color: #5a5c69;">
                        {$tempPassword}
                    </span>
                </div>
            </div>
            <p style="color: #e74a3b; line-height: 1.6; text-align: center;">
                Please change this password after logging in!
            </p>
            <div style="text-align: center; margin: 20px 0;">
                <a href="{$baseUrl}" style="background: #4e73df; color: white; padding: 15px 40px; text-decoration: none; border-radius: 50px; display: inline-block;">
                    Login Now
                </a>
            </div>
        </div>
    </div>
</body>
</html>
HTML;
    }

    /**
     * Password changed confirmation template
     */
    private function getPasswordChangedTemplate($username) {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f8f9fc;">
    <div style="max-width: 600px; margin: 0 auto; padding: 40px 20px;">
        <div style="background: white; border-radius: 10px; padding: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="text-align: center; margin-bottom: 30px;">
                <h1 style="color: #4e73df; margin: 0;">Travel Bling</h1>
            </div>
            <div style="text-align: center; margin-bottom: 20px;">
                <span style="font-size: 60px; color: #1cc88a;">&#10004;</span>
            </div>
            <h2 style="color: #1cc88a; text-align: center;">Password Changed Successfully!</h2>
            <p style="color: #858796; line-height: 1.6; text-align: center;">
                Hello {$username}, your password has been changed successfully.
            </p>
            <p style="color: #858796; line-height: 1.6; text-align: center;">
                If you did not make this change, please contact support immediately 
                and secure your account.
            </p>
            <hr style="border: none; border-top: 1px solid #e3e6f0; margin: 30px 0;">
            <p style="color: #b7b9cc; font-size: 12px; text-align: center;">
                This is an automated message. Please do not reply.
            </p>
        </div>
    </div>
</body>
</html>
HTML;
    }
}

