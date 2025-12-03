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
    <title>Remove Doctor from Clinic - WeCare Admin</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .remove-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .remove-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .remove-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="remove-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23remove-grid)"/></svg>');
            opacity: 0.3;
        }

        .remove-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .remove-card {
            background: var(--pure-white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-large);
            position: relative;
        }

        .card-header {
            background: linear-gradient(135deg, var(--warning-orange), #f97316);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="remove-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23remove-pattern)"/></svg>');
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

        .info-banner {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.1));
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--pure-white);
            flex-shrink: 0;
        }

        .info-content h4 {
            color: var(--primary-blue);
            margin: 0 0 0.5rem 0;
            font-size: 1.1rem;
        }

        .info-content p {
            color: var(--medium-gray);
            margin: 0;
            line-height: 1.5;
        }

        .selection-form {
            background: #f8fafc;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 2px solid #e2e8f0;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-gray);
            font-size: 1rem;
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
            border-color: var(--warning-orange);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .assignment-preview {
            background: var(--pure-white);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            border: 1px solid #e2e8f0;
        }

        .assignment-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            color: var(--primary-blue);
            font-weight: 600;
        }

        .assignment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            border: 1px solid #e2e8f0;
        }

        .assignment-info h5 {
            margin: 0 0 0.25rem 0;
            color: var(--dark-blue);
            font-size: 0.9rem;
        }

        .assignment-info p {
            margin: 0;
            color: var(--medium-gray);
            font-size: 0.8rem;
        }

        .assignment-details {
            text-align: right;
            color: var(--medium-gray);
            font-size: 0.8rem;
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
            .form-row {
                grid-template-columns: 1fr;
            }

            .assignment-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .assignment-details {
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="remove-container">
        <div class="remove-header">
            <div class="remove-content" style="position: relative; z-index: 2;">
                <h1><i class="fas fa-user-minus"></i> Remove Doctor from Clinic</h1>
                <p>Unassign doctors from their clinic assignments</p>
            </div>
        </div>

        <div class="remove-content">
            <a href="AdminPage.php" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Admin Dashboard
            </a>

            <div class="remove-card">
                <div class="card-header">
                    <h1><i class="fas fa-exclamation-circle"></i> Doctor-Clinic Unassignment</h1>
                    <p>Select a clinic and doctor to remove their assignment</p>
                </div>

                <div class="card-body">
                    <div class="info-banner">
                        <div class="info-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="info-content">
                            <h4>Assignment Removal</h4>
                            <p>This will remove the doctor's availability schedule from the selected clinic. The doctor will no longer be available for appointments at this clinic, but their profile will remain in the system.</p>
                        </div>
                    </div>

                    <div class="selection-form">
                        <form method="post" action="" id="removalForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-city"></i>
                                        Select City
                                    </label>
                                    <select name="city" id="city-list" class="form-control" onchange="getState(this.value);" required>
                                        <option value="">Select City</option>
                                        <?php
                                        include 'DBconnect.php';
                                        $sql1 = "SELECT DISTINCT city FROM clinic ORDER BY city";
                                        $results = $conn->query($sql1);
                                        while($rs = $results->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $rs["city"]; ?>"><?php echo $rs["city"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-hospital"></i>
                                        Select Clinic
                                    </label>
                                    <select id="clinic-list" name="clinic" class="form-control" onchange="getDoctorday(this.value);" required>
                                        <option value="">Select Clinic First</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-user-md"></i>
                                    Select Doctor Assignment
                                </label>
                                <select name="doctor" id="doctor-list" class="form-control" required>
                                    <option value="">Select Doctor & Schedule</option>
                                </select>
                            </div>

                            <button type="submit" name="submit" class="btn btn-danger" style="width: 100%; background: linear-gradient(135deg, var(--warning-orange), #f97316);">
                                <i class="fas fa-user-minus"></i>
                                Remove Doctor Assignment
                            </button>
                        </form>
                    </div>

                    <?php
                    // Display current assignments for reference
                    $assignment_query = "SELECT da.*, d.name as doctor_name, d.specialisation, c.name as clinic_name, c.city, c.town
                                       FROM doctor_available da
                                       JOIN doctor d ON da.DID = d.DID
                                       JOIN clinic c ON da.CID = c.CID
                                       ORDER BY c.city, c.name, d.name";

                    $assignments = $conn->query($assignment_query);

                    if ($assignments->num_rows > 0) {
                        echo '<div class="assignment-preview">';
                        echo '<div class="assignment-header">';
                        echo '<i class="fas fa-clipboard-list"></i>';
                        echo '<span>Current Doctor-Clinic Assignments (' . $assignments->num_rows . ')</span>';
                        echo '</div>';

                        while($assignment = $assignments->fetch_assoc()) {
                            echo '<div class="assignment-item">';
                            echo '<div class="assignment-info">';
                            echo '<h5>' . htmlspecialchars($assignment['doctor_name']) . '</h5>';
                            echo '<p>' . htmlspecialchars($assignment['specialisation']) . '</p>';
                            echo '</div>';
                            echo '<div class="assignment-details">';
                            echo '<strong>' . htmlspecialchars($assignment['clinic_name']) . '</strong><br>';
                            echo '<small>' . htmlspecialchars($assignment['town']) . ', ' . htmlspecialchars($assignment['city']) . '</small><br>';
                            echo '<small><i class="fas fa-calendar"></i> ' . htmlspecialchars($assignment['day']) . ' (' . date('g:i A', strtotime($assignment['starttime'])) . ' - ' . date('g:i A', strtotime($assignment['endtime'])) . ')</small>';
                            echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }

                    // Handle form submission
                    if(isset($_POST['submit'])) {
                        $cid = $_POST['clinic'];
                        $did = $_POST['doctor'];
                        $sql = "DELETE FROM doctor_available WHERE CID = $cid AND DID = $did";

                        if (mysqli_query($conn, $sql)) {
                            echo '<div style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1)); border: 1px solid rgba(245, 158, 11, 0.2); color: var(--warning-orange); padding: 1.5rem; border-radius: 12px; margin-top: 2rem; text-align: center; font-weight: 600;">
                                    <i class="fas fa-check-circle" style="margin-right: 0.5rem;"></i>
                                    Doctor assignment removed successfully! The page will refresh shortly.
                                  </div>';
                            echo '<script>
                                    setTimeout(function() {
                                        window.location.href = "DeleteDoctorFromClinic.php";
                                    }, 3000);
                                  </script>';
                        } else {
                            echo '<div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1)); border: 1px solid rgba(239, 68, 68, 0.2); color: var(--error-red); padding: 1.5rem; border-radius: 12px; margin-top: 2rem; text-align: center; font-weight: 600;">
                                    <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                                    Error removing assignment: ' . mysqli_error($conn) . '
                                  </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getState(val) {
            $.ajax({
                type: "POST",
                url: "getclinic.php",
                data: 'city=' + val,
                success: function(data) {
                    $("#clinic-list").html(data);
                }
            });
        }

        function getDoctorday(val) {
            $.ajax({
                type: "POST",
                url: "getdoctorday.php",
                data: 'cid=' + val,
                success: function(data) {
                    $("#doctor-list").html(data);
                }
            });
        }

        // Enhanced form validation and animations
        document.addEventListener('DOMContentLoaded', function() {
            const removeCard = document.querySelector('.remove-card');
            removeCard.style.opacity = '0';
            removeCard.style.transform = 'translateY(30px)';
            removeCard.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

            setTimeout(() => {
                removeCard.style.opacity = '1';
                removeCard.style.transform = 'translateY(0)';
            }, 100);

            // Add info banner animation
            const infoBanner = document.querySelector('.info-banner');
            infoBanner.style.opacity = '0';
            infoBanner.style.transform = 'translateY(-10px)';
            infoBanner.style.transition = 'all 0.5s ease';

            setTimeout(() => {
                infoBanner.style.opacity = '1';
                infoBanner.style.transform = 'translateY(0)';
            }, 300);

            // Form validation
            const form = document.getElementById('removalForm');
            form.addEventListener('submit', function(e) {
                const selects = form.querySelectorAll('select');
                let isValid = true;

                selects.forEach(select => {
                    if (select.hasAttribute('required') && !select.value) {
                        select.style.borderColor = 'var(--error-red)';
                        isValid = false;
                    } else {
                        select.style.borderColor = 'var(--success-green)';
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                } else {
                    // Add loading state to button
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Removing...';
                    submitBtn.disabled = true;

                    // Re-enable after 3 seconds (in case of error)
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 3000);
                }
            });
        });
    </script>
</body>
</html>