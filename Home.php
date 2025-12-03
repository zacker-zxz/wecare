<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeCare - Professional Online Appointment System</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Purple Floating Particles Animation */
        .particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            box-shadow:
                0 0 8px rgba(255, 255, 255, 1),
                0 0 16px rgba(255, 255, 255, 0.8),
                0 0 24px rgba(255, 255, 255, 0.6),
                0 0 32px rgba(255, 255, 255, 0.4);
            animation: randomFloat 15s infinite ease-in-out;
        }

        .particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 6px; height: 6px; left: 20%; animation-delay: -2s; }
        .particle:nth-child(3) { width: 3px; height: 3px; left: 30%; animation-delay: -4s; }
        .particle:nth-child(4) { width: 5px; height: 5px; left: 40%; animation-delay: -6s; }
        .particle:nth-child(5) { width: 4px; height: 4px; left: 50%; animation-delay: -8s; }
        .particle:nth-child(6) { width: 7px; height: 7px; left: 60%; animation-delay: -10s; }
        .particle:nth-child(7) { width: 3px; height: 3px; left: 70%; animation-delay: -12s; }
        .particle:nth-child(8) { width: 5px; height: 5px; left: 80%; animation-delay: -14s; }
        .particle:nth-child(9) { width: 4px; height: 4px; left: 90%; animation-delay: -16s; }
        .particle:nth-child(10) { width: 6px; height: 6px; left: 15%; animation-delay: -18s; }
        .particle:nth-child(11) { width: 3px; height: 3px; left: 25%; animation-delay: -20s; }
        .particle:nth-child(12) { width: 5px; height: 5px; left: 35%; animation-delay: -22s; }
        .particle:nth-child(13) { width: 4px; height: 4px; left: 45%; animation-delay: -24s; }
        .particle:nth-child(14) { width: 6px; height: 6px; left: 55%; animation-delay: -26s; }
        .particle:nth-child(15) { width: 3px; height: 3px; left: 65%; animation-delay: -28s; }
        .particle:nth-child(16) { width: 5px; height: 5px; left: 75%; animation-delay: -30s; }
        .particle:nth-child(17) { width: 4px; height: 4px; left: 85%; animation-delay: -32s; }
        .particle:nth-child(18) { width: 7px; height: 7px; left: 5%; animation-delay: -34s; }
        .particle:nth-child(19) { width: 3px; height: 3px; left: 95%; animation-delay: -36s; }
        .particle:nth-child(20) { width: 5px; height: 5px; left: 12%; animation-delay: -38s; }

        @keyframes randomFloat {
            0% {
                transform: translateY(100vh) translateX(0px) rotate(0deg) scale(0.8);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
                transform: translateY(80vh) translateX(20px) rotate(45deg) scale(1);
            }
            25% {
                transform: translateY(60vh) translateX(-15px) rotate(90deg) scale(1.2);
            }
            40% {
                transform: translateY(40vh) translateX(25px) rotate(135deg) scale(0.9);
            }
            60% {
                transform: translateY(20vh) translateX(-10px) rotate(180deg) scale(1.1);
            }
            80% {
                opacity: 0.6;
                transform: translateY(10vh) translateX(15px) rotate(270deg) scale(0.8);
            }
            90% {
                opacity: 0.4;
            }
            100% {
                transform: translateY(-20px) translateX(0px) rotate(360deg) scale(0.5);
                opacity: 0;
            }
        }

        /* Additional white particles with different sizes and speeds */
        .particle-large {
            position: absolute;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50%;
            box-shadow:
                0 0 12px rgba(255, 255, 255, 1),
                0 0 24px rgba(255, 255, 255, 0.9),
                0 0 36px rgba(255, 255, 255, 0.7);
            animation: randomFloatLarge 20s infinite ease-in-out;
        }

        .particle-large:nth-child(1) { width: 8px; height: 8px; left: 8%; animation-delay: -5s; }
        .particle-large:nth-child(2) { width: 10px; height: 10px; left: 28%; animation-delay: -10s; }
        .particle-large:nth-child(3) { width: 6px; height: 6px; left: 48%; animation-delay: -15s; }
        .particle-large:nth-child(4) { width: 9px; height: 9px; left: 68%; animation-delay: -20s; }
        .particle-large:nth-child(5) { width: 7px; height: 7px; left: 88%; animation-delay: -25s; }

        @keyframes randomFloatLarge {
            0% {
                transform: translateY(110vh) translateX(0px) rotate(0deg) scale(0.3);
                opacity: 0;
            }
            15% {
                opacity: 0.9;
                transform: translateY(85vh) translateX(-30px) rotate(-30deg) scale(0.8);
            }
            35% {
                transform: translateY(60vh) translateX(40px) rotate(60deg) scale(1.2);
            }
            55% {
                transform: translateY(35vh) translateX(-20px) rotate(120deg) scale(0.9);
            }
            75% {
                opacity: 0.7;
                transform: translateY(15vh) translateX(35px) rotate(180deg) scale(1.1);
            }
            85% {
                opacity: 0.5;
            }
            100% {
                transform: translateY(-15vh) translateX(0px) rotate(240deg) scale(0.4);
                opacity: 0;
            }
        }

        /* White glow particles */
        .particle-glow {
            position: absolute;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.6) 0%, rgba(255, 255, 255, 0.3) 50%, rgba(255, 255, 255, 0.1) 70%, transparent 100%);
            border-radius: 50%;
            animation: randomGlowFloat 25s infinite ease-in-out;
        }

        .particle-glow:nth-child(1) { width: 20px; height: 20px; left: 15%; animation-delay: -3s; }
        .particle-glow:nth-child(2) { width: 25px; height: 25px; left: 35%; animation-delay: -8s; }
        .particle-glow:nth-child(3) { width: 18px; height: 18px; left: 55%; animation-delay: -13s; }
        .particle-glow:nth-child(4) { width: 22px; height: 22px; left: 75%; animation-delay: -18s; }
        .particle-glow:nth-child(5) { width: 16px; height: 16px; left: 95%; animation-delay: -23s; }

        @keyframes randomGlowFloat {
            0% {
                transform: translateY(100vh) translateX(0px) scale(0.5) rotate(0deg);
                opacity: 0;
            }
            20% {
                opacity: 0.7;
                transform: translateY(80vh) translateX(25px) scale(1) rotate(45deg);
            }
            40% {
                transform: translateY(60vh) translateX(-20px) scale(1.3) rotate(90deg);
            }
            60% {
                opacity: 0.9;
                transform: translateY(40vh) translateX(30px) scale(0.8) rotate(135deg);
            }
            80% {
                opacity: 0.6;
                transform: translateY(20vh) translateX(-15px) scale(1.1) rotate(180deg);
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-10vh) translateX(0px) scale(0.3) rotate(225deg);
                opacity: 0;
            }
        }

        /* Ensure content stays above particles */
        .nav-container,
        .hero,
        .health-info,
        .services,
        .health-tips,
        footer {
            position: relative;
            z-index: 10;
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

        /* Health Tips Zoom Animation */
        .health-tip-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .health-tip-card:hover {
            transform: scale(1.05) translateY(-5px);
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(37, 99, 235, 0.1);
        }

        .health-tip-card:hover i {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }

        .health-tip-card:hover h4 {
            color: var(--primary-blue) !important;
            transition: color 0.3s ease;
        }
    </style>
</head>
<body>
    <!-- Notification Container -->
    <div id="notificationContainer"></div>

    <!-- Navigation Header -->
    <nav class="nav-container">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 2rem;">
            <a href="Home.php" class="nav-brand">
                <i class="fas fa-hospital-alt"></i>
                <span>WeCare</span>
            </a>
            <ul class="nav-menu">
                <li><a href="#services" class="nav-link">Services</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
                <li><a href="adminlogin.php" class="nav-link">Admin</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" style="background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue)); min-height: 100vh; display: flex; align-items: center; position: relative; overflow: hidden;">
        <!-- White Floating Particles Background (only in hero section) -->
        <div class="particles-container" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1;">
            <!-- Small white particles -->
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>

            <!-- Large white particles -->
            <div class="particle-large"></div>
            <div class="particle-large"></div>
            <div class="particle-large"></div>
            <div class="particle-large"></div>
            <div class="particle-large"></div>

            <!-- Glowing white particles -->
            <div class="particle-glow"></div>
            <div class="particle-glow"></div>
            <div class="particle-glow"></div>
            <div class="particle-glow"></div>
            <div class="particle-glow"></div>
        </div>

        <div class="hero-content" style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; width: 100%; position: relative; z-index: 2;">
            <h1>Advanced Healthcare at Your Fingertips</h1>
            <p>Book appointments with top medical professionals instantly. Experience seamless healthcare management with our cutting-edge online platform.</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <button class="btn btn-neon" onclick="openModal('loginModal')">
                    <i class="fas fa-user-md"></i> Patient Login
                </button>
                <a href="signup.php" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> New Registration
                </a>
            </div>
        </div>
    </section>

    <!-- Health Information Section -->
    <section style="padding: 4rem 0; background: var(--light-gray);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <h2 style="text-align: center; margin-bottom: 3rem; font-size: 2.5rem;">
                <span class="gradient-text">Your Health is Our Priority</span>
            </h2>
            
            <div class="health-info">
                <div class="health-card">
                    <div class="icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Cardiovascular Health</h3>
                    <p>Regular check-ups with our cardiologists can help prevent heart disease. Our advanced monitoring systems ensure continuous heart health tracking for early detection of potential issues.</p>
                </div>
                
                <div class="health-card">
                    <div class="icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>Mental Wellness</h3>
                    <p>Mental health matters. Our network of certified psychiatrists and psychologists provide comprehensive mental health support, from therapy sessions to crisis intervention.</p>
                </div>
                
                <div class="health-card">
                    <div class="icon">
                        <i class="fas fa-baby"></i>
                    </div>
                    <h3>Pediatric Care</h3>
                    <p>Specialized care for children from birth to adolescence. Our pediatricians are trained to handle everything from routine check-ups to complex childhood conditions.</p>
                </div>
                
                <div class="health-card">
                    <div class="icon">
                        <i class="fas fa-dna"></i>
                    </div>
                    <h3>Preventive Medicine</h3>
                    <p>Early detection saves lives. Our preventive care programs include regular screenings, vaccinations, and health assessments to catch potential health issues before they become serious.</p>
                </div>
                
                <div class="health-card">
                    <div class="icon">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <h3>Advanced Diagnostics</h3>
                    <p>State-of-the-art diagnostic equipment for accurate and rapid testing. From blood work to imaging studies, we provide comprehensive diagnostic services.</p>
                </div>
                
                <div class="health-card">
                    <div class="icon">
                        <i class="fas fa-procedures"></i>
                    </div>
                    <h3>Emergency Care</h3>
                    <p>24/7 emergency medical services with rapid response teams. Our emergency departments are equipped to handle critical situations with the latest medical technology.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" style="padding: 4rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <h2 style="text-align: center; margin-bottom: 3rem; font-size: 2.5rem;">
                <span class="gradient-text">Our Medical Services</span>
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <div class="card" style="text-align: center;">
                    <i class="fas fa-user-md" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                    <h3>General Consultation</h3>
                    <p>Comprehensive health assessments with experienced general practitioners for routine check-ups and health concerns.</p>
                </div>
                
                <div class="card" style="text-align: center;">
                    <i class="fas fa-x-ray" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                    <h3>Medical Imaging</h3>
                    <p>Advanced imaging services including X-rays, MRI, CT scans, and ultrasounds with rapid reporting.</p>
                </div>
                
                <div class="card" style="text-align: center;">
                    <i class="fas fa-pills" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                    <h3>Pharmacy Services</h3>
                    <p>In-house pharmacy with prescription medications, over-the-counter drugs, and medication counseling.</p>
                </div>
                
                <div class="card" style="text-align: center;">
                    <i class="fas fa-ambulance" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                    <h3>Emergency Services</h3>
                    <p>24/7 emergency medical care with specialized trauma teams and advanced life support systems.</p>
                </div>
                
                <div class="card" style="text-align: center;">
                    <i class="fas fa-syringe" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                    <h3>Vaccinations</h3>
                    <p>Complete vaccination programs for children, adults, and travelers with up-to-date immunization schedules.</p>
                </div>
                
                <div class="card" style="text-align: center;">
                    <i class="fas fa-dna" style="font-size: 3rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                    <h3>Laboratory Tests</h3>
                    <p>Comprehensive lab testing including blood work, urine analysis, and specialized diagnostic tests.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Health Tips Section -->
    <section style="padding: 4rem 0; background: var(--light-gray);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <h2 style="text-align: center; margin-bottom: 3rem; font-size: 2.5rem;">
                <span class="gradient-text">Daily Health Tips</span>
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                <div class="card health-tip-card" style="border-left: 4px solid var(--success-green);">
                    <i class="fas fa-walking" style="color: var(--success-green); margin-bottom: 1rem;"></i>
                    <h4>Stay Active</h4>
                    <p>Aim for 30 minutes of moderate exercise daily. Walking, swimming, or cycling can significantly improve your cardiovascular health.</p>
                </div>

                <div class="card health-tip-card" style="border-left: 4px solid var(--primary-blue);">
                    <i class="fas fa-apple-alt" style="color: var(--primary-blue); margin-bottom: 1rem;"></i>
                    <h4>Balanced Nutrition</h4>
                    <p>Include a variety of fruits, vegetables, lean proteins, and whole grains in your diet. Stay hydrated with 8 glasses of water daily.</p>
                </div>

                <div class="card health-tip-card" style="border-left: 4px solid var(--warning-orange);">
                    <i class="fas fa-moon" style="color: var(--warning-orange); margin-bottom: 1rem;"></i>
                    <h4>Quality Sleep</h4>
                    <p>Get 7-9 hours of quality sleep each night. Maintain a consistent sleep schedule and create a restful environment.</p>
                </div>

                <div class="card health-tip-card" style="border-left: 4px solid var(--error-red);">
                    <i class="fas fa-smile" style="color: var(--error-red); margin-bottom: 1rem;"></i>
                    <h4>Mental Health</h4>
                    <p>Practice stress management techniques like meditation or deep breathing. Don't hesitate to seek professional help when needed.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <div class="card-header">
                <h2 style="margin: 0; text-align: center;">Patient Login</h2>
            </div>
            <form method="POST" action="InsertLogin.php" style="padding: 2rem 0;">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="psw" class="form-label">Password</label>
                    <input type="password" id="psw" name="psw" class="form-control" required>
                </div>
                <div style="display: flex; gap: 1rem; justify-content: space-between; align-items: center;">
                    <button type="submit" name="login" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                    <a href="signup.php" class="btn btn-secondary">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background: var(--dark-blue); color: var(--pure-white); padding: 3rem 0; text-align: center;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <h3><i class="fas fa-hospital-alt"></i> WeCare</h3>
                    <p>Your trusted partner in healthcare. Providing quality medical services with compassion and excellence.</p>
                </div>
                <div>
                    <h4>Quick Links</h4>
                    <p><a href="Home.php" style="color: var(--pure-white); text-decoration: none;">Home</a></p>
                    <p><a href="signup.php" style="color: var(--pure-white); text-decoration: none;">Register</a></p>
                    <p><a href="adminlogin.php" style="color: var(--pure-white); text-decoration: none;">Admin</a></p>
                </div>
                <div>
                    <h4>Emergency</h4>
                    <p><i class="fas fa-phone"></i> 911</p>
                    <p><i class="fas fa-ambulance"></i> 24/7 Emergency</p>
                </div>
            </div>
            <div style="border-top: 1px solid var(--medium-gray); padding-top: 1rem;">
                <p>&copy; 2024 WeCare Online Appointment System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('loginModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add loading animation
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card, .health-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    card.style.transition = 'all 0.5s ease';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                }, index * 100);
            });

            // Check for login status and show notifications
            const urlParams = new URLSearchParams(window.location.search);
            const loginStatus = urlParams.get('login');

            if (loginStatus === 'error') {
                showNotification('error', 'Login Failed', 'Invalid username or password. Please check your credentials and try again.');
                // Clean URL
                history.replaceState(null, null, window.location.pathname);
            } else if (loginStatus === 'success') {
                showNotification('success', 'Login Successful', 'Welcome back! You have been successfully logged in.');
                // Clean URL
                history.replaceState(null, null, window.location.pathname);
            }
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