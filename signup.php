<?php
// Patient Registration Page - Professional Hospital Theme
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div style="min-height: 100vh; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 2rem 0;">
        <div style="max-width: 800px; margin: 0 auto; padding: 0 2rem;">
            <div style="background: var(--pure-white); border-radius: 20px; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
                <div style="background: linear-gradient(135deg, #2563eb, #3b82f6); padding: 2rem; text-align: center;">
                    <h1 style="color: white; margin: 0;"><i class="fas fa-user-plus"></i> Patient Registration</h1>
                    <p style="color: rgba(255,255,255,0.9); margin: 0.5rem 0 0 0;">Join WeCare and access quality healthcare services</p>
                </div>

                <div style="padding: 3rem 2rem;">
                    <form method="POST" action="InsertSgnup.php">
                        <div style="display: grid; gap: 2rem;">
                            <!-- Personal Information -->
                            <div style="background: #f8fafc; border-radius: 12px; padding: 1.5rem;">
                                <h3 style="color: #2563eb; margin-bottom: 1rem;"><i class="fas fa-user"></i> Personal Information</h3>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div>
                                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Full Name *</label>
                                        <input type="text" name="name" class="form-control" required placeholder="Enter your full name">
                                    </div>
                                    <div>
                                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Gender *</label>
                                        <select name="gender" class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Date of Birth *</label>
                                        <input type="date" name="DOB" class="form-control" required>
                                    </div>
                                    <div>
                                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Contact Number *</label>
                                        <input type="tel" name="contact" class="form-control" required pattern="[0-9]{10}" placeholder="10-digit number">
                                    </div>
                                </div>
                            </div>

                            <!-- Account Information -->
                            <div style="background: #f8fafc; border-radius: 12px; padding: 1.5rem;">
                                <h3 style="color: #2563eb; margin-bottom: 1rem;"><i class="fas fa-envelope"></i> Account Information</h3>
                                <div style="display: grid; gap: 1rem;">
                                    <div>
                                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email Address *</label>
                                        <input type="email" name="email" class="form-control" required placeholder="Enter your email">
                                    </div>
                                    <div>
                                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Username *</label>
                                        <input type="text" name="username" class="form-control" required placeholder="Choose a username">
                                    </div>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div>
                                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Password *</label>
                                            <input type="password" name="pwd" class="form-control" required placeholder="Create password">
                                        </div>
                                        <div>
                                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Confirm Password *</label>
                                            <input type="password" name="pwdr" class="form-control" required placeholder="Confirm password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms -->
                            <div style="background: rgba(245, 113, 22, 0.1); border: 1px solid rgba(245, 113, 22, 0.2); border-radius: 8px; padding: 1rem;">
                                <label style="display: flex; align-items: flex-start; gap: 0.5rem; cursor: pointer;">
                                    <input type="checkbox" name="terms" required style="margin-top: 0.25rem;">
                                    <span style="font-size: 0.9rem;">I agree to the Terms of Service and Privacy Policy</span>
                                </label>
                            </div>
                        </div>

                        <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e2e8f0;">
                            <button type="submit" name="signup" class="btn btn-primary" style="margin-right: 1rem;">
                                <i class="fas fa-user-plus"></i> Create Account
                            </button>
                            <a href="Home.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Home
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-secondary {
            background: white;
            color: #2563eb;
            border: 2px solid #2563eb;
        }

        .btn-secondary:hover {
            background: #2563eb;
            color: white;
        }
    </style>
</body>
</html>