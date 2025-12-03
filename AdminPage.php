<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include 'DBconnect.php';

// Get statistics
$doctorCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctor"));
$clinicCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM clinic"));
$bookingCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM booking"));
$patientCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM patient"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .dashboard-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dashboard-grid" x="0" y="0" width="25" height="25" patternUnits="userSpaceOnUse"><path d="M 25 0 L 0 0 0 25" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23dashboard-grid)"/></svg>');
            opacity: 0.3;
        }

        .dashboard-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 2;
        }

        .admin-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-brand h1 {
            color: var(--pure-white);
            margin: 0;
            font-size: 2.5rem;
        }

        .admin-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--pure-white);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow-medium);
            border: 1px solid rgba(37, 99, 235, 0.1);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-large);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.doctors { background: linear-gradient(135deg, var(--primary-blue), var(--light-blue)); color: white; }
        .stat-icon.clinics { background: linear-gradient(135deg, var(--success-green), #059669); color: white; }
        .stat-icon.bookings { background: linear-gradient(135deg, var(--warning-orange), #f97316); color: white; }
        .stat-icon.patients { background: linear-gradient(135deg, var(--error-red), #dc2626); color: white; }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--medium-gray);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.875rem;
        }

        .management-sections {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }

        .management-card {
            background: var(--pure-white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-medium);
            transition: var(--transition);
        }

        .management-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-large);
        }

        .management-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 1.5rem;
            position: relative;
        }

        .management-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="mgmt-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23mgmt-pattern)"/></svg>');
            opacity: 0.3;
        }

        .management-header h2 {
            margin: 0 0 0.5rem 0;
            font-size: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .management-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 0.9rem;
            position: relative;
            z-index: 2;
        }

        .management-body {
            padding: 1.5rem;
        }

        .management-actions {
            display: grid;
            gap: 0.75rem;
        }

        .action-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: #f8fafc;
            border-radius: 8px;
            text-decoration: none;
            color: var(--dark-gray);
            font-weight: 500;
            transition: var(--transition);
            border: 1px solid transparent;
        }

        .action-link:hover {
            background: var(--primary-blue);
            color: var(--pure-white);
            transform: translateX(5px);
        }

        .action-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .logout-section {
            background: var(--pure-white);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow-medium);
            margin-top: 2rem;
            text-align: center;
        }

        .admin-info {
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
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="dashboard-content">
                <div class="admin-title">
                    <div class="admin-brand">
                        <i class="fas fa-hospital-alt" style="font-size: 3rem;"></i>
                        <div>
                            <h1>Admin Dashboard</h1>
                            <div class="admin-badge">
                                <i class="fas fa-shield-alt"></i> Secure Admin Access
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-content">
            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value"><?php echo $doctorCount; ?></div>
                            <div class="stat-label">Active Doctors</div>
                        </div>
                        <div class="stat-icon doctors">
                            <i class="fas fa-user-md"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value"><?php echo $clinicCount; ?></div>
                            <div class="stat-label">Registered Clinics</div>
                        </div>
                        <div class="stat-icon clinics">
                            <i class="fas fa-hospital"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value"><?php echo $bookingCount; ?></div>
                            <div class="stat-label">Total Appointments</div>
                        </div>
                        <div class="stat-icon bookings">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-value"><?php echo $patientCount; ?></div>
                            <div class="stat-label">Registered Patients</div>
                        </div>
                        <div class="stat-icon patients">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Management Sections -->
            <div class="management-sections">
                <!-- Doctor Management -->
                <div class="management-card">
                    <div class="management-header">
                        <h2><i class="fas fa-user-md"></i> Doctor Management</h2>
                        <p>Manage medical professionals and their schedules</p>
                    </div>
                    <div class="management-body">
                        <div class="management-actions">
                            <a href="NewDoctor.php" class="action-link">
                                <i class="fas fa-plus-circle"></i>
                                <span>Add New Doctor</span>
                            </a>
                            <a href="ShowDoctor.php" class="action-link">
                                <i class="fas fa-list"></i>
                                <span>View All Doctors</span>
                            </a>
                            <a href="DeleteDoctor.php" class="action-link">
                                <i class="fas fa-trash"></i>
                                <span>Remove Doctor</span>
                            </a>
                            <a href="DoctorSchedule.php" class="action-link">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Manage Schedules</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Clinic Management -->
                <div class="management-card">
                    <div class="management-header">
                        <h2><i class="fas fa-hospital"></i> Clinic Management</h2>
                        <p>Oversee medical facilities and their operations</p>
                    </div>
                    <div class="management-body">
                        <div class="management-actions">
                            <a href="NewClinic.php" class="action-link">
                                <i class="fas fa-plus-circle"></i>
                                <span>Add New Clinic</span>
                            </a>
                            <a href="ShowClinic.php" class="action-link">
                                <i class="fas fa-list"></i>
                                <span>View All Clinics</span>
                            </a>
                            <a href="DeleteClinic.php" class="action-link">
                                <i class="fas fa-trash"></i>
                                <span>Remove Clinic</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Staff Assignment -->
                <div class="management-card">
                    <div class="management-header">
                        <h2><i class="fas fa-users-cog"></i> Staff Assignment</h2>
                        <p>Assign and manage staff across facilities</p>
                    </div>
                    <div class="management-body">
                        <div class="management-actions">
                            <a href="AddDoctorToClinic.php" class="action-link">
                                <i class="fas fa-user-plus"></i>
                                <span>Assign Doctor to Clinic</span>
                            </a>
                            <a href="DeleteDoctorFromClinic.php" class="action-link">
                                <i class="fas fa-user-minus"></i>
                                <span>Remove Doctor from Clinic</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Appointment Management -->
                <div class="management-card">
                    <div class="management-header">
                        <h2><i class="fas fa-calendar-check"></i> Appointment Management</h2>
                        <p>View and manage all patient appointments</p>
                    </div>
                    <div class="management-body">
                        <div class="management-actions">
                            <a href="AdminAppointments.php" class="action-link">
                                <i class="fas fa-list"></i>
                                <span>View All Appointments</span>
                            </a>
                            <a href="AdminAppointments.php" class="action-link">
                                <i class="fas fa-edit"></i>
                                <span>Update Appointment Status</span>
                            </a>
                            <a href="#" class="action-link" onclick="alert('Export feature coming soon!')">
                                <i class="fas fa-download"></i>
                                <span>Export Appointments</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Management -->
                <div class="management-card">
                    <div class="management-header">
                        <h2><i class="fas fa-cogs"></i> System Settings</h2>
                        <p>Configure system preferences and settings</p>
                    </div>
                    <div class="management-body">
                        <div class="management-actions">
                            <a href="DatabaseManagement.php" class="action-link">
                                <i class="fas fa-database"></i>
                                <span>Database Management</span>
                            </a>
                            <a href="#" class="action-link" onclick="alert('Feature coming soon!')">
                                <i class="fas fa-chart-line"></i>
                                <span>System Analytics</span>
                            </a>
                            <a href="#" class="action-link" onclick="alert('Feature coming soon!')">
                                <i class="fas fa-bell"></i>
                                <span>Notifications</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logout Section -->
            <div class="logout-section">
                <div class="admin-info">
                    <i class="fas fa-user-shield"></i>
                    <span>Logged in as Administrator</span>
                </div>
                <form method="POST" action="adminlogin.php">
                    <button type="submit" name="logout" class="btn btn-danger" style="background: linear-gradient(135deg, var(--error-red), #dc2626);">
                        <i class="fas fa-sign-out-alt"></i>
                        Secure Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Dashboard animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stat cards
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });

            // Animate management cards
            const managementCards = document.querySelectorAll('.management-card');
            managementCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 800 + (index * 200));
            });

            // Add hover effects to stat cards
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const icon = this.querySelector('.stat-icon');
                    icon.style.transform = 'scale(1.1) rotate(5deg)';
                    icon.style.transition = 'transform 0.3s ease';
                });

                card.addEventListener('mouseleave', function() {
                    const icon = this.querySelector('.stat-icon');
                    icon.style.transform = 'scale(1) rotate(0deg)';
                });
            });
        });

        // Add loading animation for actions
        document.querySelectorAll('.action-link').forEach(link => {
            link.addEventListener('click', function(e) {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Loading...</span>';
                this.style.pointerEvents = 'none';

                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.style.pointerEvents = 'auto';
                }, 1000);
            });
        });
    </script>
</body>
</html>