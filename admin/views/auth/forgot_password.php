<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Forgot Password - Travel Bling Admin'; ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <?php 
    // Check if Google OAuth is properly configured
    $googleConfigured = defined('GOOGLE_CLIENT_ID') && 
                        GOOGLE_CLIENT_ID !== 'YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com' &&
                        strpos(GOOGLE_CLIENT_ID, '.apps.googleusercontent.com') !== false;
    ?>
    
    <?php if ($googleConfigured): ?>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <?php endif; ?>
    
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
            background: url('../img/RÁC/kd.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: -1;
        }
        
        .forgot-container { width: 100%; max-width: 450px; }
        
        .forgot-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            animation: fadeInUp 0.6s ease;
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .brand-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 5px 20px rgba(78, 115, 223, 0.4);
        }
        
        .brand-icon i {
            font-size: 2rem;
            color: white;
        }
        .welcome-text { color: #5a5c69; font-weight: 600; margin-bottom: 0.5rem; font-size: 1.4rem; }
        .subtitle { color: #858796; font-size: 0.85rem; margin-bottom: 1.5rem; }
        
        .form-control-user {
            font-size: 0.9rem;
            border-radius: 10rem !important;
            padding: 1.25rem 1.5rem !important;
            border: 1px solid #d1d3e2;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }
        
        .form-control-user:focus {
            border-color: #f6c23e;
            box-shadow: 0 0 0 0.2rem rgba(246, 194, 62, 0.25);
            background: white;
        }
        
        .btn-user {
            font-size: 0.9rem;
            border-radius: 10rem !important;
            padding: 0.9rem 1.5rem !important;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
            border: none;
            color: white;
        }
        
        .btn-warning:hover {
            background: linear-gradient(135deg, #dda20a 0%, #b8860b 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(246, 194, 62, 0.4);
            color: white;
        }
        
        .auth-links a { color: #f6c23e; font-size: 0.85rem; transition: color 0.3s ease; }
        .auth-links a:hover { color: #dda20a; text-decoration: none; }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.25rem 0;
        }
        
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-top: 1px solid #e3e6f0;
        }
        
        .divider span { padding: 0 1rem; color: #858796; font-size: 0.8rem; }
        
        .alert { border-radius: 0.75rem; font-size: 0.85rem; }
        
        .google-verified {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            display: none;
        }
        
        .google-verified.show { display: block; }
        .google-verified i { margin-right: 0.5rem; }
        #google-email-display { font-weight: 600; }
        .hidden { display: none !important; }
        .g_id_signin { display: flex; justify-content: center; }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="text-center">
                <div class="brand-icon" style="padding: 0; overflow: hidden;">
                        <img src="../img/travel-bling-logo-cropped.png"
                             alt="Travel Bling"
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h1 class="welcome-text">Forgot Password?</h1>
                <p class="subtitle">Enter your email to receive a reset link</p>
            </div>
            
            <?php if (isset($flash) && $flash): ?>
            <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $flash['message']; ?>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
            <?php endif; ?>
            
            <div class="google-verified" id="google-verified">
                <i class="fas fa-check-circle"></i>
                Verified: <span id="google-email-display"></span>
            </div>
            
            <?php if ($googleConfigured): ?>
            <div id="step-google">
                <div id="g_id_onload"
                     data-client_id="<?php echo GOOGLE_CLIENT_ID; ?>"
                     data-callback="handleGoogleCallback"
                     data-auto_prompt="false">
                </div>
                
                <div class="g_id_signin"
                     data-type="standard"
                     data-size="large"
                     data-theme="outline"
                     data-text="continue_with"
                     data-shape="pill"
                     data-logo_alignment="center">
                </div>
                
                <div class="divider">
                    <span>or enter email manually</span>
                </div>
            </div>
            <?php endif; ?>
            
            <form class="user" method="POST" action="index.php?controller=auth&action=forgot-password" id="reset-form">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <input type="hidden" name="google_verified" id="google-verified-input" value="0">
                <input type="hidden" name="google_token" id="google-token-input" value="">
                
                <div class="form-group">
                    <input type="email" 
                           class="form-control form-control-user" 
                           name="email" 
                           id="email-input"
                           placeholder="Enter Email Address..."
                           required
                           autocomplete="email">
                </div>
                
                <button type="submit" class="btn btn-warning btn-user btn-block">
                    <i class="fas fa-paper-plane mr-2"></i> Send Reset Link
                </button>
            </form>
            
            <div class="divider"><span></span></div>
            
            <div class="text-center auth-links">
                <a href="index.php?controller=auth&action=login">
                    <i class="fas fa-sign-in-alt mr-1"></i> Back to Login
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <?php if ($googleConfigured): ?>
    <script>
        function handleGoogleCallback(response) {
            const token = response.credential;
            const payload = parseJwt(token);
            
            if (payload && payload.email) {
                document.getElementById('google-verified').classList.add('show');
                document.getElementById('google-email-display').textContent = payload.email;
                document.getElementById('email-input').value = payload.email;
                document.getElementById('email-input').readOnly = true;
                document.getElementById('email-input').style.backgroundColor = '#e9ecef';
                document.getElementById('google-verified-input').value = '1';
                document.getElementById('google-token-input').value = token;
                document.getElementById('step-google').classList.add('hidden');
            }
        }
        
        function parseJwt(token) {
            try {
                const base64Url = token.split('.')[1];
                const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));
                return JSON.parse(jsonPayload);
            } catch (e) {
                return null;
            }
        }
    </script>
    <?php endif; ?>
</body>
</html>
