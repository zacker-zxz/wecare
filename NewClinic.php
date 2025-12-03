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
    <title>Add New Clinic - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .clinic-form-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .form-header {
            background: linear-gradient(135deg, var(--success-green), #059669);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="clinic-form" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23clinic-form)"/></svg>');
            opacity: 0.3;
        }

        .form-content {
            max-width: 700px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .clinic-form-card {
            background: var(--pure-white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-large);
            position: relative;
        }

        .form-card-header {
            background: linear-gradient(135deg, var(--success-green), #059669);
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="clinic-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23clinic-pattern)"/></svg>');
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

        .info-section {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            color: var(--success-green);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--success-green), #059669);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
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
    <div class="clinic-form-container">
        <div class="form-header">
            <div class="form-content">
                <div style="display: flex; align-items: center; justify-content: center; gap: 1rem;">
                    <i class="fas fa-hospital" style="font-size: 2rem;"></i>
                    <h1>Add New Clinic</h1>
                </div>
            </div>
        </div>

        <div class="form-content">
            <?php
            if (isset($_POST['submit'])) {
                include 'DBconnect.php';
                
                $cid = $_POST['cid'];
                $name = $_POST['name'];
                $address = $_POST['address'];
                $town = $_POST['town'];
                $city = $_POST['city'];
                $contact = $_POST['contact'];
                
                // Check if CID already exists
                $check = "SELECT * FROM clinic WHERE CID = '$cid'";
                $result = mysqli_query($conn, $check);
                
                if (mysqli_num_rows($result) > 0) {
                    $status_class = 'error';
                    $status_message = 'Error: Clinic ID already exists. Please use a different ID.';
                } else {
                    $query = "INSERT INTO clinic (CID, name, address, town, city, contact) 
                             VALUES ('$cid', '$name', '$address', '$town', '$city', '$contact')";
                    
                    if (mysqli_query($conn, $query)) {
                        $status_class = 'success';
                        $status_message = 'Clinic registered successfully!';
                        
                        // Clear form data on success
                        $_POST = array();
                    } else {
                        $status_class = 'error';
                        $status_message = 'Error: ' . mysqli_error($conn);
                    }
                }
            }
            ?>

            <div class="clinic-form-card">
                <div class="form-card-header">
                    <h1><i class="fas fa-clinic-medical"></i> Clinic Registration</h1>
                    <p>Register a new medical facility to the system</p>
                </div>
                
                <div class="form-card-body">
                    <div class="info-section">
                        <div class="info-header">
                            <div class="info-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <span>Registration Information</span>
                        </div>
                        <p style="margin: 0; color: var(--dark-gray);">
                            Please provide accurate information for the new clinic. All fields marked with * are required.
                            The contact number should be a valid 10-digit mobile or landline number.
                        </p>
                    </div>
                    
                    <form method="POST" action="" id="clinicForm">
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label class="form-label">Clinic ID <span class="required">*</span></label>
                                <input type="number" class="form-control" name="cid" 
                                       value="<?php echo isset($_POST['cid']) ? $_POST['cid'] : ''; ?>" 
                                       required min="1" placeholder="Unique clinic identifier">
                            </div>
                            
                            <div class="form-group full-width">
                                <label class="form-label">Clinic Name <span class="required">*</span></label>
                                <input type="text" class="form-control" name="name" 
                                       value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" 
                                       required placeholder="Enter clinic name">
                            </div>
                            
                            <div class="form-group full-width">
                                <label class="form-label">Complete Address <span class="required">*</span></label>
                                <textarea class="form-control" name="address" rows="3" required 
                                          placeholder="Enter complete clinic address"><?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Area/Locality <span class="required">*</span></label>
                                <input type="text" class="form-control" name="town" 
                                       value="<?php echo isset($_POST['town']) ? $_POST['town'] : ''; ?>" 
                                       required placeholder="Area or locality name">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">City <span class="required">*</span></label>
                                <input type="text" class="form-control" name="city" 
                                       value="<?php echo isset($_POST['city']) ? $_POST['city'] : ''; ?>" 
                                       required placeholder="City name">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Contact Number <span class="required">*</span></label>
                                <input type="tel" class="form-control" name="contact" 
                                       value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : ''; ?>" 
                                       required pattern="[0-9]{10}" placeholder="10-digit contact number">
                            </div>
                        </div>
                        
                        <div id="statusMessage" class="status-message" style="display: <?php echo isset($status_message) ? 'block' : 'none'; ?>;">
                            <?php echo isset($status_message) ? $status_message : ''; ?>
                        </div>
                    </form>
                </div>
                
                <div class="form-actions">
                    <div class="action-buttons">
                        <button type="submit" form="clinicForm" name="submit" class="btn btn-success">
                            <i class="fas fa-hospital"></i> Register Clinic
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
        // Form validation
        document.getElementById('clinicForm').addEventListener('submit', function(e) {
            const cid = document.querySelector('input[name="cid"]').value;
            const name = document.querySelector('input[name="name"]').value;
            const contact = document.querySelector('input[name="contact"]').value;
            
            if (!cid || !name || !contact) {
                e.preventDefault();
                alert('Please fill in all required fields.');
                return false;
            }
            
            if (contact.length !== 10) {
                e.preventDefault();
                alert('Contact number must be exactly 10 digits.');
                return false;
            }
            
            // Show loading state
            const submitButton = document.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Registering...';
            submitButton.disabled = true;
            
            setTimeout(() => {
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            }, 2000);
        });
        
        // Clear form function
        function clearForm() {
            if (confirm('Are you sure you want to clear all form data?')) {
                document.getElementById('clinicForm').reset();
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
            const formCard = document.querySelector('.clinic-form-card');
            formCard.style.opacity = '0';
            formCard.style.transform = 'translateY(30px)';
            formCard.style.transition = 'all 0.6s ease';
            
            setTimeout(() => {
                formCard.style.opacity = '1';
                formCard.style.transform = 'translateY(0)';
            }, 200);
            
            const infoSection = document.querySelector('.info-section');
            setTimeout(() => {
                infoSection.style.opacity = '0';
                infoSection.style.transform = 'translateY(20px)';
                infoSection.style.transition = 'all 0.5s ease';
                setTimeout(() => {
                    infoSection.style.opacity = '1';
                    infoSection.style.transform = 'translateY(0)';
                }, 100);
            }, 400);
        });
    </script>
</body>
</html>