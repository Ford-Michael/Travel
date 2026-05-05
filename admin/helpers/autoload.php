<?php
/**
 * Alternative Mailer without Composer
 * Download PHPMailer manually if Composer is not available
 * 
 * INSTRUCTIONS:
 * 1. Download PHPMailer from: https://github.com/PHPMailer/PHPMailer/releases
 * 2. Extract and copy these files to: admin/lib/PHPMailer/
 *    - src/Exception.php
 *    - src/PHPMailer.php
 *    - src/SMTP.php
 * 3. This autoloader will load them automatically
 */

// Manual autoloader for PHPMailer (no Composer)
spl_autoload_register(function ($class) {
    $prefix = 'PHPMailer\\PHPMailer\\';
    $base_dir = __DIR__ . '/../lib/PHPMailer/src/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});
