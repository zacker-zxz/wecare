<?php
// Database Population Script
// Clears existing data and adds realistic doctors and clinics

include 'DBconnect.php';

echo "<h1>Database Population Script</h1>";
echo "<h2>Clearing existing data...</h2>";

// Clear existing data in correct order (due to foreign key constraints)
$clear_queries = [
    "DELETE FROM doctor_available",
    "DELETE FROM booking",
    "DELETE FROM patient",
    "DELETE FROM doctor",
    "DELETE FROM clinic",
    "DELETE FROM admintable"
];

foreach ($clear_queries as $query) {
    if (mysqli_query($conn, $query)) {
        echo "<p style='color: green;'>✓ Cleared: " . substr($query, 12) . "</p>";
    } else {
        echo "<p style='color: red;'>✗ Failed to clear: " . substr($query, 12) . " - " . mysqli_error($conn) . "</p>";
    }
}

// Reset auto-increment counters
$reset_queries = [
    "ALTER TABLE admintable AUTO_INCREMENT = 1",
    "ALTER TABLE patient AUTO_INCREMENT = 1",
    "ALTER TABLE clinic AUTO_INCREMENT = 1",
    "ALTER TABLE doctor AUTO_INCREMENT = 1"
];

foreach ($reset_queries as $query) {
    mysqli_query($conn, $query);
}

echo "<h2>Adding admin account...</h2>";

// Add admin account
$admin_query = "INSERT INTO admintable (username, password) VALUES ('admin', 'admin')";
if (mysqli_query($conn, $admin_query)) {
    echo "<p style='color: green;'>✓ Admin account created</p>";
} else {
    echo "<p style='color: red;'>✗ Failed to create admin: " . mysqli_error($conn) . "</p>";
}

echo "<h2>Adding realistic clinics...</h2>";

// Realistic clinics in Hyderabad and Bangalore
$clinics = [
    [1, "Apollo Hospitals Jubilee Hills", "Road No. 72, Film Nagar, Jubilee Hills", "Jubilee Hills", "Hyderabad", "04023607777"],
    [2, "MaxCure Hospitals Hitech City", "Behind Cyber Towers, Hitech City", "Hitech City", "Hyderabad", "04061656363"],
    [3, "Continental Hospitals Gachibowli", "Plot No. 3, Road No. 2, IT & Financial Dist", "Gachibowli", "Hyderabad", "04061626363"],
    [4, "CARE Hospitals Banjara Hills", "Road No. 1, Banjara Hills", "Banjara Hills", "Hyderabad", "04030418888"],
    [5, "Yashoda Hospitals Somajiguda", "Raj Bhavan Road, Somajiguda", "Somajiguda", "Hyderabad", "04045674646"],
    [6, "Manipal Hospitals Whitefield", "Sarjapur Road, Opposite Iblur", "Whitefield", "Bangalore", "08046024600"],
    [7, "Fortis Hospital Cunningham Road", "14, Cunningham Road, Vasanth Nagar", "Cunningham Road", "Bangalore", "08041994444"],
    [8, "Columbia Asia Hebbal", "Kirloskar Business Park, Bellary Road", "Hebbal", "Bangalore", "08041791000"],
    [9, "Rainbow Children's Hospital Marathahalli", "Survey No. 8/5, Marathahalli-Sarjapur Outer Ring Road", "Marathahalli", "Bangalore", "08067666666"],
    [10, "Sakra World Hospital Varthur", "SY No. 52/2 & 52/3, Devarabeesanahalli, Varthur Hobli", "Varthur", "Bangalore", "08048716000"]
];

foreach ($clinics as $clinic) {
    $clinic_query = "INSERT INTO clinic (CID, name, address, town, city, contact) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $clinic_query);
    mysqli_stmt_bind_param($stmt, "isssss", $clinic[0], $clinic[1], $clinic[2], $clinic[3], $clinic[4], $clinic[5]);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p style='color: green;'>✓ Added clinic: " . $clinic[1] . "</p>";
    } else {
        echo "<p style='color: red;'>✗ Failed to add clinic: " . $clinic[1] . " - " . mysqli_error($conn) . "</p>";
    }
    mysqli_stmt_close($stmt);
}

echo "<h2>Adding realistic doctors...</h2>";

