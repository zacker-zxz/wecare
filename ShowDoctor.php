<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Doctors - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .doctors-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="doctors-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23doctors-grid)"/></svg>');
            opacity: 0.3;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .doctors-card {
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="doctors-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23doctors-pattern)"/></svg>');
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
            padding: 0;
        }

        .doctors-table-container {
            padding: 2rem;
            overflow-x: auto;
        }

        .doctors-table {
            width: 100%;
            border-collapse: collapse;
            background: var(--pure-white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-medium);
        }

        .doctors-table th {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 1rem 0.75rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .doctors-table td {
            padding: 1rem 0.75rem;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .doctors-table tr:nth-child(even) {
            background: #f8fafc;
        }

        .doctors-table tr:hover {
            background: #e0f2fe;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        .specialization-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .experience-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--success-green), #059669);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .gender-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .gender-male {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .gender-female {
            background: linear-gradient(135deg, #ec4899, #be185d);
            color: white;
        }

        .gender-other {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }

        .no-data {
            text-align: center;
            padding: 3rem;
            color: var(--medium-gray);
        }

        .no-data i {
            font-size: 3rem;
            color: var(--medium-gray);
            margin-bottom: 1rem;
        }

        .card-footer {
            background: #f8fafc;
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(37, 99, 235, 0.05);
            border-radius: 12px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--medium-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (max-width: 768px) {
            .doctors-table {
                font-size: 0.8rem;
            }
            
            .doctors-table th,
            .doctors-table td {
                padding: 0.5rem;
            }
            
            .stats-summary {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="doctors-container">
        <div class="page-header">
            <div class="content-wrapper">
                <div style="display: flex; align-items: center; justify-content: center; gap: 1rem;">
                    <i class="fas fa-user-md" style="font-size: 2rem;"></i>
                    <h1>All Doctors</h1>
                </div>
            </div>
        </div>

        <div class="content-wrapper">
            <?php
            include 'DBconnect.php';
            
            // Check if database connection is successful
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            // Get total count for statistics
            $totalCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctor"));
            $maleCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctor WHERE gender = 'Male'"));
            $femaleCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM doctor WHERE gender = 'Female'"));
            $specializations = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT specialisation FROM doctor"));
            
            // Query to get all doctors
            $query = "SELECT * FROM doctor ORDER BY name";
            $result = mysqli_query($conn, $query);
            ?>

            <div class="doctors-card">
                <div class="card-header">
                    <h1><i class="fas fa-stethoscope"></i> Medical Professionals</h1>
                    <p>Complete list of registered doctors in the healthcare system</p>
                </div>
                
                <div class="card-body">
                    <div class="doctors-table-container">
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <!-- Statistics Summary -->
                            <div class="stats-summary">
                                <div class="stat-item">
                                    <div class="stat-value"><?php echo $totalCount; ?></div>
                                    <div class="stat-label">Total Doctors</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value"><?php echo $maleCount; ?></div>
                                    <div class="stat-label">Male Doctors</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value"><?php echo $femaleCount; ?></div>
                                    <div class="stat-label">Female Doctors</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value"><?php echo $specializations; ?></div>
                                    <div class="stat-label">Specializations</div>
                                </div>
                            </div>
                            
                            <table class="doctors-table">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-id-card"></i> Doctor ID</th>
                                        <th><i class="fas fa-user"></i> Name</th>
                                        <th><i class="fas fa-venus-mars"></i> Gender</th>
                                        <th><i class="fas fa-calendar-alt"></i> Experience</th>
                                        <th><i class="fas fa-stethoscope"></i> Specialization</th>
                                        <th><i class="fas fa-phone"></i> Contact</th>
                                        <th><i class="fas fa-map-marker-alt"></i> Region</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td>
                                                <strong style="color: var(--primary-blue);"><?php echo htmlspecialchars($row['DID']); ?></strong>
                                            </td>
                                            <td>
                                                <div style="font-weight: 600; color: var(--dark-gray);">
                                                    <?php echo htmlspecialchars($row['name']); ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="gender-icon <?php echo strtolower($row['gender']) == 'male' ? 'gender-male' : (strtolower($row['gender']) == 'female' ? 'gender-female' : 'gender-other'); ?>">
                                                    <i class="fas <?php echo strtolower($row['gender']) == 'male' ? 'fa-male' : (strtolower($row['gender']) == 'female' ? 'fa-female' : 'fa-user'); ?>"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="experience-badge">
                                                    <?php echo htmlspecialchars($row['experience']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="specialization-badge">
                                                    <?php echo htmlspecialchars($row['specialisation']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="tel:<?php echo htmlspecialchars($row['contact']); ?>" 
                                                   style="color: var(--primary-blue); text-decoration: none; font-weight: 500;">
                                                    <i class="fas fa-phone"></i>
                                                    <?php echo htmlspecialchars($row['contact']); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <i class="fas fa-map-marker-alt" style="color: var(--primary-blue); margin-right: 0.5rem;"></i>
                                                <?php echo htmlspecialchars($row['region']); ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <div class="no-data">
                                <i class="fas fa-user-md"></i>
                                <h3>No Doctors Found</h3>
                                <p>No doctors have been registered in the system yet.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="card-footer">
                    <a href="AdminPage.php" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Back to Admin Panel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Table row click animation
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('.doctors-table tr');
            tableRows.forEach((row, index) => {
                if (index === 0) return; // Skip header row
                
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                row.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, index * 100);
            });
        });
        
        // Add hover effect for better interaction
        document.querySelectorAll('.doctors-table tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
                this.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
            });
        });
    </script>
</body>
</html>