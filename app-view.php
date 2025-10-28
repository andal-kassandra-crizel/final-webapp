<?php
include 'dbconnection.php';

session_start();

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
    SELECT a.*, s.service_name, d.doctor_name
    FROM appointments a
    JOIN services s ON a.service_id = s.service_id
    JOIN doctors d ON a.doctor_id = d.doctor_id
    WHERE a.appointment_id = :aid AND a.user_id = :uid
";
$stmt = $pdo->prepare($sql);
$stmt->execute(['aid' => $appointment_id, 'uid' => $user_id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    echo "<p style='color:red; text-align:center;'>Appointment not found!</p>";
    exit;
}

?>