// Realistic doctors with various specializations
$doctors = [
    [101, "Dr. Rajesh Kumar", "male", "1975-03-15", "25", "Cardiologist", "9876543210", "Plot 123, Jubilee Hills", "rajesh_kumar", "password123", "Hyderabad"],
    [102, "Dr. Priya Sharma", "female", "1980-07-22", "18", "Gynecologist", "9876543211", "Road No. 5, Banjara Hills", "priya_sharma", "password123", "Hyderabad"],
    [103, "Dr. Amit Patel", "male", "1978-11-10", "22", "Orthopedic Surgeon", "9876543212", "Hitech City Main Road", "amit_patel", "password123", "Hyderabad"],
    [104, "Dr. Sunita Reddy", "female", "1982-05-08", "16", "Dermatologist", "9876543213", "Gachibowli", "sunita_reddy", "password123", "Hyderabad"],
    [105, "Dr. Vikram Singh", "male", "1976-09-30", "24", "Neurologist", "9876543214", "Somajiguda", "vikram_singh", "password123", "Hyderabad"],
    [106, "Dr. Meera Joshi", "female", "1985-01-14", "13", "Pediatrician", "9876543215", "Jubilee Hills", "meera_joshi", "password123", "Hyderabad"],
    [107, "Dr. Karan Gupta", "male", "1981-12-03", "17", "Ophthalmologist", "9876543216", "Hitech City", "karan_gupta", "password123", "Hyderabad"],
    [108, "Dr. Anjali Desai", "female", "1979-06-25", "21", "Endocrinologist", "9876543217", "Banjara Hills", "anjali_desai", "password123", "Hyderabad"],
    [109, "Dr. Rohit Verma", "male", "1983-08-17", "15", "Urologist", "9876543218", "Gachibowli", "rohit_verma", "password123", "Hyderabad"],
    [110, "Dr. Kavita Nair", "female", "1984-04-12", "14", "Psychiatrist", "9876543219", "Somajiguda", "kavita_nair", "password123", "Hyderabad"],
    [111, "Dr. Arjun Rao", "male", "1977-02-28", "23", "General Surgeon", "9876543220", "Whitefield", "arjun_rao", "password123", "Bangalore"],
    [112, "Dr. Nandini Iyer", "female", "1986-10-05", "12", "Dentist", "9876543221", "Cunningham Road", "nandini_iyer", "password123", "Bangalore"],
    [113, "Dr. Suresh Babu", "male", "1974-07-19", "26", "Pulmonologist", "9876543222", "Hebbal", "suresh_babu", "password123", "Bangalore"],
    [114, "Dr. Lakshmi Venkatesh", "female", "1981-03-22", "17", "Rheumatologist", "9876543223", "Marathahalli", "lakshmi_venkatesh", "password123", "Bangalore"],
    [115, "Dr. Manoj Kumar", "male", "1979-11-08", "21", "Nephrologist", "9876543224", "Varthur", "manoj_kumar", "password123", "Bangalore"]
];

foreach ($doctors as $doctor) {
    $doctor_query = "INSERT INTO doctor (DID, name, gender, dob, experience, specialisation, contact, address, username, password, region) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $doctor_query);
    mysqli_stmt_bind_param($stmt, "issssssssss", $doctor[0], $doctor[1], $doctor[2], $doctor[3], $doctor[4], $doctor[5], $doctor[6], $doctor[7], $doctor[8], $doctor[9], $doctor[10]);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p style='color: green;'>✓ Added doctor: " . $doctor[1] . " (" . $doctor[5] . ")</p>";
    } else {
        echo "<p style='color: red;'>✗ Failed to add doctor: " . $doctor[1] . " - " . mysqli_error($conn) . "</p>";
    }
    mysqli_stmt_close($stmt);
}

echo "<h2>Assigning doctors to clinics...</h2>";

