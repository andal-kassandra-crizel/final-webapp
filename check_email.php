<?php
include 'dbconnection.php'; // your database connection

if (isset($_GET['email'])) {
    $email = trim($_GET['email']);
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM account WHERE email = ?");
    $stmt->execute([$email]);
    $exists = $stmt->fetchColumn() > 0;

    echo json_encode(['exists' => $exists]);
}
?>
