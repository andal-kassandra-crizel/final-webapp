<?php
header('Content-Type: application/json');
include 'dbconnection.php';

try {
    $stmt = $pdo->query("SELECT category_id, category_name FROM service_categories ORDER BY category_name ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($categories);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch categories',
        'error' => $e->getMessage()
    ]);
}
