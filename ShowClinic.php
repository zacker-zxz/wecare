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
    <title>All Clinics - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .clinic-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .clinic-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .clinic-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="clinic-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23clinic-grid)"/></svg>');
            opacity: 0.3;
        }

        .clinic-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .clinic-card {
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="clinic-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23clinic-pattern)"/></svg>');
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

        .clinic-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--pure-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-medium);
        }

        .clinic-table th {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .clinic-table td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.9rem;
        }

        .clinic-table tr:hover {
            background: #f8fafc;
        }

        .clinic-id-badge {
            background: linear-gradient(135deg, var(--warning-orange), #f97316);
            color: var(--pure-white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .clinic-name {
            font-weight: 600;
            color: var(--dark-blue);
        }

        .clinic-address {
            color: var(--medium-gray);
            font-size: 0.85rem;
        }

        .clinic-location {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .location-badge {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .contact-icon {
            color: var(--success-green);
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
            .clinic-table {
                font-size: 0.8rem;
            }

            .clinic-table th,
            .clinic-table td {
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
    <div class="clinic-container">
        <div class="clinic-header">
            <div class="clinic-content">
                <div style="display: flex; align-items: center; justify-content: center; gap: 1rem;">
                    <i class="fas fa-hospital" style="font-size: 2rem;"></i>
                    <h1>All Clinics</h1>
                </div>
            </div>
        </div>

        <div class="clinic-content">
            <div class="clinic-card">
                <div class="card-header">
                    <h1><i class="fas fa-building"></i> Registered Clinics</h1>
                    <p>Complete overview of all medical facilities in the system</p>
                </div>

                <div class="card-body">
                    <?php
                    include 'DBconnect.php';

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $query = "SELECT * FROM clinic ORDER BY name";
                    $result = mysqli_query($conn, $query);
                    $totalClinics = mysqli_num_rows($result);
                    ?>

                    <!-- Statistics -->
                    <div class="stats-section">
                        <div class="stat-box">
                            <span class="stat-number"><?php echo $totalClinics; ?></span>
                            <span class="stat-label">Total Clinics</span>
                        </div>
                    </div>

                    <?php if ($totalClinics > 0): ?>
                        <div style="overflow-x: auto;">
                            <table class="clinic-table">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-hashtag"></i> Clinic ID</th>
                                        <th><i class="fas fa-hospital"></i> Clinic Name</th>
                                        <th><i class="fas fa-map-marker-alt"></i> Address</th>
                                        <th><i class="fas fa-city"></i> Location</th>
                                        <th><i class="fas fa-phone"></i> Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    mysqli_data_seek($result, 0); // Reset result pointer
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <span class="clinic-id-badge"><?php echo htmlspecialchars($row['CID']); ?></span>
                                            </td>
                                            <td>
                                                <div class="clinic-name"><?php echo htmlspecialchars($row['name']); ?></div>
                                            </td>
                                            <td>
                                                <div class="clinic-address"><?php echo htmlspecialchars($row['address']); ?></div>
                                            </td>
                                            <td>
                                                <div class="clinic-location">
                                                    <span class="location-badge"><?php echo htmlspecialchars($row['town']); ?></span>
                                                    <small style="color: var(--medium-gray); margin-top: 0.25rem; display: block;">
                                                        <?php echo htmlspecialchars($row['city']); ?>
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="contact-info">
                                                    <i class="fas fa-phone contact-icon"></i>
                                                    <span><?php echo htmlspecialchars($row['contact']); ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="no-data">
                            <i class="fas fa-hospital"></i>
                            <h3>No Clinics Found</h3>
                            <p>No clinics have been registered in the system yet. Use the "Add New Clinic" feature to register medical facilities.</p>
                        </div>
                    <?php endif; ?>

                    <?php mysqli_close($conn); ?>
                </div>

                <div class="card-footer">
                    <div class="action-buttons">
                        <a href="NewClinic.php" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Clinic
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
            const tableRows = document.querySelectorAll('.clinic-table tbody tr');
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
            const badges = document.querySelectorAll('.clinic-id-badge, .location-badge');
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