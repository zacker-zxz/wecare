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
    <title>Add New Doctor - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .doctor-form-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="medical-form" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23medical-form)"/></svg>');
            opacity: 0.3;
        }

        .form-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .doctor-form-card {
            background: var(--pure-white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-large);
            position: relative;
        }

        .form-card-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .form-card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="form-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23form-pattern)"/></svg>');
            opacity: 0.3;
        }

        .form-card-header h1 {
            color: var(--pure-white);
            margin: 0 0 0.5rem 0;
            font-size: 2rem;
            position: relative;
            z-index: 2;
        }

        .form-card-header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
            font-size: 1rem;
            position: relative;
            z-index: 2;
        }

        .form-card-body {
            padding: 3rem 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .form-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .password-requirements {
            background: rgba(37, 99, 235, 0.1);
            border: 1px solid rgba(37, 99, 235, 0.2);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
            font-size: 0.875rem;
            color: var(--dark-gray);
        }

        .requirement-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .requirement-item:last-child {
            margin-bottom: 0;
        }

        .requirement-icon {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .requirement-icon.valid {
            background: var(--success-green);
            color: white;
        }

        .requirement-icon.invalid {
            background: var(--medium-gray);
            color: white;
        }

        .form-actions {
            background: #f8fafc;
            padding: 2rem;
            border-radius: 0 0 20px 20px;
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

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="doctor-form-container">
        <div class="form-header">
            <div class="form-content">
                <div style="display: flex; align-items: center; justify-content: center; gap: 1rem;">
                    <i class="fas fa-user-md" style="font-size: 2rem;"></i>
                    <h1>Add New Doctor</h1>
                </div>
            </div>
        </div>

        <div class="form-content">
            <?php
            if (isset($_POST['submit'])) {
                include 'DBconnect.php';
                
                $did = $_POST['did'];
                $name = $_POST['name'];
                $gender = $_POST['gender'];
                $dob = $_POST['dob'];
                $experience = $_POST['experience'];
                $specialisation = $_POST['specialisation'];
                $contact = $_POST['contact'];
                $address = $_POST['address'];
                $region = $_POST['region'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                
                // Check if DID already exists
                $check = "SELECT * FROM doctor WHERE DID = '$did'";
                $result = mysqli_query($conn, $check);
                
                if (mysqli_num_rows($result) > 0) {
                    $status_class = 'error';
                    $status_message = 'Error: Doctor ID already exists. Please use a different ID.';
                } else {
                    $query = "INSERT INTO doctor (DID, name, gender, dob, experience, specialisation, contact, address, username, password, region) 
                             VALUES ('$did', '$name', '$gender', '$dob', '$experience', '$specialisation', '$contact', '$address', '$username', '$password', '$region')";
                    
                    if (mysqli_query($conn, $query)) {
                        $status_class = 'success';
                        $status_message = 'Doctor registered successfully!';
                        
                        // Clear form data on success
                        $_POST = array();
                    } else {
                        $status_class = 'error';
                        $status_message = 'Error: ' . mysqli_error($conn);
                    }
                }
            }
            ?>

            <div class="doctor-form-card">
                <div class="form-card-header">
                    <h1><i class="fas fa-stethoscope"></i> Doctor Registration</h1>
                    <p>Register a new medical professional to the system</p>
                </div>
                
                <div class="form-card-body">
                    <form method="POST" action="" id="doctorForm">
                        <div class="form-grid">
                            <!-- Basic Information Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <div class="section-icon">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <span>Basic Information</span>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Doctor ID <span class="required">*</span></label>
                                        <input type="number" class="form-control" name="did" 
                                               value="<?php echo isset($_POST['did']) ? $_POST['did'] : ''; ?>" 
                                               required min="1">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Gender <span class="required">*</span></label>
                                        <select class="form-control" name="gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                            <option value="Other" <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group full-width">
                                    <label class="form-label">Full Name <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="name" 
                                           value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" 
                                           required placeholder="Enter doctor's full name">
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Date of Birth <span class="required">*</span></label>
                                        <input type="date" class="form-control" name="dob" 
                                               value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : ''; ?>" 
                                               required max="<?php echo date('Y-m-d', strtotime('-21 years')); ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Region <span class="required">*</span></label>
                                        <select class="form-control" name="region" required>
                                            <option value="">Select Region</option>
                                            <option value="Hyderabad" <?php echo (isset($_POST['region']) && $_POST['region'] == 'Hyderabad') ? 'selected' : ''; ?>>Hyderabad</option>
                                            <option value="Bangalore" <?php echo (isset($_POST['region']) && $_POST['region'] == 'Bangalore') ? 'selected' : ''; ?>>Bangalore</option>
                                            <option value="Chennai" <?php echo (isset($_POST['region']) && $_POST['region'] == 'Chennai') ? 'selected' : ''; ?>>Chennai</option>
                                            <option value="Mumbai" <?php echo (isset($_POST['region']) && $_POST['region'] == 'Mumbai') ? 'selected' : ''; ?>>Mumbai</option>
                                            <option value="Delhi" <?php echo (isset($_POST['region']) && $_POST['region'] == 'Delhi') ? 'selected' : ''; ?>>Delhi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Information Section -->
                            <div class="form-section">
                                <div class="section-header">
                                    <div class="section-icon">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <span>Professional Details</span>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Specialization <span class="required">*</span></label>
                                    <select class="form-control" name="specialisation" required>
                                        <option value="">Select Specialization</option>
                                        <option value="General Physician" <?php echo (isset($_POST['specialisation']) && $_POST['specialisation'] == 'General Physician') ? 'selected' : ''; ?>>General Physician</option>
                                        <option value="Cardiologist" <?php echo (isset($_POST['specialisation']) && $_POST['specialisation'] == 'Cardiologist') ? 'selected' : ''; ?>>Cardiologist</option>
                                        <option value="Neurologist" <?php echo (isset($_POST['specialisation']) && $_POST['specialisation'] == 'Neurologist') ? 'selected' : ''; ?>>Neurologist</option>
                                        <option value="Orthopedist" <?php echo (isset($_POST['specialisation']) && $_POST['specialisation'] == 'Orthopedist') ? 'selected' : ''; ?>>Orthopedist</option>
                                        <option value="Pediatrician" <?php echo (isset($_POST['specialisation']) && $_POST['specialisation'] == 'Pediatrician') ? 'selected' : ''; ?>>Pediatrician</option>
                                        <option value="Dermatologist" <?php echo (isset($_POST['specialisation']) && $_POST['specialisation'] == 'Dermatologist') ? 'selected' : ''; ?>>Dermatologist</option>
                                        <option value="Psychiatrist" <?php echo (isset($_POST['specialisation']) && $_POST['specialisation'] == 'Psychiatrist') ? 'selected' : ''; ?>>Psychiatrist</option>
                                        <option value="Ophthalmologist" <?php echo (isset($_POST['specialisation']) && $_POST['specialisation'] == 'Ophthalmologist') ? 'selected' : ''; ?>>Ophthalmologist</option>
                                        <option value="Surgeon" <?php echo (isset($_POST['specialisation']) && $_POST['specialisation'] == 'Surgeon') ? 'selected' : ''; ?>>Surgeon</option>
                                        <option value="Gynecologist" <?php echo (isset($_POST['specialisation']) && $_POST['specialisation'] == 'Gynecologist') ? 'selected' : ''; ?>>Gynecologist</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Experience (Years) <span class="required">*</span></label>
                                    <select class="form-control" name="experience" required>
                                        <option value="">Select Experience</option>
                                        <option value="1" <?php echo (isset($_POST['experience']) && $_POST['experience'] == '1') ? 'selected' : ''; ?>>1 Year</option>
                                        <option value="2" <?php echo (isset($_POST['experience']) && $_POST['experience'] == '2') ? 'selected' : ''; ?>>2 Years</option>
                                        <option value="3-5" <?php echo (isset($_POST['experience']) && $_POST['experience'] == '3-5') ? 'selected' : ''; ?>>3-5 Years</option>
                                        <option value="5-10" <?php echo (isset($_POST['experience']) && $_POST['experience'] == '5-10') ? 'selected' : ''; ?>>5-10 Years</option>
                                        <option value="10-15" <?php echo (isset($_POST['experience']) && $_POST['experience'] == '10-15') ? 'selected' : ''; ?>>10-15 Years</option>
                                        <option value="15+" <?php echo (isset($_POST['experience']) && $_POST['experience'] == '15+') ? 'selected' : ''; ?>>15+ Years</option>
                                    </select>
                                </div>
                                
                                <div class="form-group full-width">
                                    <label class="form-label">Contact Number <span class="required">*</span></label>
                                    <input type="tel" class="form-control" name="contact" 
                                           value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : ''; ?>" 
                                           required pattern="[0-9]{10}" placeholder="Enter 10-digit mobile number">
                                </div>
                                
                                <div class="form-group full-width">
                                    <label class="form-label">Address <span class="required">*</span></label>
                                    <textarea class="form-control" name="address" rows="3" required 
                                              placeholder="Enter complete address"><?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?></textarea>
                                </div>
                            </div>

                            <!-- Login Credentials Section -->
                            <div class="form-section" style="grid-column: 1 / -1;">
                                <div class="section-header">
                                    <div class="section-icon">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <span>Login Credentials</span>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Username <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="username" 
                                               value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" 
                                               required minlength="3" placeholder="Unique username">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Password <span class="required">*</span></label>
                                        <input type="password" class="form-control" name="password" 
                                               id="password" required minlength="10" maxlength="10" 
                                               placeholder="10-character password">
                                    </div>
                                </div>
                                
                                <div class="password-requirements">
                                    <h4 style="margin: 0 0 0.5rem 0; color: var(--primary-blue);">Password Requirements:</h4>
                                    <div class="requirement-item">
                                        <div class="requirement-icon invalid" id="length-icon">✓</div>
                                        <span>Exactly 10 characters</span>
                                    </div>
                                    <div class="requirement-item">
                                        <div class="requirement-icon invalid" id="alphanumeric-icon">✓</div>
                                        <span>Alphanumeric characters only</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="statusMessage" class="status-message" style="display: <?php echo isset($status_message) ? 'block' : 'none'; ?>;">
                            <?php echo isset($status_message) ? $status_message : ''; ?>
                        </div>
                    </form>
                </div>
                
                <div class="form-actions">
                    <div class="action-buttons">
                        <button type="submit" form="doctorForm" name="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> Register Doctor
                        </button>
                        <a href="AdminPage.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                        <button type="button" class="btn btn-secondary" onclick="clearForm()">
                            <i class="fas fa-refresh"></i> Clear Form
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .required {
            color: var(--error-red);
        }
    </style>

    <script>
        // Password validation
        const passwordInput = document.getElementById('password');
        const lengthIcon = document.getElementById('length-icon');
        const alphanumericIcon = document.getElementById('alphanumeric-icon');
        
        function validatePassword() {
            const password = passwordInput.value;
            
            // Length check (exactly 10 characters)
            if (password.length === 10) {
                lengthIcon.className = 'requirement-icon valid';
            } else {
                lengthIcon.className = 'requirement-icon invalid';
            }
            
            // Alphanumeric check
            if (/^[a-zA-Z0-9]+$/.test(password) && password.length > 0) {
                alphanumericIcon.className = 'requirement-icon valid';
            } else {
                alphanumericIcon.className = 'requirement-icon invalid';
            }
        }
        
        passwordInput.addEventListener('input', validatePassword);
        
        // Form validation
        document.getElementById('doctorForm').addEventListener('submit', function(e) {
            const did = document.querySelector('input[name="did"]').value;
            const name = document.querySelector('input[name="name"]').value;
            const contact = document.querySelector('input[name="contact"]').value;
            
            if (!did || !name || !contact) {
                e.preventDefault();
                alert('Please fill in all required fields.');
                return false;
            }
            
            if (contact.length !== 10) {
                e.preventDefault();
                alert('Contact number must be exactly 10 digits.');
                return false;
            }
        });
        
        // Clear form function
        function clearForm() {
            if (confirm('Are you sure you want to clear all form data?')) {
                document.getElementById('doctorForm').reset();
                validatePassword();
                document.getElementById('statusMessage').style.display = 'none';
            }
        }
        
        // Auto-hide status message
        document.addEventListener('DOMContentLoaded', function() {
            const statusMessage = document.getElementById('statusMessage');
            if (statusMessage && statusMessage.style.display !== 'none') {
                setTimeout(() => {
                    statusMessage.style.display = 'none';
                }, 5000);
            }
        });
        
        // Animate form elements
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
        });
    </script>
</body>
</html>