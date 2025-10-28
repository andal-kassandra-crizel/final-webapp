<?php
include 'dbconnection.php';

header('Content-Type: application/json');

if (!isset($_GET['category_id'])) {
  echo json_encode([]);
  exit;
}

$category_id = $_GET['category_id'];

try {
  $stmt = $pdo->prepare("SELECT service_id, service_name FROM services WHERE category_id = :category_id ORDER BY service_name ASC");
  $stmt->execute(['category_id' => $category_id]);
  $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($services);
} catch (PDOException $e) {
  echo json_encode([]);
}

?>