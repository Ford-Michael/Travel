<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Login - Travel Bling Admin'; ?></title>
    
    <!-- Google Fonts - Nunito -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
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
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: -1;
        }
        
        .login-container {
            width: 100%;
            max-width: 450px;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 3rem;
            animation: fadeInUp 0.6s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        
        .welcome-text {
            color: #5a5c69;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.75rem;
        }
        
        .subtitle {
            color: #858796;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }
        
        .form-control-user {
            font-size: 0.9rem;
            border-radius: 10rem !important;
            padding: 1.5rem 1.5rem !important;
            border: 1px solid #d1d3e2;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }
        
        .form-control-user:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            background: white;
        }
        
        .btn-user {
            font-size: 0.9rem;
            border-radius: 10rem !important;
            padding: 1rem 1.5rem !important;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #224abe 0%, #1a3a8f 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(78, 115, 223, 0.4);
        }
        
        .auth-links a {
            color: #4e73df;
            font-size: 0.85rem;
            transition: color 0.3s ease;
        }
        
        .auth-links a:hover {
            color: #224abe;
            text-decoration: none;
        }
        
        .divider {
            border-top: 1px solid #e3e6f0;
            margin: 1.5rem 0;
        }
        
        .custom-checkbox .custom-control-label {
            font-size: 0.85rem;
            color: #858796;
        }
        
        .alert {
            border-radius: 0.75rem;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="text-center">
                <div class="brand-icon" style="padding: 0; overflow: hidden;">
                        <img src="../img/travel-bling-logo-cropped.png"
                             alt="Travel Bling"
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h1 class="welcome-text">Welcome Back!</h1>
                <p class="subtitle">Sign in to continue to Travel Bling</p>
            </div>
            
            <!-- Flash Messages -->
            <?php if (isset($flash) && $flash): ?>
            <div class="alert alert-<?php echo $flash['type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $flash['message']; ?>
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
            <?php endif; ?>
            
            <form class="user" method="POST" action="index.php?controller=auth&action=login">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                
                <div class="form-group">
                    <input type="text" 
                           class="form-control form-control-user" 
                           name="email" 
                           placeholder="Enter Email or Username..."
                           required
                           autocomplete="username">
                </div>
                
                <div class="form-group">
                    <input type="password" 
                           class="form-control form-control-user" 
                           name="password" 
                           placeholder="Password"
                           required
                           autocomplete="current-password">
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="rememberMe" name="remember" value="1">
                        <label class="custom-control-label" for="rememberMe">Remember Me</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </form>
            
            <div class="divider"></div>
            
            <div class="text-center auth-links">
                <a href="index.php?controller=auth&action=forgot-password">
                    <i class="fas fa-key mr-1"></i> Forgot Password?
                </a>
            </div>
            
            <div class="text-center auth-links mt-3">
                <a href="index.php?controller=auth&action=register">
                    <i class="fas fa-user-plus mr-1"></i> Create an Account!
                </a>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

