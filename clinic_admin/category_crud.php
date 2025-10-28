<?php
include 'dbconnection.php';
$record = []; // Initialize to avoid undefined variable warnings


if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
    $category_id = trim($_GET['category_id']);

    $sql = "SELECT * FROM service_categories WHERE category_id = :catId";
    $data = [':catId' => $category_id];

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$record) {
            echo "<script>alert('Category not found.'); window.location.href='service-category_tbl.php';</script>";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error fetching record: " . $e->getMessage();
        exit;
    }
}  


if (isset($_POST['update'])) {
    $category_id = trim($_POST['category_id']);
    $category_name = trim($_POST['category_name']);

    // Basic validation
    if (empty($category_name)) {
        echo "<script>alert('Please fill out all fields.'); window.history.back();</script>";
        exit;
    }

    $sql = "UPDATE service_categories 
            SET  category_name = :category_name  
            WHERE category_id = :catId";

    $data = [
        ':category_name' => $category_name,
        ':catId' => $category_id
    ];

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        echo "<script>
            alert('Category updated successfully!');
            window.location.href = 'service-category_tbl.php';
        </script>";
        exit;
    } catch (PDOException $e) {
        echo "<script>
            alert('Error updating category: " . addslashes($e->getMessage()) . "');
            window.history.back();
        </script>";
    }
}
?>