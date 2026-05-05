<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Create Account - Travel Bling Admin'; ?></title>
    
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
            background: url('../img/RÁC/kk.jpg') no-repeat center center fixed;
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
            background: rgba(0, 0, 0, 0.35);
            z-index: -1;
        }
        
        .register-container {
            width: 100%;
            max-width: 500px;
        }
        
        .register-card {
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
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 5px 20px rgba(28, 200, 138, 0.4);
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
            border-color: #1cc88a;
            box-shadow: 0 0 0 0.2rem rgba(28, 200, 138, 0.25);
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
        
        .btn-success {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
            border: none;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #13855c 0%, #0e6b48 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(28, 200, 138, 0.4);
        }
        
        .auth-links a {
            color: #1cc88a;
            font-size: 0.85rem;
            transition: color 0.3s ease;
        }
        
        .auth-links a:hover {
            color: #13855c;
            text-decoration: none;
        }
        
        .divider {
            border-top: 1px solid #e3e6f0;
            margin: 1.5rem 0;
        }
        
        .alert {
            border-radius: 0.75rem;
            font-size: 0.85rem;
        }
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="text-center">
                <div class="brand-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1 class="welcome-text">Create Account</h1>
                <p class="subtitle">Join Travel Bling today!</p>
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
            
            <form class="user" method="POST" action="index.php?controller=auth&action=register">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                
                <div class="form-group">
                    <input type="text" 
                           class="form-control form-control-user" 
                           name="username" 
                           placeholder="Username"
                           required
                           minlength="3"
                           autocomplete="username">
                </div>
                
                <div class="form-group">
                    <input type="email" 
                           class="form-control form-control-user" 
                           name="email" 
                           placeholder="Email Address"
                           required
                           autocomplete="email">
                </div>
                
                <div class="form-group">
                    <input type="password" 
                           class="form-control form-control-user" 
                           name="password" 
                           id="password"
                           placeholder="Password"
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
                           placeholder="Confirm Password"
                           required
                           autocomplete="new-password">
                </div>
                
                <button type="submit" class="btn btn-success btn-user btn-block">
                    <i class="fas fa-user-plus mr-2"></i> Register Account
                </button>
            </form>
            
            <div class="divider"></div>
            
            <div class="text-center auth-links">
                <a href="index.php?controller=auth&action=login">
                    <i class="fas fa-sign-in-alt mr-1"></i> Already have an account? Login!
                </a>
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

