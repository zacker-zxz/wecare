<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Appointment - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .cancel-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .cancel-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cancel-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="cancel-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23cancel-grid)"/></svg>');
            opacity: 0.3;
        }

        .cancel-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .cancel-card {
            background: var(--pure-white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-large);
            position: relative;
        }

        .card-header {
            background: linear-gradient(135deg, var(--error-red), #dc2626);
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="cancel-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23cancel-pattern)"/></svg>');
            opacity: 0.3;
        }

        .card-header h1 {
            color: var(--pure-white);
            margin: 0 0 0.5rem 0;
            font-size: 2rem;
            position: relative;
            z-index: 2;
        }

        .card-header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
            font-size: 1rem;
            position: relative;
            z-index: 2;
        }

        .card-body {
            padding: 3rem 2rem;
        }

        .warning-notice {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1));
            border: 1px solid rgba(245, 158, 11, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .warning-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--warning-orange), #f97316);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--pure-white);
            flex-shrink: 0;
        }

        .warning-content h4 {
            color: var(--warning-orange);
            margin: 0 0 0.5rem 0;
            font-size: 1.1rem;
        }

        .warning-content p {
            color: var(--medium-gray);
            margin: 0;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            display: block;
            margin-bottom: 1rem;
            font-weight: 600;
            color: var(--dark-gray);
            font-size: 1.1rem;
        }

        .appointment-select {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            background: var(--pure-white);
            transition: var(--transition);
            max-height: 200px;
            overflow-y: auto;
        }

        .appointment-select:focus {
            outline: none;
            border-color: var(--error-red);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .appointment-option {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: var(--transition);
        }

        .appointment-option:hover {
            background: rgba(239, 68, 68, 0.05);
        }

        .appointment-option:last-child {
            border-bottom: none;
        }

        .appointment-details {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .appointment-info h5 {
            color: var(--primary-blue);
            margin: 0 0 0.5rem 0;
            font-size: 1rem;
        }

        .appointment-info p {
            margin: 0.25rem 0;
            color: var(--medium-gray);
            font-size: 0.9rem;
        }

        .appointment-meta {
            text-align: right;
            color: var(--medium-gray);
            font-size: 0.8rem;
        }

        .no-appointments {
            text-align: center;
            padding: 3rem 2rem;
            background: #f8fafc;
            border-radius: 12px;
            border: 2px dashed #e2e8f0;
        }

        .no-appointments i {
            font-size: 3rem;
            color: var(--medium-gray);
            margin-bottom: 1rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            background: rgba(37, 99, 235, 0.05);
            transition: var(--transition);
            margin-bottom: 2rem;
        }

        .back-link:hover {
            background: rgba(37, 99, 235, 0.1);
            transform: translateX(-2px);
        }

        @media (max-width: 768px) {
            .appointment-details {
                flex-direction: column;
                align-items: stretch;
            }

            .appointment-meta {
                text-align: left;
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="cancel-container">
        <div class="cancel-header">
            <div class="cancel-content" style="position: relative; z-index: 2;">
                <h1><i class="fas fa-calendar-times"></i> Cancel Appointment</h1>
                <p>Select the appointment you wish to cancel</p>
            </div>
        </div>

        <div class="cancel-content">
            <a href="Login.php" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>

            <div class="cancel-card">
                <div class="card-header">
                    <h1><i class="fas fa-exclamation-triangle"></i> Appointment Cancellation</h1>
                    <p>Please select the appointment you want to cancel from the list below</p>
                </div>

                <div class="card-body">
                    <div class="warning-notice">
                        <div class="warning-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="warning-content">
                            <h4>Important Notice</h4>
                            <p>Cancelling an appointment cannot be undone. Please make sure you want to proceed with the cancellation. If you need to reschedule, please book a new appointment instead.</p>
                        </div>
                    </div>

                    <?php $conn = mysqli_connect('localhost','root','','appointment'); ?>

                    <form action="CancelBooking.php" method="POST">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-list"></i>
                                Select Your Appointment to Cancel
                            </label>

                            <select name="Appointment" id="Appointment-list" class="appointment-select" required>
                                <option value="">Select My Appointment</option>
                                <?php
                                session_start();
                                $username = $_SESSION['username'];
                                $date = date('Y-m-d');
                                $sql1 = "SELECT * FROM booking WHERE username='" . $username . "' AND status NOT LIKE 'Cancelled by Patient' AND DOV >= '" . $date . "'";
                                $results = $conn->query($sql1);

                                while($rs = $results->fetch_assoc()) {
                                    $sql2 = "SELECT * FROM doctor WHERE DID=" . $rs["DID"];
                                    $results2 = $conn->query($sql2);
                                    $rs2 = $results2->fetch_assoc();

                                    $sql3 = "SELECT * FROM clinic WHERE CID=" . $rs["CID"];
                                    $results3 = $conn->query($sql3);
                                    $rs3 = $results3->fetch_assoc();
                                ?>
                                <option value="<?php echo $rs["Timestamp"]; ?>">
                                    Patient: <?php echo $rs["Fname"]; ?> |
                                    Date: <?php echo $rs["DOV"]; ?> |
                                    Dr. <?php echo $rs2["name"]; ?> |
                                    Clinic: <?php echo $rs3["name"]; ?> |
                                    Town: <?php echo $rs3["town"]; ?> |
                                    Booked: <?php echo $rs["Timestamp"]; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="action-buttons">
                            <button type="submit" name="submit" class="btn btn-danger" style="background: linear-gradient(135deg, var(--error-red), #dc2626);">
                                <i class="fas fa-times-circle"></i>
                                Cancel Appointment
                            </button>
                        </div>
                    </form>

                    <?php
                    if(isset($_POST['submit'])) {
                        $username = $_SESSION['username'];
                        $timestamp = $_POST['Appointment'];
                        $updatequery = "UPDATE booking SET Status='Cancelled by Patient' WHERE username='$username' AND timestamp='$timestamp'";

                        if (mysqli_query($conn, $updatequery)) {
                            echo '<div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1)); border: 1px solid rgba(239, 68, 68, 0.2); color: var(--error-red); padding: 1.5rem; border-radius: 12px; margin-top: 2rem; text-align: center; font-weight: 600;">
                                    <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                                    Appointment cancelled successfully! You will be redirected to your dashboard.
                                  </div>';
                            echo '<script>
                                    setTimeout(function() {
                                        window.location.href = "Login.php";
                                    }, 3000);
                                  </script>';
                        } else {
                            echo '<div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1)); border: 1px solid rgba(239, 68, 68, 0.2); color: var(--error-red); padding: 1.5rem; border-radius: 12px; margin-top: 2rem; text-align: center; font-weight: 600;">
                                    <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                                    Error cancelling appointment: ' . mysqli_error($conn) . '
                                  </div>';
                        }
                    }

                    // Check if user has any appointments
                    $checkAppointments = "SELECT COUNT(*) as count FROM booking WHERE username='" . $username . "' AND status NOT LIKE 'Cancelled by Patient' AND DOV >= '" . $date . "'";
                    $result = $conn->query($checkAppointments);
                    $row = $result->fetch_assoc();

                    if ($row['count'] == 0 && !isset($_POST['submit'])) {
                        echo '<div class="no-appointments">
                                <i class="fas fa-calendar-times"></i>
                                <h3 style="color: var(--dark-gray); margin-bottom: 1rem;">No Active Appointments</h3>
                                <p style="color: var(--medium-gray); margin-bottom: 2rem;">
                                    You don\'t have any upcoming appointments that can be cancelled.
                                </p>
                                <a href="Booking.php" class="btn btn-primary">
                                    <i class="fas fa-plus-circle"></i> Book New Appointment
                                </a>
                              </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced form styling and animations
        document.addEventListener('DOMContentLoaded', function() {
            const selectElement = document.getElementById('Appointment-list');

            // Style the select options (fallback for browsers that don't support custom styling)
            selectElement.addEventListener('change', function() {
                if (this.value) {
                    this.style.borderColor = 'var(--error-red)';
                    this.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
                } else {
                    this.style.borderColor = '#e2e8f0';
                    this.style.boxShadow = 'none';
                }
            });

            // Add animation to the warning notice
            const warningNotice = document.querySelector('.warning-notice');
            if (warningNotice) {
                warningNotice.style.opacity = '0';
                warningNotice.style.transform = 'translateY(-10px)';
                warningNotice.style.transition = 'all 0.5s ease';

                setTimeout(() => {
                    warningNotice.style.opacity = '1';
                    warningNotice.style.transform = 'translateY(0)';
                }, 300);
            }

            // Add animation to the form
            const cancelCard = document.querySelector('.cancel-card');
            cancelCard.style.opacity = '0';
            cancelCard.style.transform = 'translateY(30px)';
            cancelCard.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

            setTimeout(() => {
                cancelCard.style.opacity = '1';
                cancelCard.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>