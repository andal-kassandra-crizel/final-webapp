<?php
include 'dbconnection.php';

// Get number of users
$userCount = $pdo->query("SELECT COUNT(*) FROM account WHERE role = 'user'")->fetchColumn();

// Get number of all appointments
$approvedCount = $pdo->query("SELECT COUNT(*) FROM appointments WHERE status = 'Approved'")->fetchColumn();

// Get number of pending appointments
$pendingCount = $pdo->query("SELECT COUNT(*) FROM appointments WHERE status = 'Pending'")->fetchColumn();

// Get number of cancel appointments
$cancelCount = $pdo->query("SELECT COUNT(*) FROM appointments WHERE status = 'Cancelled'")->fetchColumn();



// PIE CHART: Most Booked Categories
$categoryQuery = $pdo->query("
    SELECT sc.category_name, COUNT(a.appointment_id) AS total
    FROM appointments a
    JOIN services s ON a.service_id = s.service_id
    JOIN service_categories sc ON s.category_id = sc.category_id
    GROUP BY sc.category_name
");

$categories = [];
$categoryTotals = [];
while ($row = $categoryQuery->fetch(PDO::FETCH_ASSOC)) {
    $categories[] = $row['category_name'];
    $categoryTotals[] = (int)$row['total'];
}


// BAR CHART: Age Distribution
$ageQuery = $pdo->query("
    SELECT 
        CASE 
            WHEN CAST(age AS UNSIGNED) < 13 THEN 'Child (0-12)'
            WHEN CAST(age AS UNSIGNED) BETWEEN 13 AND 19 THEN 'Teen (13-19)'
            WHEN CAST(age AS UNSIGNED) BETWEEN 20 AND 39 THEN 'Adult (20-39)'
            WHEN CAST(age AS UNSIGNED) BETWEEN 40 AND 59 THEN 'Middle-aged (40-59)'
            ELSE 'Senior (60+)' 
        END AS age_group,
        COUNT(*) AS total
    FROM appointments
    GROUP BY age_group
    ORDER BY age_group
");

$ageGroups = [];
$ageTotals = [];
while ($row = $ageQuery->fetch(PDO::FETCH_ASSOC)) {
    $ageGroups[] = $row['age_group'];
    $ageTotals[] = (int)$row['total'];
}


// LINE CHART: Appointments Over Time
$dateQuery = $pdo->query("
    SELECT DATE(appointment_date) AS date, COUNT(*) AS total_appointments
    FROM appointments
    GROUP BY DATE(appointment_date)
    ORDER BY date
");
$dates = [];
$dateTotals = [];
while ($row = $dateQuery->fetch(PDO::FETCH_ASSOC)) {
    $dates[] = $row['date'];
    $dateTotals[] = (int)$row['total_appointments'];
}

?>