<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Reset Password - Travel Bling Admin'; ?></title>
    
    <!-- Google Fonts - Nunito -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        
        .reset-card {
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            max-width: 500px;
            margin: 0 auto;
        }
        
        .form-control-user {
            font-size: 0.9rem;
            border-radius: 10rem !important;
            padding: 1.5rem 1.5rem !important;
            border: 1px solid #d1d3e2;
            transition: all 0.3s ease;
        }
        
        .form-control-user:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
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
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.4);
        }
        
        .welcome-text {
            color: #5a5c69;
            font-weight: 400;
            margin-bottom: 0.5rem;
        }
        
        .subtitle {
            color: #858796;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
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
        
        .alert {
            border-radius: 10rem;
            font-size: 0.85rem;
        }
        
        .icon-reset {
            font-size: 4rem;
            color: #1cc88a;
            margin-bottom: 1rem;
        }
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="card o-hidden border-0 shadow-lg my-5 reset-card">
                    <div class="card-body p-5">
                        <div class="text-center">
                            <div class="icon-reset">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h1 class="h3 welcome-text">Set New Password</h1>
                            <p class="subtitle">
                                Enter your new password below. Make sure it's secure!
                            </p>
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
                        
                        <form class="user" method="POST" action="index.php?controller=auth&action=reset-password">
                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                            
                            <div class="form-group">
                                <input type="password" 
                                       class="form-control form-control-user" 
                                       name="password" 
                                       id="password"
                                       placeholder="New Password"
                                       required
                                       minlength="6"
                                       autocomplete="new-password">
                                <div id="passwordStrength" class="password-strength"></div>
                            </div>
                            
                            <div class="form-group">
                                <input type="password" 
                                       class="form-control form-control-user" 
                                       name="confirm_password" 
                                       id="confirmPassword"
                                       placeholder="Confirm New Password"
                                       required
                                       autocomplete="new-password">
                            </div>
                            
                            <div class="small text-muted mb-3">
                                <i class="fas fa-info-circle mr-1"></i>
                                Password must be at least 6 characters long
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                <i class="fas fa-check mr-2"></i> Reset Password
                            </button>
                        </form>
                        
                        <div class="divider"></div>
                        
                        <div class="text-center auth-links">
                            <a href="index.php?controller=auth&action=login">
                                <i class="fas fa-sign-in-alt mr-1"></i> Back to Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrength');
            let strength = 0;
            
            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            const colors = ['#e74a3b', '#fd7e14', '#f6c23e', '#1cc88a', '#1cc88a'];
            const widths = ['20%', '40%', '60%', '80%', '100%'];
            
            strengthBar.style.width = widths[strength - 1] || '0%';
            strengthBar.style.backgroundColor = colors[strength - 1] || '#e3e6f0';
        });
        
        // Confirm password validation
        document.getElementById('confirmPassword').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            if (this.value !== password) {
                this.setCustomValidity('Passwords do not match');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>
