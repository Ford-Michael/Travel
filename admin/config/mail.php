<?php
/**
 * Mail Configuration
 * Configure SMTP settings for sending emails
 */

// SMTP Configuration
define('MAIL_HOST', 'smtp.gmail.com');          // SMTP server
define('MAIL_PORT', 587);                        // SMTP port (587 for TLS, 465 for SSL)
define('MAIL_USERNAME', 'your-email@gmail.com'); // Your email address
define('MAIL_PASSWORD', 'your-app-password');    // App password (not regular password)
define('MAIL_ENCRYPTION', 'tls');                // 'tls' or 'ssl'

// Sender Information
define('MAIL_FROM_ADDRESS', 'noreply@travelbling.com');
define('MAIL_FROM_NAME', 'Travel Bling');

// Debug mode (0 = off, 1 = client, 2 = server)
define('MAIL_DEBUG', 0);

/**
 * IMPORTANT: For Gmail, you need to:
 * 1. Enable 2-Factor Authentication on your Google account
 * 2. Generate an App Password at: https://myaccount.google.com/apppasswords
 * 3. Use the App Password (16 characters) as MAIL_PASSWORD
 * 
 * For other providers, adjust MAIL_HOST and MAIL_PORT accordingly:
 * - Outlook/Hotmail: smtp.office365.com, port 587
 * - Yahoo: smtp.mail.yahoo.com, port 587
 * - Custom: Your mail server's SMTP settings
 */