// Doctor-Clinic assignments (doctor_available table)
$assignments = [
    // Hyderabad Clinics
    [1, 101, "Monday", "09:00:00", "17:00:00"],
    [1, 101, "Wednesday", "09:00:00", "17:00:00"],
    [1, 101, "Friday", "09:00:00", "17:00:00"],
    [1, 102, "Tuesday", "10:00:00", "16:00:00"],
    [1, 102, "Thursday", "10:00:00", "16:00:00"],
    [1, 106, "Monday", "08:00:00", "14:00:00"],
    [1, 106, "Wednesday", "08:00:00", "14:00:00"],

    [2, 103, "Monday", "09:00:00", "17:00:00"],
    [2, 103, "Tuesday", "09:00:00", "17:00:00"],
    [2, 103, "Thursday", "09:00:00", "17:00:00"],
    [2, 104, "Wednesday", "10:00:00", "18:00:00"],
    [2, 104, "Friday", "10:00:00", "18:00:00"],
    [2, 107, "Tuesday", "08:00:00", "16:00:00"],

    [3, 105, "Monday", "09:00:00", "17:00:00"],
    [3, 105, "Wednesday", "09:00:00", "17:00:00"],
    [3, 105, "Friday", "09:00:00", "17:00:00"],
    [3, 108, "Tuesday", "10:00:00", "16:00:00"],
    [3, 108, "Thursday", "10:00:00", "16:00:00"],
    [3, 109, "Monday", "08:00:00", "14:00:00"],

    [4, 102, "Monday", "09:00:00", "15:00:00"],
    [4, 102, "Wednesday", "09:00:00", "15:00:00"],
    [4, 104, "Tuesday", "10:00:00", "16:00:00"],
    [4, 104, "Thursday", "10:00:00", "16:00:00"],
    [4, 110, "Friday", "11:00:00", "17:00:00"],

    [5, 101, "Tuesday", "08:00:00", "16:00:00"],
    [5, 101, "Thursday", "08:00:00", "16:00:00"],
    [5, 105, "Monday", "09:00:00", "17:00:00"],
    [5, 105, "Wednesday", "09:00:00", "17:00:00"],
    [5, 107, "Friday", "10:00:00", "18:00:00"],

    // Bangalore Clinics
    [6, 111, "Monday", "09:00:00", "17:00:00"],
    [6, 111, "Wednesday", "09:00:00", "17:00:00"],
    [6, 111, "Friday", "09:00:00", "17:00:00"],
    [6, 112, "Tuesday", "10:00:00", "16:00:00"],
    [6, 112, "Thursday", "10:00:00", "16:00:00"],
    [6, 114, "Monday", "08:00:00", "14:00:00"],

    [7, 113, "Monday", "09:00:00", "17:00:00"],
    [7, 113, "Tuesday", "09:00:00", "17:00:00"],
    [7, 113, "Thursday", "09:00:00", "17:00:00"],
    [7, 112, "Wednesday", "10:00:00", "18:00:00"],
    [7, 112, "Friday", "10:00:00", "18:00:00"],

    [8, 111, "Tuesday", "08:00:00", "16:00:00"],
    [8, 111, "Thursday", "08:00:00", "16:00:00"],
    [8, 113, "Monday", "09:00:00", "17:00:00"],
    [8, 113, "Wednesday", "09:00:00", "17:00:00"],

    [9, 114, "Monday", "09:00:00", "15:00:00"],
    [9, 114, "Wednesday", "09:00:00", "15:00:00"],
    [9, 114, "Friday", "09:00:00", "15:00:00"],
    [9, 112, "Tuesday", "10:00:00", "16:00:00"],
    [9, 112, "Thursday", "10:00:00", "16:00:00"],

    [10, 111, "Monday", "08:00:00", "16:00:00"],
    [10, 111, "Tuesday", "08:00:00", "16:00:00"],
    [10, 111, "Thursday", "08:00:00", "16:00:00"],
    [10, 113, "Wednesday", "09:00:00", "17:00:00"],
    [10, 113, "Friday", "09:00:00", "17:00:00"],
    [10, 115, "Monday", "10:00:00", "18:00:00"]
];

foreach ($assignments as $assignment) {
    $assignment_query = "INSERT INTO doctor_available (CID, DID, day, starttime, endtime) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $assignment_query);
    mysqli_stmt_bind_param($stmt, "iisss", $assignment[0], $assignment[1], $assignment[2], $assignment[3], $assignment[4]);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p style='color: green;'>✓ Assigned Doctor ID " . $assignment[1] . " to Clinic ID " . $assignment[0] . " (" . $assignment[2] . ")</p>";
    } else {
        echo "<p style='color: red;'>✗ Failed to assign Doctor ID " . $assignment[1] . " to Clinic ID " . $assignment[0] . " - " . mysqli_error($conn) . "</p>";
    }
    mysqli_stmt_close($stmt);
}

echo "<h2>Adding sample patients...</h2>";

// Add some sample patients
$patients = [
    [1, "Rahul Sharma", "male", "1990-05-15", "9876543225", "rahul_sharma", "password123", "rahul.sharma@email.com"],
    [2, "Priya Patel", "female", "1988-03-22", "9876543226", "priya_patel", "password123", "priya.patel@email.com"],
    [3, "Amit Kumar", "male", "1992-08-10", "9876543227", "amit_kumar", "password123", "amit.kumar@email.com"],
    [4, "Sneha Reddy", "female", "1985-12-03", "9876543228", "sneha_reddy", "password123", "sneha.reddy@email.com"],
    [5, "Vikram Singh", "male", "1987-07-18", "9876543229", "vikram_singh", "password123", "vikram.singh@email.com"]
];

foreach ($patients as $patient) {
    $patient_query = "INSERT INTO patient (id, name, gender, dob, phone, username, password, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $patient_query);
    mysqli_stmt_bind_param($stmt, "isssssss", $patient[0], $patient[1], $patient[2], $patient[3], $patient[4], $patient[5], $patient[6], $patient[7]);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p style='color: green;'>✓ Added patient: " . $patient[1] . " (Username: " . $patient[5] . ")</p>";
    } else {
        echo "<p style='color: red;'>✗ Failed to add patient: " . $patient[1] . " - " . mysqli_error($conn) . "</p>";
    }
    mysqli_stmt_close($stmt);
}

echo "<h2>Database population completed!</h2>";
echo "<p><strong>Summary:</strong></p>";
echo "<ul>";
echo "<li>10 Realistic Clinics (5 in Hyderabad, 5 in Bangalore)</li>";
echo "<li>15 Specialized Doctors across various medical fields</li>";
echo "<li>50+ Doctor-Clinic assignments with realistic schedules</li>";
echo "<li>5 Sample patients for testing</li>";
echo "<li>1 Admin account (admin/admin)</li>";
echo "</ul>";

echo "<p><a href='Home.php' style='color: blue; text-decoration: none;'>← Back to Home Page</a></p>";

mysqli_close($conn);
?>