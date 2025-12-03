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
    <title>Assign Doctor to Clinic - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="jquerypart.js" type="text/javascript"></script>
    <style>
        .assignment-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .assignment-header {
            background: linear-gradient(135deg, var(--warning-orange), #f97316);
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .assignment-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="assignment-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23assignment-grid)"/></svg>');
            opacity: 0.3;
        }

        .assignment-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .assignment-card {
            background: var(--pure-white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-large);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="assignment-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23assignment-pattern)"/></svg>');
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

        .assignment-form {
            display: grid;
            gap: 2rem;
        }

        .form-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(245, 113, 22, 0.1);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            color: var(--warning-orange);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--warning-orange), #f97316);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-label {
            font-weight: 500;
            color: var(--dark-gray);
            font-size: 0.9rem;
        }

        .form-control {
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--pure-white);
            cursor: pointer;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--warning-orange);
            box-shadow: 0 0 0 3px rgba(245, 113, 22, 0.1);
        }

        .form-control:hover {
            border-color: var(--accent-blue);
        }

        .availability-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(245, 113, 22, 0.1);
        }

        .availability-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            color: var(--warning-orange);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .day-selector {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .day-checkbox {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: var(--pure-white);
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .day-checkbox:hover {
            border-color: var(--warning-orange);
            background: rgba(245, 113, 22, 0.05);
        }

        .day-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--warning-orange);
        }

        .day-checkbox label {
            font-weight: 500;
            color: var(--dark-gray);
            cursor: pointer;
            margin: 0;
        }

        .time-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .time-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .time-input {
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--pure-white);
        }

        .time-input:focus {
            outline: none;
            border-color: var(--warning-orange);
            box-shadow: 0 0 0 3px rgba(245, 113, 22, 0.1);
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

        .status-message {
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
            display: none;
        }

        .status-message.success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--success-green);
            color: var(--success-green);
        }

        .status-message.error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--error-red);
            color: var(--error-red);
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            display: none;
        }

        .loading-content {
            background: var(--pure-white);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: var(--shadow-large);
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e2e8f0;
            border-top: 4px solid var(--warning-orange);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            .day-selector {
                grid-template-columns: 1fr;
            }
            .time-selector {
                grid-template-columns: 1fr;
            }
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="assignment-container">
        <div class="assignment-header">
            <div class="assignment-content">
                <div style="display: flex; align-items: center; justify-content: center; gap: 1rem;">
                    <i class="fas fa-user-plus" style="font-size: 2rem;"></i>
                    <h1>Assign Doctor to Clinic</h1>
                </div>
            </div>
        </div>

        <div class="assignment-content">
            <div class="assignment-card">
                <div class="card-header">
                    <h1><i class="fas fa-link"></i> Doctor-Clinic Assignment</h1>
                    <p>Assign doctors to clinics and set their availability schedules</p>
                </div>

                <div class="card-body">
                    <form method="post" action="AddDoctorToClinic.php" id="assignmentForm" class="assignment-form">
                        <!-- Location Selection -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <span>Location Selection</span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Select City <span class="required">*</span></label>
                                <select name="city" id="city-list" class="form-control" onchange="getState(this.value);getDoctorRegion(this.value);" required>
                                    <option value="">Select City</option>
                                    <?php
                                    include 'DBconnect.php';
                                    $sql1 = "SELECT distinct city FROM clinic";
                                    $results = $conn->query($sql1);
                                    while ($rs = $results->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $rs["city"]; ?>"><?php echo $rs["city"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Clinic and Doctor Selection -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <span>Clinic & Doctor Selection</span>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Select Clinic <span class="required">*</span></label>
                                    <select id="clinic-list" name="cid" class="form-control" required>
                                        <option value="">Select Clinic</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Select Doctor <span class="required">*</span></label>
                                    <select name="doctor" id="doctor-list" class="form-control" required>
                                        <option value="">Select Doctor</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Availability Schedule -->
                        <div class="availability-section">
                            <div class="availability-header">
                                <div class="section-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <span>Availability Schedule</span>
                            </div>

                            <div style="margin-bottom: 1.5rem;">
                                <label class="form-label" style="margin-bottom: 1rem; display: block;">Available Days <span class="required">*</span></label>
                                <div class="day-selector">
                                    <div class="day-checkbox">
                                        <input type="checkbox" value="Monday" name="daylist[]" id="monday">
                                        <label for="monday">Monday</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" value="Tuesday" name="daylist[]" id="tuesday">
                                        <label for="tuesday">Tuesday</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" value="Wednesday" name="daylist[]" id="wednesday">
                                        <label for="wednesday">Wednesday</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" value="Thursday" name="daylist[]" id="thursday">
                                        <label for="thursday">Thursday</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" value="Friday" name="daylist[]" id="friday">
                                        <label for="friday">Friday</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" value="Saturday" name="daylist[]" id="saturday">
                                        <label for="saturday">Saturday</label>
                                    </div>
                                </div>
                            </div>

                            <div class="time-selector">
                                <div class="time-group">
                                    <label class="form-label">Start Time <span class="required">*</span></label>
                                    <input type="time" name="starttime" class="time-input" required>
                                </div>
                                <div class="time-group">
                                    <label class="form-label">End Time <span class="required">*</span></label>
                                    <input type="time" name="endtime" class="time-input" required>
                                </div>
                            </div>
                        </div>

                        <div id="statusMessage" class="status-message"></div>
                    </form>
                </div>

                <div class="card-footer">
                    <div class="action-buttons">
                        <button type="submit" form="assignmentForm" name="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Assign Doctor
                        </button>
                        <a href="DoctorSchedule.php" class="btn btn-secondary">
                            <i class="fas fa-calendar-alt"></i> View Schedules
                        </a>
                        <a href="AdminPage.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-content">
            <div class="loading-spinner"></div>
            <h3>Assigning Doctor...</h3>
            <p>Please wait while we create the schedule assignments.</p>
        </div>
    </div>

    <style>
        .required {
            color: var(--error-red);
        }
    </style>

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

        function getDoctorRegion(val) {
            $.ajax({
                type: "POST",
                url: "getdoctorregion.php",
                data: 'city=' + val,
                success: function(data) {
                    $("#doctor-list").html(data);
                }
            });
        }

        // Form validation and submission
        document.getElementById('assignmentForm').addEventListener('submit', function(e) {
            const startTime = document.querySelector('input[name="starttime"]').value;
            const endTime = document.querySelector('input[name="endtime"]').value;
            const dayCheckboxes = document.querySelectorAll('input[name="daylist[]"]:checked');

            if (dayCheckboxes.length === 0) {
                e.preventDefault();
                showMessage('Please select at least one day for availability.', 'error');
                return false;
            }

            if (startTime >= endTime) {
                e.preventDefault();
                showMessage('End time must be after start time.', 'error');
                return false;
            }

            // Show loading overlay
            document.getElementById('loadingOverlay').style.display = 'flex';
        });

        // Clear form function
        function clearForm() {
            if (confirm('Are you sure you want to clear all form data?')) {
                document.getElementById('assignmentForm').reset();
                document.getElementById('statusMessage').style.display = 'none';
            }
        }

        // Show message function
        function showMessage(message, type) {
            const statusMessage = document.getElementById('statusMessage');
            statusMessage.textContent = message;
            statusMessage.className = `status-message ${type}`;
            statusMessage.style.display = 'block';

            setTimeout(() => {
                statusMessage.style.display = 'none';
            }, 5000);
        }

        // Animate form sections
        document.addEventListener('DOMContentLoaded', function() {
            const formSections = document.querySelectorAll('.form-section, .availability-section');
            formSections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'all 0.5s ease';

                setTimeout(() => {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 200);
            });

            // Add hover effects to day checkboxes
            const dayCheckboxes = document.querySelectorAll('.day-checkbox');
            dayCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.02)';
                });

                checkbox.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });

        // Handle PHP success/error messages
        <?php if (isset($_POST['submit'])): ?>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('loadingOverlay').style.display = 'none';
                <?php if (isset($status_class) && isset($status_message)): ?>
                    showMessage('<?php echo addslashes($status_message); ?>', '<?php echo $status_class; ?>');
                <?php endif; ?>
            });
        <?php endif; ?>
    </script>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    include 'DBconnect.php';
    $cid = $_POST['cid'];
    $did = $_POST['doctor'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    $successCount = 0;
    $errorMessages = [];

    foreach ($_POST['daylist'] as $daylist) {
        $sql = "INSERT INTO doctor_available(CID, DID, day, starttime, endtime) VALUES ('$cid', '$did', '$daylist', '$starttime', '$endtime')";
        if (mysqli_query($conn, $sql)) {
            $successCount++;
        } else {
            $errorMessages[] = "Error for $daylist: " . mysqli_error($conn);
        }
    }

    if ($successCount > 0) {
        $status_class = 'success';
        $status_message = "Successfully assigned doctor to clinic for $successCount day(s)!";
        if (!empty($errorMessages)) {
            $status_message .= " Some assignments failed: " . implode(", ", $errorMessages);
        }
    } else {
        $status_class = 'error';
        $status_message = "Assignment failed: " . implode(", ", $errorMessages);
    }
}
?>