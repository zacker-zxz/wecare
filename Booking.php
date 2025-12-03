<?php session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .booking-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .booking-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .booking-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="booking-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23booking-grid)"/></svg>');
            opacity: 0.3;
        }

        .booking-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .booking-card {
            background: var(--pure-white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-large);
            position: relative;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="card-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23card-pattern)"/></svg>');
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

        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .section-title {
            color: var(--primary-blue);
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
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
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-control:hover {
            border-color: var(--accent-blue);
        }

        .radio-group {
            display: flex;
            gap: 2rem;
            margin-top: 0.5rem;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .radio-option input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary-blue);
        }

        .radio-option label {
            cursor: pointer;
            font-weight: 500;
            color: var(--dark-gray);
        }

        .availability-status {
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 8px;
            font-weight: 500;
            text-align: center;
        }

        .status-available {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-unavailable {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error-red);
            border: 1px solid rgba(239, 68, 68, 0.2);
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

            .radio-group {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <div class="booking-header">
            <div class="booking-content" style="position: relative; z-index: 2;">
                <h1><i class="fas fa-calendar-plus"></i> Book Your Appointment</h1>
                <p>Schedule an appointment with our qualified healthcare professionals</p>
            </div>
        </div>

        <div class="booking-content">
            <a href="Login.php" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>

            <div class="booking-card">
                <div class="card-header">
                    <h1><i class="fas fa-clipboard-list"></i> Appointment Details</h1>
                    <p>Please fill in all the required information to book your appointment</p>
                </div>

                <div class="card-body">
                    <?php include "DBconnect.php"; ?>

                    <form action="Booking.php" method="post" id="bookingForm">
                        <!-- Personal Information -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-user"></i>
                                Personal Information
                            </h3>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="fname" placeholder="Enter your full name" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Gender</label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" name="gender" value="female" id="female" required>
                                        <label for="female">Female</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="gender" value="male" id="male" required>
                                        <label for="male">Male</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="gender" value="other" id="other" required>
                                        <label for="other">Other</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Appointment Details -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-hospital"></i>
                                Appointment Details
                            </h3>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">City</label>
                                    <select name="city" id="city-list" class="form-control" onchange="getClinic(this.value);" required>
                                        <option value="">Select City</option>
                                        <?php
                                        $sql1="SELECT distinct(city) FROM clinic";
                                        $results=$conn->query($sql1);
                                        while($rs=$results->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $rs["city"]; ?>"><?php echo $rs["city"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Clinic</label>
                                    <select id="clinic-list" name="cid" class="form-control" onchange="getDoctorday(this.value);" required>
                                        <option value="">Select Clinic First</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Doctor</label>
                                    <select id="doctor-list" name="doctor" class="form-control" onchange="getDate(this.value);" required>
                                        <option value="">Select Doctor</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Appointment Date</label>
                                    <input type="date" class="form-control" name="DOV" onchange="getDay(this.value);"
                                           min="<?php echo date('Y-m-d');?>"
                                           max="<?php echo date('Y-m-d',strtotime('+21 day'));?>"
                                           required>
                                </div>
                            </div>

                            <div id="datestatus" class="availability-status" style="display: none;"></div>
                        </div>

                        <div style="text-align: center; margin-top: 2rem;">
                            <button type="submit" name="submit" class="btn btn-neon" style="padding: 1rem 3rem; font-size: 1.1rem;">
                                <i class="fas fa-calendar-check"></i>
                                Book Appointment
                            </button>
                        </div>
                    </form>

                    <?php
                    if(isset($_POST['submit'])) {
                        include 'DBconnect.php';
                        $fname = $_POST['fname'];
                        $gender = $_POST['gender'];
                        $username = $_POST['username'];
                        $cid = $_POST['cid'];
                        $did = $_POST['doctor'];
                        $dov = $_POST['DOV'];
                        $status = "Booking Registered.Wait for the update";
                        $timestamp = date('Y-m-d H:i:s');

                        if(!empty($_POST['fname']) && !empty($_POST['gender']) && !empty($_POST['username']) &&
                           !empty($_POST['cid']) && !empty($_POST['doctor']) && !empty($_POST['DOV'])) {

                            $checkday = strtotime($dov);
                            $compareday = date("l", $checkday);
                            $flag = 0;

                            $query = "SELECT * FROM doctor_available WHERE DID = '" .$did. "' AND CID='".$cid."'";
                            $results = $conn->query($query);

                            while($rs = $results->fetch_assoc()) {
                                if($rs["day"] == $compareday) {
                                    $flag++;
                                    break;
                                }
                            }

                            if($flag == 0) {
                                echo '<div class="availability-status status-unavailable" style="display: block; margin-top: 1rem;">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Doctor is not available on ' . $compareday . '. Please select another date.
                                      </div>';
                            } else {
                                $sql = "INSERT INTO booking (username,Fname,gender,CID,DID,DOV,Timestamp,Status)
                                       VALUES ('$username','$fname','$gender',$cid,$did,'$dov','$timestamp','$status')";

                                if (mysqli_query($conn, $sql)) {
                                    echo '<div class="availability-status status-available" style="display: block; margin-top: 1rem;">
                                            <i class="fas fa-check-circle"></i>
                                            Booking successful! Your appointment has been registered.
                                          </div>';
                                    echo '<script>
                                            setTimeout(function() {
                                                window.location.href = "PatientsAppointment.php";
                                            }, 3000);
                                          </script>';
                                } else {
                                    echo '<div class="availability-status status-unavailable" style="display: block; margin-top: 1rem;">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Error: ' . mysqli_error($conn) . '
                                          </div>';
                                }
                            }
                        } else {
                            echo '<div class="availability-status status-unavailable" style="display: block; margin-top: 1rem;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Please fill in all required fields properly.
                                  </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getTown(val) {
            $.ajax({
                type: "POST",
                url: "get_town.php",
                data:'countryid='+val,
                success: function(data) {
                    $("#town-list").html(data);
                }
            });
        }

        function getClinic(val) {
            $.ajax({
                type: "POST",
                url: "getclinic.php",
                data:'city='+val,
                success: function(data) {
                    $("#clinic-list").html(data);
                }
            });
        }

        function getDoctorday(val) {
            $.ajax({
                type: "POST",
                url: "getdoctordaybooking.php",
                data:'CID='+val,
                success: function(data) {
                    $("#doctor-list").html(data);
                }
            });
        }

        function getDay(val) {
            var CID = document.getElementById("clinic-list").value;
            var DID = document.getElementById("doctor-list").value;
            $.ajax({
                type: "POST",
                url: "getDay.php",
                data:'date='+val+'&DID='+DID+'&CID='+CID,
                success: function(data) {
                    $("#datestatus").html(data);
                    $("#datestatus").show();
                }
            });
        }

        // Form validation and animations
        document.addEventListener('DOMContentLoaded', function() {
            const formSections = document.querySelectorAll('.form-section');
            formSections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'all 0.5s ease';

                setTimeout(() => {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 200);
            });

            // Enhanced form validation
            const form = document.getElementById('bookingForm');
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = 'var(--error-red)';
                        isValid = false;
                    } else {
                        field.style.borderColor = 'var(--success-green)';
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });
        });
    </script>
</body>
</html>