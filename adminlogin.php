<?php
session_start();
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: adminlogin.php");
    exit();
}

if (isset($_POST['login'])) {
    include 'DBconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admintable WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $username;
        header("Location: AdminPage.php");
        exit();
    } else {
        $login_error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-login-container {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 50%, var(--dark-blue) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .admin-login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-grid)"/></svg>');
            opacity: 0.3;
        }

        .admin-card {
            background: var(--pure-white);
            border-radius: 20px;
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(37, 99, 235, 0.1);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            position: relative;
            z-index: 10;
        }

        .admin-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
        }

        .admin-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="admin-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23admin-pattern)"/></svg>');
            opacity: 0.3;
        }

        .admin-header h1 {
            color: var(--pure-white);
            margin: 0 0 0.5rem 0;
            font-size: 2.5rem;
            position: relative;
            z-index: 2;
        }

        .admin-header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
            font-size: 1.1rem;
            position: relative;
            z-index: 2;
        }

        .admin-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
        }

        .admin-icon i {
            font-size: 2.5rem;
            color: var(--pure-white);
        }

        .admin-body {
            padding: 3rem 2rem;
        }

        .floating-label {
            position: relative;
            margin-bottom: 2rem;
        }

        .floating-input {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--pure-white);
        }

        .floating-input:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .floating-label label {
            position: absolute;
            top: 1rem;
            left: 1.5rem;
            color: var(--medium-gray);
            transition: all 0.3s ease;
            pointer-events: none;
            background: var(--pure-white);
            padding: 0 0.5rem;
        }

        .floating-input:focus + label,
        .floating-input:not(:placeholder-shown) + label {
            top: -0.5rem;
            font-size: 0.875rem;
            color: var(--primary-blue);
        }

        .admin-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .back-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            background: rgba(37, 99, 235, 0.05);
        }

        .back-link:hover {
            background: rgba(37, 99, 235, 0.1);
            transform: translateX(-2px);
        }

        .security-notice {
            background: linear-gradient(135deg, var(--warning-orange), #f97316);
            color: var(--pure-white);
            padding: 1rem;
            border-radius: 8px;
            margin-top: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
        }

        /* Modern Notification System */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
            min-width: 350px;
            max-width: 500px;
            padding: 0;
            border-radius: 16px;
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            animation: slideInRight 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .notification.success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.95), rgba(5, 150, 105, 0.95));
            border-left: 4px solid #10b981;
        }

        .notification.error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.95), rgba(220, 38, 38, 0.95));
            border-left: 4px solid #ef4444;
        }

        .notification.warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.95), rgba(217, 119, 6, 0.95));
            border-left: 4px solid #f59e0b;
        }

        .notification.info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.95), rgba(37, 99, 235, 0.95));
            border-left: 4px solid #3b82f6;
        }

        .notification-content {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.5rem;
        }

        .notification-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            flex-shrink: 0;
            margin-top: 0.125rem;
        }

        .notification.success .notification-icon {
            background: rgba(255, 255, 255, 0.2);
            color: #10b981;
        }

        .notification.error .notification-icon {
            background: rgba(255, 255, 255, 0.2);
            color: #ef4444;
        }

        .notification.warning .notification-icon {
            background: rgba(255, 255, 255, 0.2);
            color: #f59e0b;
        }

        .notification.info .notification-icon {
            background: rgba(255, 255, 255, 0.2);
            color: #3b82f6;
        }

        .notification-text {
            flex: 1;
            color: var(--pure-white);
        }

        .notification-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .notification-message {
            font-size: 0.875rem;
            opacity: 0.9;
            line-height: 1.4;
        }

        .notification-close {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
            font-size: 1.25rem;
            line-height: 1;
            margin-left: 0.5rem;
            flex-shrink: 0;
        }

        .notification-close:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--pure-white);
        }

        .notification-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 0 0 16px 16px;
            animation: progressBar 5s linear forwards;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes progressBar {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }

        @keyframes notificationFadeOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="admin-login-container">
        <div class="admin-card">
            <div class="admin-header">
                <div class="admin-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h1>Admin Portal</h1>
                <p>Secure access to healthcare management system</p>
            </div>

            <div class="admin-body">
                <!-- Notification Container -->
                <div id="notificationContainer"></div>

                <form method="POST" action="">
                    <div class="floating-label">
                        <input type="text" class="floating-input" name="username" placeholder=" " required>
                        <label>Username</label>
                    </div>

                    <div class="floating-label">
                        <input type="password" class="floating-input" name="password" placeholder=" " required>
                        <label>Password</label>
                    </div>

                    <button type="submit" name="login" class="btn btn-neon" style="width: 100%; margin-top: 1rem;">
                        <i class="fas fa-sign-in-alt"></i>
                        Secure Login
                    </button>
                </form>

                <div class="admin-actions">
                    <a href="Home.php" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Back to Home
                    </a>
                </div>

                <div class="security-notice">
                    <i class="fas fa-lock"></i>
                    <span>This is a secure admin area. All access is logged and monitored.</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            top: -0.5rem;
            font-size: 0.875rem;
            color: var(--primary-blue);
        }
    </style>

    <script>
        // Enhanced form validation and animations
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.floating-input');
            const adminCard = document.querySelector('.admin-card');

            // Animate card entrance
            adminCard.style.opacity = '0';
            adminCard.style.transform = 'translateY(50px) scale(0.9)';
            adminCard.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

            setTimeout(() => {
                adminCard.style.opacity = '1';
                adminCard.style.transform = 'translateY(0) scale(1)';
            }, 100);

            // Enhanced input focus effects
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                    this.parentElement.style.transition = 'transform 0.3s ease';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Show error notification if login failed
            <?php if (isset($login_error) && $login_error): ?>
            showNotification('error', 'Login Failed', 'Invalid username or password. Please check your credentials and try again.');
            <?php endif; ?>
        });

        // Modern Notification System
        function showNotification(type, title, message) {
            const container = document.getElementById('notificationContainer');
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;

            const icons = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-triangle',
                warning: 'fas fa-exclamation-circle',
                info: 'fas fa-info-circle'
            };

            notification.innerHTML = `
                <div class="notification-content">
                    <div class="notification-icon">
                        <i class="${icons[type]}"></i>
                    </div>
                    <div class="notification-text">
                        <div class="notification-title">
                            <span>${title}</span>
                        </div>
                        <div class="notification-message">${message}</div>
                    </div>
                    <button class="notification-close" onclick="closeNotification(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="notification-progress"></div>
            `;

            container.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    closeNotification(notification.querySelector('.notification-close'));
                }
            }, 5000);
        }

        function closeNotification(button) {
            const notification = button.closest('.notification');
            notification.style.animation = 'notificationFadeOut 0.3s ease-out forwards';

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }
    </script>
</body>
</html>