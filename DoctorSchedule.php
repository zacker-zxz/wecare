<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Schedules - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .schedule-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .schedule-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .schedule-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="schedule-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23schedule-grid)"/></svg>');
            opacity: 0.3;
        }

        .schedule-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .schedule-card {
            background: var(--pure-white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-large);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="schedule-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23schedule-pattern)"/></svg>');
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
            padding: 2rem;
        }

        .stats-section {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .stat-box {
            background: linear-gradient(135deg, var(--success-green), #059669);
            color: var(--pure-white);
            padding: 1.5rem 2rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: var(--shadow-medium);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--pure-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-medium);
        }

        .schedule-table th {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .schedule-table td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.9rem;
        }

        .schedule-table tr:hover {
            background: #f8fafc;
        }

        .clinic-badge {
            background: linear-gradient(135deg, var(--warning-orange), #f97316);
            color: var(--pure-white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .doctor-badge {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .day-badge {
            background: linear-gradient(135deg, var(--success-green), #059669);
            color: var(--pure-white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .time-badge {
            background: #f8fafc;
            color: var(--dark-gray);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 1px solid #e2e8f0;
            display: inline-block;
        }

        .card-footer {
            background: #f8fafc;
            padding: 2rem;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .no-data {
            text-align: center;
            padding: 3rem;
            color: var(--medium-gray);
        }

        .no-data i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .schedule-table {
                font-size: 0.8rem;
            }

            .schedule-table th,
            .schedule-table td {
                padding: 0.75rem 0.5rem;
            }

            .stats-section {
                gap: 1rem;
            }

            .stat-box {
                padding: 1rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="schedule-container">
        <div class="schedule-header">
            <div class="schedule-content">
                <div style="display: flex; align-items: center; justify-content: center; gap: 1rem;">
                    <i class="fas fa-calendar-alt" style="font-size: 2rem;"></i>
                    <h1>Doctor Schedules</h1>
                </div>
            </div>
        </div>

        <div class="schedule-content">
            <div class="schedule-card">
                <div class="card-header">
                    <h1><i class="fas fa-clock"></i> Complete Schedule Overview</h1>
                    <p>View all doctor availability schedules across clinics</p>
                </div>

                <div class="card-body">
                    <?php
                    include 'DBconnect.php';

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM doctor_available ORDER BY DID, CID ASC";
                    $result = mysqli_query($conn, $sql);
                    $totalSchedules = mysqli_num_rows($result);
                    ?>

                    <!-- Statistics -->
                    <div class="stats-section">
                        <div class="stat-box">
                            <span class="stat-number"><?php echo $totalSchedules; ?></span>
                            <span class="stat-label">Total Schedules</span>
                        </div>
                    </div>

                    <?php if ($totalSchedules > 0): ?>
                        <div style="overflow-x: auto;">
                            <table class="schedule-table">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-building"></i> Clinic ID</th>
                                        <th><i class="fas fa-hospital"></i> Clinic Details</th>
                                        <th><i class="fas fa-user-md"></i> Doctor ID</th>
                                        <th><i class="fas fa-user"></i> Doctor Name</th>
                                        <th><i class="fas fa-calendar-day"></i> Day</th>
                                        <th><i class="fas fa-clock"></i> Time Slot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    mysqli_data_seek($result, 0); // Reset result pointer
                                    while ($row = mysqli_fetch_array($result)) {
                                        $sql1 = "SELECT * FROM doctor WHERE DID=" . $row["DID"];
                                        $result1 = mysqli_query($conn, $sql1);
                                        $doctorName = "Unknown";

                                        if ($result1 && $row1 = mysqli_fetch_array($result1)) {
                                            $doctorName = $row1['name'];
                                        }

                                        $sql2 = "SELECT * FROM clinic WHERE CID=" . $row["CID"];
                                        $result2 = mysqli_query($conn, $sql2);
                                        $clinicName = "Unknown";
                                        $clinicTown = "Unknown";

                                        if ($result2 && $row2 = mysqli_fetch_array($result2)) {
                                            $clinicName = $row2['name'];
                                            $clinicTown = $row2['town'];
                                        }
                                    ?>
                                        <tr>
                                            <td>
                                                <span class="clinic-badge"><?php echo $row['CID']; ?></span>
                                            </td>
                                            <td>
                                                <strong><?php echo htmlspecialchars($clinicName); ?></strong><br>
                                                <small style="color: var(--medium-gray);"><?php echo htmlspecialchars($clinicTown); ?></small>
                                            </td>
                                            <td>
                                                <span class="doctor-badge"><?php echo $row['DID']; ?></span>
                                            </td>
                                            <td>
                                                <strong><?php echo htmlspecialchars($doctorName); ?></strong>
                                            </td>
                                            <td>
                                                <span class="day-badge"><?php echo htmlspecialchars($row['day']); ?></span>
                                            </td>
                                            <td>
                                                <span class="time-badge">
                                                    <?php echo date('h:i A', strtotime($row['starttime'])) . ' - ' . date('h:i A', strtotime($row['endtime'])); ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="no-data">
                            <i class="fas fa-calendar-times"></i>
                            <h3>No Schedules Found</h3>
                            <p>No doctor schedules have been assigned yet. Use the "Assign Doctor to Clinic" feature to create schedules.</p>
                        </div>
                    <?php endif; ?>

                    <?php mysqli_close($conn); ?>
                </div>

                <div class="card-footer">
                    <div class="action-buttons">
                        <a href="AddDoctorToClinic.php" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Schedule
                        </a>
                        <a href="AdminPage.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add animations and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate table rows
            const tableRows = document.querySelectorAll('.schedule-table tbody tr');
            tableRows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                row.style.transition = 'all 0.5s ease';

                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 50);
            });

            // Add hover effects to badges
            const badges = document.querySelectorAll('.clinic-badge, .doctor-badge, .day-badge, .time-badge');
            badges.forEach(badge => {
                badge.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                    this.style.transition = 'transform 0.2s ease';
                });

                badge.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>