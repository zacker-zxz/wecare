<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Doctors - WeCare</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .doctor-search-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .doctor-search-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .doctor-search-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="search-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23search-grid)"/></svg>');
            opacity: 0.3;
        }

        .doctor-search-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .search-filters {
            background: var(--pure-white);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-medium);
            margin-bottom: 2rem;
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-label {
            font-weight: 500;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
        }

        .filter-select {
            padding: 0.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background: var(--pure-white);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .doctor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .doctor-card {
            background: var(--pure-white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-medium);
            transition: var(--transition);
            border: 1px solid rgba(37, 99, 235, 0.1);
        }

        .doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-large);
        }

        .doctor-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 1.5rem;
            text-align: center;
        }

        .doctor-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
        }

        .doctor-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
        }

        .doctor-specialty {
            opacity: 0.9;
            font-size: 0.9rem;
            margin: 0;
        }

        .doctor-body {
            padding: 1.5rem;
        }

        .doctor-info {
            display: grid;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--medium-gray);
            font-size: 0.9rem;
        }

        .info-item i {
            color: var(--primary-blue);
            width: 16px;
        }

        .doctor-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-book {
            flex: 1;
            background: linear-gradient(135deg, var(--success-green), #059669);
            color: var(--pure-white);
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-book:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
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

        .no-doctors {
            text-align: center;
            padding: 3rem;
            color: var(--medium-gray);
        }

        .no-doctors i {
            font-size: 3rem;
            color: var(--light-gray);
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="doctor-search-container">
        <div class="doctor-search-header">
            <div class="doctor-search-content" style="position: relative; z-index: 2;">
                <h1><i class="fas fa-user-md"></i> Find Doctors</h1>
                <p>Search and connect with healthcare professionals</p>
            </div>
        </div>

        <div class="doctor-search-content">
            <a href="Login.php" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>

            <div class="search-filters">
                <h2 style="margin-bottom: 1.5rem; color: var(--dark-blue);">
                    <i class="fas fa-filter"></i> Search Filters
                </h2>
                <div class="filter-grid">
                    <div class="filter-group">
                        <label class="filter-label">Select Clinic</label>
                        <select class="filter-select" id="clinicSelect">
                            <option value="">All Clinics</option>
                            <?php
                            require_once("DBconnect.php");
                            $clinicQuery = "SELECT * FROM clinic ORDER BY name";
                            $clinicResult = $conn->query($clinicQuery);
                            while($clinic = $clinicResult->fetch_assoc()) {
                                echo "<option value='" . $clinic['CID'] . "'>" . $clinic['name'] . " - " . $clinic['city'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Specialization</label>
                        <select class="filter-select" id="specialtySelect">
                            <option value="">All Specializations</option>
                            <option value="Physician">Physician</option>
                            <option value="Neurosurgeon">Neurosurgeon</option>
                            <option value="General Dentistry">General Dentistry</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Region</label>
                        <select class="filter-select" id="regionSelect">
                            <option value="">All Regions</option>
                            <option value="Hyderabad">Hyderabad</option>
                            <option value="Bangalore">Bangalore</option>
                        </select>
                    </div>
                </div>
            </div>

            <div id="doctorsContainer">
                <?php
                // Default query to show all doctors if no filters applied
                $query = "SELECT d.*, c.name as clinic_name, c.city
                         FROM doctor d
                         LEFT JOIN doctor_available da ON d.DID = da.DID
                         LEFT JOIN clinic c ON da.CID = c.CID
                         ORDER BY d.name";

                $results = $conn->query($query);

                if ($results && $results->num_rows > 0) {
                    echo '<div class="doctor-grid">';
                    $displayedDoctors = array();

                    while($doctor = $results->fetch_assoc()) {
                        // Avoid duplicate doctors
                        if (!in_array($doctor['DID'], $displayedDoctors)) {
                            $displayedDoctors[] = $doctor['DID'];

                            echo '<div class="doctor-card">';
                            echo '<div class="doctor-header">';
                            echo '<div class="doctor-avatar">';
                            echo '<i class="fas fa-user-md"></i>';
                            echo '</div>';
                            echo '<h3 class="doctor-name">' . htmlspecialchars($doctor['name']) . '</h3>';
                            echo '<p class="doctor-specialty">' . htmlspecialchars($doctor['specialisation']) . '</p>';
                            echo '</div>';

                            echo '<div class="doctor-body">';
                            echo '<div class="doctor-info">';
                            echo '<div class="info-item"><i class="fas fa-graduation-cap"></i> ' . htmlspecialchars($doctor['experience']) . ' years experience</div>';
                            echo '<div class="info-item"><i class="fas fa-map-marker-alt"></i> ' . htmlspecialchars($doctor['region']) . '</div>';
                            echo '<div class="info-item"><i class="fas fa-phone"></i> ' . htmlspecialchars($doctor['contact']) . '</div>';
                            if (!empty($doctor['clinic_name'])) {
                                echo '<div class="info-item"><i class="fas fa-hospital"></i> ' . htmlspecialchars($doctor['clinic_name']) . '</div>';
                            }
                            echo '</div>';

                            echo '<div class="doctor-actions">';
                            echo '<a href="Booking.php?doctor=' . $doctor['DID'] . '" class="btn-book">';
                            echo '<i class="fas fa-calendar-plus"></i> Book Appointment';
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                } else {
                    echo '<div class="no-doctors">';
                    echo '<i class="fas fa-user-md"></i>';
                    echo '<h3>No Doctors Found</h3>';
                    echo '<p>No doctors are currently available. Please check back later.</p>';
                    echo '</div>';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script>
        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const clinicSelect = document.getElementById('clinicSelect');
            const specialtySelect = document.getElementById('specialtySelect');
            const regionSelect = document.getElementById('regionSelect');

            function filterDoctors() {
                const clinicId = clinicSelect.value;
                const specialty = specialtySelect.value;
                const region = regionSelect.value;

                // Create AJAX request to filter doctors
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'filter_doctors.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.getElementById('doctorsContainer').innerHTML = xhr.responseText;
                    }
                };

                const params = 'clinic=' + encodeURIComponent(clinicId) +
                             '&specialty=' + encodeURIComponent(specialty) +
                             '&region=' + encodeURIComponent(region);
                xhr.send(params);
            }

            // Add event listeners to filters
            clinicSelect.addEventListener('change', filterDoctors);
            specialtySelect.addEventListener('change', filterDoctors);
            regionSelect.addEventListener('change', filterDoctors);

            // Animate doctor cards on load
            const doctorCards = document.querySelectorAll('.doctor-card');
            doctorCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>