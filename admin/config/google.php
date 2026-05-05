+<?php
/**
 * Google OAuth Configuration
 * Used for Google Sign-In integration
 * 
 * SETUP INSTRUCTIONS:
 * 1. Go to: https://console.cloud.google.com/
 * 2. Create a new project or select existing
 * 3. Enable "Google Identity Services" API
 * 4. Go to Credentials -> Create Credentials -> OAuth 2.0 Client ID
 * 5. Application type: Web application
 * 6. Add authorized JavaScript origins: http://localhost
 * 7. Add authorized redirect URIs: http://localhost/travel.bling/admin/index.php
 * 8. Copy your Client ID below
 */

// Your Google OAuth Client ID
define('GOOGLE_CLIENT_ID', 'YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com');

// OAuth enabled flag
define('GOOGLE_OAUTH_ENABLED', true);
