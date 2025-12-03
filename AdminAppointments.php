<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}

include 'DBconnect.php';

// Handle status update
if(isset($_POST['update_status'])) {
    $username = $_POST['username'];
    $timestamp = $_POST['timestamp'];
    $new_status = $_POST['new_status'];
    
    $update_query = "UPDATE booking SET Status = '$new_status' WHERE username = '$username' AND Timestamp = '$timestamp'";
    if(mysqli_query($conn, $update_query)) {
        $success_message = "Appointment status updated successfully!";
    } else {
        $error_message = "Error updating status: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments - Admin Dashboard</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .appointments-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .appointments-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .appointments-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="appointments-grid" x="0" y="0" width="25" height="25" patternUnits="userSpaceOnUse"><path d="M 25 0 L 0 0 0 25" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23appointments-grid)"/></svg>');
            opacity: 0.3;
        }

        .appointments-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 2;
        }

        .header-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            color: var(--pure-white);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-2px);
        }

        .appointments-card {
            background: var(--pure-white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-large);
            margin-bottom: 2rem;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem;
            position: relative;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="card-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23card-pattern)"/></svg>');
            opacity: 0.3;
        }

        .card-header h2 {
            margin: 0 0 0.5rem 0;
            font-size: 1.75rem;
            position: relative;
            z-index: 2;
        }

        .card-header p {
            margin: 0;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        .card-body {
            padding: 2rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error-red);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .filters-section {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-gray);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .appointments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .appointments-table th,
        .appointments-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .appointments-table th {
            background: #f8fafc;
            font-weight: 600;
            color: var(--dark-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }

        .appointments-table tr:hover {
            background: #f8fafc;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-registered {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .status-confirmed {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
        }

        .status-cancelled {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error-red);
        }

        .status-completed {
            background: rgba(107, 114, 128, 0.1);
            color: #6b7280;
        }

        .action-button {
            background: var(--primary-blue);
            color: var(--pure-white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
        }

        .action-button:hover {
            background: var(--dark-blue);
            transform: translateY(-1px);
        }

        .action-button.danger {
            background: var(--error-red);
        }

        .action-button.danger:hover {
            background: #dc2626;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: var(--pure-white);
            margin: 10% auto;
            padding: 2rem;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            box-shadow: var(--shadow-large);
        }

        .close {
            color: var(--medium-gray);
            float: right;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: var(--dark-gray);
        }

        @media (max-width: 768px) {
            .appointments-table {
                font-size: 0.9rem;
            }
            
            .appointments-table th,
            .appointments-table td {
                padding: 0.5rem;
            }
            
            .header-actions {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>
    <div class="appointments-container">
        <div class="appointments-header">
            <div class="appointments-content" style="position: relative; z-index: 2;">
                <div class="header-actions">
                    <div>
                        <h1><i class="fas fa-calendar-check"></i> Manage Appointments</h1>
                        <p>View and manage all patient appointments</p>
                    </div>
                    <a href="AdminPage.php" class="back-button">
                        <i class="fas fa-arrow-left"></i>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="appointments-content">
            <?php if(isset($success_message)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if(isset($error_message)): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <div class="appointments-card">
                <div class="card-header">
                    <h2><i class="fas fa-list"></i> All Appointments</h2>
                    <p>Complete list of all patient appointments in the system</p>
                </div>

                <div class="card-body">
                    <div class="filters-section">
                        <div class="filters-grid">
                            <div class="form-group">
                                <label class="form-label">Filter by Status</label>
                                <select class="form-control" id="statusFilter" onchange="filterAppointments()">
                                    <option value="">All Statuses</option>
                                    <option value="Booking Registered.Wait for the update">Pending</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled by Patient">Cancelled</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Filter by Date</label>
                                <input type="date" class="form-control" id="dateFilter" onchange="filterAppointments()">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Search Patient</label>
                                <input type="text" class="form-control" id="patientFilter" placeholder="Search by username or name" onkeyup="filterAppointments()">
                            </div>
                        </div>
                    </div>

                    <table class="appointments-table" id="appointmentsTable">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Clinic</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT b.*, d.name as doctor_name, d.specialisation, c.name as clinic_name, c.city
                                     FROM booking b
                                     JOIN doctor d ON b.DID = d.DID
                                     JOIN clinic c ON b.CID = c.CID
                                     ORDER BY b.DOV DESC, b.Timestamp DESC";
                            
                            $result = mysqli_query($conn, $query);
                            
                            if(mysqli_num_rows($result) > 0):
                                while($row = mysqli_fetch_assoc($result)):
                                    $statusClass = '';
                                    $statusText = strtolower($row['Status']);
                                    if(strpos($statusText, 'booking') !== false) $statusClass = 'status-registered';
                                    elseif(strpos($statusText, 'confirmed') !== false) $statusClass = 'status-confirmed';
                                    elseif(strpos($statusText, 'cancelled') !== false) $statusClass = 'status-cancelled';
                                    elseif(strpos($statusText, 'completed') !== false) $statusClass = 'status-completed';
                            ?>
                            <tr class="appointment-row">
                                <td>
                                    <strong><?php echo htmlspecialchars($row['Fname']); ?></strong><br>
                                    <small style="color: var(--medium-gray);">@<?php echo htmlspecialchars($row['username']); ?></small><br>
                                    <small><?php echo htmlspecialchars($row['gender']); ?></small>
                                </td>
                                <td>
                                    <strong>Dr. <?php echo htmlspecialchars($row['doctor_name']); ?></strong><br>
                                    <small style="color: var(--medium-gray);"><?php echo htmlspecialchars($row['specialisation']); ?></small>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($row['clinic_name']); ?></strong><br>
                                    <small style="color: var(--medium-gray);"><?php echo htmlspecialchars($row['city']); ?></small>
                                </td>
                                <td>
                                    <strong><?php echo date('M j, Y', strtotime($row['DOV'])); ?></strong><br>
                                    <small style="color: var(--medium-gray);"><?php echo date('g:i A', strtotime($row['Timestamp'])); ?></small>
                                </td>
                                <td>
                                    <span class="status-badge <?php echo $statusClass; ?>">
                                        <?php echo htmlspecialchars($row['Status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="action-button" onclick="updateStatus('<?php echo $row['username']; ?>', '<?php echo $row['Timestamp']; ?>', '<?php echo htmlspecialchars($row['Status']); ?>')">
                                        <i class="fas fa-edit"></i> Update
                                    </button>
                                </td>
                            </tr>
                            <?php 
                                endwhile;
                            else:
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 2rem; color: var(--medium-gray);">
                                    <i class="fas fa-calendar-times" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                    No appointments found
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3><i class="fas fa-edit"></i> Update Appointment Status</h3>
            <form method="POST" id="statusForm">
                <input type="hidden" name="username" id="modalUsername">
                <input type="hidden" name="timestamp" id="modalTimestamp">
                
                <div class="form-group" style="margin: 1.5rem 0;">
                    <label class="form-label">New Status</label>
                    <select name="new_status" class="form-control" required>
                        <option value="Booking Registered.Wait for the update">Pending</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled by Patient">Cancelled by Patient</option>
                        <option value="Cancelled by Admin">Cancelled by Admin</option>
                        <option value="No Show">No Show</option>
                    </select>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" class="action-button" onclick="closeModal()" style="background: var(--medium-gray);">
                        Cancel
                    </button>
                    <button type="submit" name="update_status" class="action-button">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function filterAppointments() {
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const dateFilter = document.getElementById('dateFilter').value;
            const patientFilter = document.getElementById('patientFilter').value.toLowerCase();
            
            const rows = document.querySelectorAll('.appointment-row');
            
            rows.forEach(row => {
                const status = row.cells[4].textContent.toLowerCase();
                const date = row.cells[3].textContent;
                const patient = row.cells[0].textContent.toLowerCase();
                
                let show = true;
                
                if(statusFilter && !status.includes(statusFilter)) {
                    show = false;
                }
                
                if(dateFilter && !date.includes(dateFilter)) {
                    show = false;
                }
                
                if(patientFilter && !patient.includes(patientFilter)) {
                    show = false;
                }
                
                row.style.display = show ? '' : 'none';
            });
        }

        function updateStatus(username, timestamp, currentStatus) {
            document.getElementById('modalUsername').value = username;
            document.getElementById('modalTimestamp').value = timestamp;
            document.getElementById('statusModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('statusModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('statusModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Animate table rows
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.appointment-row');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                row.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>