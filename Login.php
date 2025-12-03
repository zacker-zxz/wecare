<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: Home.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: Home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .patient-dashboard {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 50%, var(--dark-blue) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .patient-dashboard::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="patient-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23patient-grid)"/></svg>');
            opacity: 0.3;
        }

        .patient-card {
            background: var(--pure-white);
            border-radius: 20px;
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(37, 99, 235, 0.1);
            overflow: hidden;
            max-width: 95vw;
            width: 100%;
            min-height: 80vh;
            position: relative;
            z-index: 10;
        }

        .patient-header {
            background: linear-gradient(135deg, var(--success-green), #059669);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
        }

        .patient-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="patient-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23patient-pattern)"/></svg>');
            opacity: 0.3;
        }

        .patient-header h1 {
            color: var(--pure-white);
            margin: 0 0 0.5rem 0;
            font-size: 2.5rem;
            position: relative;
            z-index: 2;
        }

        .patient-header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
            font-size: 1.1rem;
            position: relative;
            z-index: 2;
        }

        .patient-icon {
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

        .patient-icon i {
            font-size: 2.5rem;
            color: var(--pure-white);
        }

        .patient-body {
            padding: 3rem 2rem;
        }

        .welcome-message {
            text-align: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-radius: 12px;
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .welcome-message h2 {
            color: var(--primary-blue);
            margin: 0 0 0.5rem 0;
            font-size: 1.5rem;
        }

        .welcome-message p {
            color: var(--dark-gray);
            margin: 0;
            font-size: 1rem;
        }

        .patient-actions {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            gap: 2rem;
            justify-content: space-around;
            align-items: stretch;
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .action-card {
            background: var(--pure-white);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            box-shadow: var(--shadow-medium);
            border: 2px solid rgba(37, 99, 235, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
            position: relative;
            overflow: hidden;
            flex: 1;
            min-width: 280px;
            max-width: 350px;
            height: 320px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
        }

        .action-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(37, 99, 235, 0.2);
            border-color: var(--primary-blue);
        }

        .action-icon {
            width: 100px;
            height: 100px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2.5rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-light);
        }

        .action-card:hover .action-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: var(--shadow-medium);
        }

        .action-card:nth-child(1) .action-icon {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: white;
        }

        .action-card:nth-child(2) .action-icon {
            background: linear-gradient(135deg, var(--success-green), #059669);
            color: white;
        }

        .action-card:nth-child(3) .action-icon {
            background: linear-gradient(135deg, var(--warning-orange), #f97316);
            color: white;
        }

        .action-card:nth-child(4) .action-icon {
            background: linear-gradient(135deg, var(--error-red), #dc2626);
            color: white;
        }

        .action-card h3 {
            margin: 0 0 0.5rem 0;
            color: var(--dark-blue);
            font-size: 1.25rem;
        }

        .action-card p {
            margin: 0 0 1.5rem 0;
            color: var(--medium-gray);
            font-size: 0.9rem;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .logout-section {
            background: #f8fafc;
            padding: 2rem;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            margin-top: 2rem;
        }

        .patient-info {
            background: linear-gradient(135deg, var(--success-green), #059669);
            color: var(--pure-white);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        @media (max-width: 1200px) {
            .patient-actions {
                gap: 1rem;
                padding: 0 0.5rem;
            }

            .action-card {
                min-width: 220px;
                max-width: 260px;
                height: 260px;
                padding: 1.5rem 1rem;
            }

            .action-icon {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }
        }

        @media (max-width: 1024px) {
            .patient-actions {
                gap: 0.8rem;
                padding: 0 0.5rem;
            }

            .action-card {
                min-width: 200px;
                max-width: 240px;
                height: 240px;
                padding: 1.5rem 1rem;
            }

            .action-icon {
                width: 65px;
                height: 65px;
                font-size: 1.6rem;
            }
        }

        @media (max-width: 900px) {
            .patient-actions {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }

            .action-card {
                flex: 0 1 calc(50% - 1rem);
                min-width: 200px;
                max-width: none;
                height: 220px;
                padding: 1.5rem 1rem;
            }
        }

        @media (max-width: 640px) {
            .patient-actions {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }

            .action-card {
                flex: none;
                width: 100%;
                max-width: 400px;
                height: 200px;
                padding: 2rem 1.5rem;
            }

            .action-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .patient-header h1 {
                font-size: 2rem;
            }

            .patient-body {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="patient-dashboard">
        <div class="patient-card">
            <div class="patient-header">
                <div class="patient-icon">
                    <i class="fas fa-user-injured"></i>
                </div>
                <h1>Patient Dashboard</h1>
                <p>Welcome to your healthcare management portal</p>
            </div>

            <div class="patient-body">
                <div class="welcome-message">
                    <h2><i class="fas fa-heartbeat"></i> Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                    <p>Manage your healthcare appointments and access medical services with ease.</p>
                </div>

                <div class="patient-actions">
                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <h3>Book Appointment</h3>
                        <p>Schedule appointments with available doctors and clinics</p>
                        <a href="Booking.php" class="action-button">
                            <i class="fas fa-plus"></i> Book Now
                        </a>
                    </div>

                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3>View Appointments</h3>
                        <p>Check your upcoming and past appointment details</p>
                        <a href="PatientsAppointment.php" class="action-button">
                            <i class="fas fa-eye"></i> View Appointments
                        </a>
                    </div>

                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <h3>Cancel Appointment</h3>
                        <p>Cancel or reschedule your existing appointments</p>
                        <a href="CancelBooking.php" class="action-button">
                            <i class="fas fa-times"></i> Cancel Booking
                        </a>
                    </div>

                    <div class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Find Doctors</h3>
                        <p>Search for doctors by specialization and location</p>
                        <a href="getdoctor.php" class="action-button">
                            <i class="fas fa-search"></i> Find Doctors
                        </a>
                    </div>
                </div>
            </div>

            <div class="logout-section">
                <div class="patient-info">
                    <i class="fas fa-user-check"></i>
                    <span>Logged in as Patient</span>
                </div>
                <form method="POST" action="">
                    <button type="submit" name="logout" class="action-button" style="background: linear-gradient(135deg, var(--error-red), #dc2626);">
                        <i class="fas fa-sign-out-alt"></i>
                        Secure Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate action cards
            const actionCards = document.querySelectorAll('.action-card');
            actionCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });

            // Add hover effects to action buttons
            const actionButtons = document.querySelectorAll('.action-button');
            actionButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.02)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Animate patient card entrance
            const patientCard = document.querySelector('.patient-card');
            patientCard.style.opacity = '0';
            patientCard.style.transform = 'translateY(50px) scale(0.9)';
            patientCard.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

            setTimeout(() => {
                patientCard.style.opacity = '1';
                patientCard.style.transform = 'translateY(0) scale(1)';
            }, 100);
        });
    </script>
</body>
</html>