<?php
header('Content-Type: application/json');
include 'dbconnection.php';


if (!isset($_GET['category_id']) || empty($_GET['category_id'])) {
    echo json_encode([]);
    exit;
}

$category_id = $_GET['category_id'];

try {
    $stmt = $pdo->prepare("SELECT doctor_id, doctor_name FROM doctors WHERE category_id = ? AND status = 'active'");
    $stmt->execute([$category_id]);
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($doctors);
} catch (Exception $e) {
    http_response_code(500);
     echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch doctors',
        'error' => $e->getMessage()
    ]);
}
?>
