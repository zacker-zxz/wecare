<?php session_start();
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
    <title>Delete Clinic - WeCare Admin</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .delete-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .delete-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .delete-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="delete-clinic-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23delete-clinic-grid)"/></svg>');
            opacity: 0.3;
        }

        .delete-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .delete-card {
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="delete-clinic-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23delete-clinic-pattern)"/></svg>');
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

        .warning-banner {
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

        .delete-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .delete-method {
            background: #f8fafc;
            border-radius: 16px;
            padding: 2rem;
            border: 2px solid #e2e8f0;
            transition: var(--transition);
        }

        .delete-method:hover {
            border-color: var(--error-red);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .method-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .method-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .method-icon.id { background: linear-gradient(135deg, var(--primary-blue), var(--light-blue)); color: white; }
        .method-icon.name { background: linear-gradient(135deg, var(--success-green), #059669); color: white; }

        .method-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-blue);
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-gray);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: var(--border-radius-small);
            font-size: 1rem;
            transition: var(--transition);
            background: var(--pure-white);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--error-red);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .clinic-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: var(--border-radius-small);
            font-size: 1rem;
            background: var(--pure-white);
            transition: var(--transition);
            max-height: 200px;
            overflow-y: auto;
        }

        .clinic-select:focus {
            outline: none;
            border-color: var(--error-red);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .clinic-option {
            padding: 0.75rem;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: var(--transition);
        }

        .clinic-option:hover {
            background: rgba(239, 68, 68, 0.05);
        }

        .clinic-option:last-child {
            border-bottom: none;
        }

        .clinic-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .clinic-details h5 {
            margin: 0 0 0.25rem 0;
            color: var(--primary-blue);
            font-size: 0.9rem;
        }

        .clinic-details p {
            margin: 0;
            color: var(--medium-gray);
            font-size: 0.8rem;
        }

        .clinic-id {
            background: var(--primary-blue);
            color: var(--pure-white);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
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
            .delete-options {
                grid-template-columns: 1fr;
            }

            .delete-method {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="delete-container">
        <div class="delete-header">
            <div class="delete-content" style="position: relative; z-index: 2;">
                <h1><i class="fas fa-hospital-times"></i> Delete Clinic</h1>
                <p>Remove clinics from the system</p>
            </div>
        </div>

        <div class="delete-content">
            <a href="AdminPage.php" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Admin Dashboard
            </a>

            <div class="delete-card">
                <div class="card-header">
                    <h1><i class="fas fa-exclamation-triangle"></i> Clinic Removal</h1>
                    <p>Select a clinic to permanently remove from the system</p>
                </div>

                <div class="card-body">
                    <div class="warning-banner">
                        <div class="warning-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="warning-content">
                            <h4>Important Warning</h4>
                            <p>Deleting a clinic is permanent and cannot be undone. This will remove all associated doctor assignments and may affect patient appointments. Please ensure you want to proceed with this action.</p>
                        </div>
                    </div>

                    <div class="delete-options">
                        <!-- Delete by ID -->
                        <div class="delete-method">
                            <div class="method-header">
                                <div class="method-icon id">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                                <h3 class="method-title">Delete by Clinic ID</h3>
                            </div>

                            <form method="post" action="">
                                <div class="form-group">
                                    <label class="form-label">Enter Clinic ID (CID)</label>
                                    <input type="number" class="form-control" name="cid" placeholder="e.g., 1" required>
                                </div>
                                <button type="submit" name="submit1" class="btn btn-danger" style="width: 100%; background: linear-gradient(135deg, var(--error-red), #dc2626);">
                                    <i class="fas fa-trash"></i>
                                    Delete Clinic
                                </button>
                            </form>
                        </div>

                        <!-- Delete by Name -->
                        <div class="delete-method">
                            <div class="method-header">
                                <div class="method-icon name">
                                    <i class="fas fa-hospital"></i>
                                </div>
                                <h3 class="method-title">Delete by Clinic Name</h3>
                            </div>

                            <form method="post" action="">
                                <div class="form-group">
                                    <label class="form-label">Select Clinic</label>
                                <select name="clinicname" class="clinic-select" required>
                                    <option value="">--- Select Clinic ---</option>
                                    <?php
                                    require_once('DBconnect.php');
                                    $clinic_result = $conn->query('SELECT * FROM clinic ORDER BY city, town, name ASC');

                                    if ($clinic_result->num_rows > 0) {
                                        while($row = $clinic_result->fetch_assoc()) {
                                            echo "<option value='" . $row["CID"] . "'>" . htmlspecialchars($row["name"]) . " - " . htmlspecialchars($row["town"]) . ", " . htmlspecialchars($row["city"]) . " (CID: " . $row["CID"] . ")</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled>No clinics available</option>";
                                    }
                                    ?>
                                </select>
                                </div>
                                <button type="submit" name="submit2" class="btn btn-danger" style="width: 100%; background: linear-gradient(135deg, var(--error-red), #dc2626);">
                                    <i class="fas fa-trash"></i>
                                    Delete Clinic
                                </button>
                            </form>
                        </div>
                    </div>

                    <?php
                    // Display current clinics list for reference
                    $clinic_count = $conn->query('SELECT COUNT(*) as count FROM clinic')->fetch_assoc()['count'];
                    if ($clinic_count > 0) {
                        echo '<div style="background: #f8fafc; border-radius: 12px; padding: 1.5rem; margin-top: 2rem;">';
                        echo '<h4 style="color: var(--dark-blue); margin-bottom: 1rem;"><i class="fas fa-building"></i> Current Clinics (' . $clinic_count . ')</h4>';
                        echo '<div style="max-height: 200px; overflow-y: auto;">';

                        $clinics = $conn->query('SELECT * FROM clinic ORDER BY city, town, name ASC');
                        while($clinic = $clinics->fetch_assoc()) {
                            echo '<div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; border-bottom: 1px solid #e2e8f0;">';
                            echo '<div>';
                            echo '<strong style="color: var(--primary-blue);">' . htmlspecialchars($clinic['name']) . '</strong>';
                            echo '<br><small style="color: var(--medium-gray);">' . htmlspecialchars($clinic['town']) . ', ' . htmlspecialchars($clinic['city']) . '</small>';
                            echo '</div>';
                            echo '<span style="background: var(--primary-blue); color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">CID: ' . $clinic['CID'] . '</span>';
                            echo '</div>';
                        }
                        echo '</div></div>';
                    }

                    // Handle form submissions
                    if(isset($_POST['submit1'])) {
                        $cid = $_POST['cid'];
                        $sql = "DELETE FROM clinic WHERE CID = $cid";

                        if (mysqli_query($conn, $sql)) {
                            echo '<div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1)); border: 1px solid rgba(239, 68, 68, 0.2); color: var(--error-red); padding: 1.5rem; border-radius: 12px; margin-top: 2rem; text-align: center; font-weight: 600;">
                                    <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                                    Clinic deleted successfully! The page will refresh shortly.
                                  </div>';
                            echo '<script>
                                    setTimeout(function() {
                                        window.location.href = "DeleteClinic.php";
                                    }, 3000);
                                  </script>';
                        } else {
                            echo '<div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1)); border: 1px solid rgba(239, 68, 68, 0.2); color: var(--error-red); padding: 1.5rem; border-radius: 12px; margin-top: 2rem; text-align: center; font-weight: 600;">
                                    <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                                    Error deleting clinic: ' . mysqli_error($conn) . '
                                  </div>';
                        }
                    }

                    if(isset($_POST['submit2'])) {
                        $cid = $_POST['clinicname'];
                        $sql = "DELETE FROM clinic WHERE CID = $cid";

                        if (mysqli_query($conn, $sql)) {
                            echo '<div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1)); border: 1px solid rgba(239, 68, 68, 0.2); color: var(--error-red); padding: 1.5rem; border-radius: 12px; margin-top: 2rem; text-align: center; font-weight: 600;">
                                    <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                                    Clinic deleted successfully! The page will refresh shortly.
                                  </div>';
                            echo '<script>
                                    setTimeout(function() {
                                        window.location.href = "DeleteClinic.php";
                                    }, 3000);
                                  </script>';
                        } else {
                            echo '<div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1)); border: 1px solid rgba(239, 68, 68, 0.2); color: var(--error-red); padding: 1.5rem; border-radius: 12px; margin-top: 2rem; text-align: center; font-weight: 600;">
                                    <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                                    Error deleting clinic: ' . mysqli_error($conn) . '
                                  </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced form validation and animations
        document.addEventListener('DOMContentLoaded', function() {
            const deleteCard = document.querySelector('.delete-card');
            deleteCard.style.opacity = '0';
            deleteCard.style.transform = 'translateY(30px)';
            deleteCard.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

            setTimeout(() => {
                deleteCard.style.opacity = '1';
                deleteCard.style.transform = 'translateY(0)';
            }, 100);

            // Add warning animation
            const warningBanner = document.querySelector('.warning-banner');
            warningBanner.style.opacity = '0';
            warningBanner.style.transform = 'translateY(-10px)';
            warningBanner.style.transition = 'all 0.5s ease';

            setTimeout(() => {
                warningBanner.style.opacity = '1';
                warningBanner.style.transform = 'translateY(0)';
            }, 300);

            // Form validation
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const inputs = form.querySelectorAll('input, select');
                    let isValid = true;

                    inputs.forEach(input => {
                        if (input.hasAttribute('required') && !input.value.trim()) {
                            input.style.borderColor = 'var(--error-red)';
                            isValid = false;
                        } else {
                            input.style.borderColor = 'var(--success-green)';
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        alert('Please fill in all required fields.');
                    } else {
                        // Add loading state to button
                        const submitBtn = form.querySelector('button[type="submit"]');
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                        submitBtn.disabled = true;

                        // Re-enable after 3 seconds (in case of error)
                        setTimeout(() => {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }, 3000);
                    }
                });
            });
        });
    </script>
</body>
</html>