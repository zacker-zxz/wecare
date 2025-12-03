<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: Home.php");
    exit();
}

include 'DBconnect.php';
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .appointments-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .appointments-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .appointments-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="appointments-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23appointments-grid)"/></svg>');
            opacity: 0.3;
        }

        .appointments-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .welcome-section {
            background: var(--pure-white);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-medium);
            margin-bottom: 2rem;
            text-align: center;
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .appointment-card {
            background: var(--pure-white);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-medium);
            border: 1px solid rgba(37, 99, 235, 0.1);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .appointment-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-large);
        }

        .appointment-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
        }

        .appointment-status {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-pending {
            background: linear-gradient(135deg, var(--warning-orange), #f97316);
            color: var(--pure-white);
        }

        .status-confirmed {
            background: linear-gradient(135deg, var(--success-green), #059669);
            color: var(--pure-white);
        }

        .status-cancelled {
            background: linear-gradient(135deg, var(--error-red), #dc2626);
            color: var(--pure-white);
        }

        .appointment-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .appointment-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .info-icon.doctor { background: linear-gradient(135deg, var(--primary-blue), var(--light-blue)); color: white; }
        .info-icon.clinic { background: linear-gradient(135deg, var(--success-green), #059669); color: white; }
        .info-icon.date { background: linear-gradient(135deg, var(--warning-orange), #f97316); color: white; }
        .info-icon.time { background: linear-gradient(135deg, var(--error-red), #dc2626); color: white; }

        .info-content h4 {
            margin: 0 0 0.25rem 0;
            color: var(--dark-gray);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .info-content p {
            margin: 0;
            color: var(--medium-gray);
            font-size: 1rem;
            font-weight: 500;
        }

        .no-appointments {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--pure-white);
            border-radius: 16px;
            box-shadow: var(--shadow-medium);
        }

        .no-appointments i {
            font-size: 4rem;
            color: var(--medium-gray);
            margin-bottom: 1rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            transition: var(--transition);
            margin-top: 2rem;
        }

        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        @media (max-width: 768px) {
            .appointment-info {
                grid-template-columns: 1fr;
            }

            .appointment-header {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>
    <div class="appointments-container">
        <div class="appointments-header">
            <div class="appointments-content" style="position: relative; z-index: 2;">
                <h1><i class="fas fa-calendar-check"></i> My Appointments</h1>
                <p>View and manage all your scheduled appointments</p>
            </div>
        </div>

        <div class="appointments-content">
            <div class="welcome-section">
                <h2><i class="fas fa-user-md"></i> Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                <p>Here are all your appointments. You can view details, track status, and manage your healthcare schedule.</p>
            </div>

            <?php
            // Query to get user's appointments
            $query = "SELECT b.*, d.name as doctor_name, d.specialisation, c.name as clinic_name, c.address, c.town, c.city
                     FROM booking b
                     JOIN doctor d ON b.DID = d.DID
                     JOIN clinic c ON b.CID = c.CID
                     WHERE b.username = '$username'
                     ORDER BY b.DOV DESC, b.Timestamp DESC";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Determine status class
                    $statusClass = 'status-pending';
                    if (strpos(strtolower($row['Status']), 'confirmed') !== false || strpos(strtolower($row['Status']), 'approved') !== false) {
                        $statusClass = 'status-confirmed';
                    } elseif (strpos(strtolower($row['Status']), 'cancelled') !== false) {
                        $statusClass = 'status-cancelled';
                    }
                    ?>

                    <div class="appointment-card">
                        <div class="appointment-status <?php echo $statusClass; ?>">
                            <?php echo htmlspecialchars($row['Status']); ?>
                        </div>

                        <div class="appointment-header">
                            <div>
                                <h3 style="margin: 0 0 0.5rem 0; color: var(--primary-blue);">
                                    <i class="fas fa-calendar-day"></i> Appointment Details
                                </h3>
                                <p style="margin: 0; color: var(--medium-gray);">
                                    Booked on: <?php echo date('F j, Y \a\t g:i A', strtotime($row['Timestamp'])); ?>
                                </p>
                            </div>
                        </div>

                        <div class="appointment-info">
                            <div class="info-item">
                                <div class="info-icon doctor">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Doctor</h4>
                                    <p><?php echo htmlspecialchars($row['doctor_name']); ?></p>
                                    <small style="color: var(--medium-gray);"><?php echo htmlspecialchars($row['specialisation']); ?></small>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon clinic">
                                    <i class="fas fa-hospital"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Clinic</h4>
                                    <p><?php echo htmlspecialchars($row['clinic_name']); ?></p>
                                    <small style="color: var(--medium-gray);"><?php echo htmlspecialchars($row['town']) . ', ' . htmlspecialchars($row['city']); ?></small>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon date">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Appointment Date</h4>
                                    <p><?php echo date('l, F j, Y', strtotime($row['DOV'])); ?></p>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon time">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Patient Details</h4>
                                    <p><?php echo htmlspecialchars($row['Fname']); ?> (<?php echo htmlspecialchars($row['gender']); ?>)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else {
                ?>
                <div class="no-appointments">
                    <i class="fas fa-calendar-times"></i>
                    <h3 style="color: var(--dark-gray); margin-bottom: 1rem;">No Appointments Found</h3>
                    <p style="color: var(--medium-gray); margin-bottom: 2rem;">
                        You haven't booked any appointments yet. Start by booking your first appointment with one of our qualified doctors.
                    </p>
                    <a href="Booking.php" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Book Your First Appointment
                    </a>
                </div>
                <?php
            }

            mysqli_close($conn);
            ?>

            <div style="text-align: center;">
                <a href="Login.php" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <script>
        // Add animations when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const appointmentCards = document.querySelectorAll('.appointment-card');
            appointmentCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>
</body>
</html>