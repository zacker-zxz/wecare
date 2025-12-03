<?php
require_once("DBconnect.php");

$clinicId = isset($_POST['clinic']) ? $_POST['clinic'] : '';
$specialty = isset($_POST['specialty']) ? $_POST['specialty'] : '';
$region = isset($_POST['region']) ? $_POST['region'] : '';

$query = "SELECT DISTINCT d.*, c.name as clinic_name, c.city
          FROM doctor d
          LEFT JOIN doctor_available da ON d.DID = da.DID
          LEFT JOIN clinic c ON da.CID = c.CID
          WHERE 1=1";

if (!empty($clinicId)) {
    $query .= " AND da.CID = '" . $conn->real_escape_string($clinicId) . "'";
}

if (!empty($specialty)) {
    $query .= " AND d.specialisation = '" . $conn->real_escape_string($specialty) . "'";
}

if (!empty($region)) {
    $query .= " AND d.region = '" . $conn->real_escape_string($region) . "'";
}

$query .= " ORDER BY d.name";

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
    echo '<p>No doctors match your search criteria. Try adjusting your filters.</p>';
    echo '</div>';
}

$conn->close();
?>