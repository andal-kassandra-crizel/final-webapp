<?php
include 'dbconnection.php';


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Check if appointment ID is provided
if (!isset($_GET['id'])) {
    header("Location: profile.php");
    exit;
}

$appointment_id = $_GET['id'];

// Fetch appointment details
$sql = "
SELECT a.*, s.service_name, s.category_id, c.category_name, d.doctor_name
FROM appointments a
JOIN services s ON a.service_id = s.service_id
JOIN doctors d ON a.doctor_id = d.doctor_id
JOIN service_categories c ON s.category_id = c.category_id
WHERE a.appointment_id = :aid AND a.user_id = :uid
";
$stmt = $pdo->prepare($sql);
$stmt->execute(['aid' => $appointment_id, 'uid' => $user_id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    echo "<p style='color:red; text-align:center;'>Appointment not found!</p>";
    exit;
}

// Fetch all categories
$categories = $pdo->query("SELECT * FROM service_categories ORDER BY category_name ASC")->fetchAll(PDO::FETCH_ASSOC);

$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $appointment['status'] === 'Pending') {
    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $lastname = trim($_POST['lastname']);
    $appointment_date = $_POST['appointment_date'];
    $category_id = $_POST['category'];
    $service_id = $_POST['service'];
    $doctor_id = $_POST['doctor'];

    if (empty($firstname) || empty($lastname) || empty($appointment_date)) {
        $error = "Please fill in all required fields.";
    } else {
        $update = "
        UPDATE appointments
        SET firstname = :fname,
            middlename = :mname,
            lastname = :lname,
            appointment_date = :adate,
            service_id = :sid,
            doctor_id = :did
        WHERE appointment_id = :aid AND user_id = :uid
        ";
        $stmt = $pdo->prepare($update);
        $stmt->execute([
            'fname' => $firstname,
            'mname' => $middlename,
            'lname' => $lastname,
            'adate' => $appointment_date,
            'sid' => $service_id,
            'did' => $doctor_id,
            'aid' => $appointment_id,
            'uid' => $user_id
        ]);

        $_SESSION['message'] = "Appointment updated successfully!";
        header("Location: profile.php");
        exit;
    }
}

$readonly = $appointment['status'] !== 'Pending';
?>