<?php
include 'dbconnection.php';

   // DELETE SERVICE
  if (isset($_GET['delete'])) {
    $service_id = trim($_GET['delete']);
    $sql = 'DELETE FROM services WHERE service_id = :serId';
    $data = ['serId' => $service_id];

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        echo "<script>alert('Service deleted successfully!'); window.location.href='services_tbl.php';</script>";
        exit;
    } catch (PDOException $e) {
        echo "<script>alert('Error deleting service: " . addslashes($e->getMessage()) . "');</script>";
    }
  }

  // ADD SERVICE
  if (isset($_POST['addservice'])) {
    $category_id = trim($_POST['category_id']);
    $service_name = trim($_POST['service_name']);

    if (empty($category_id) || empty($service_name)) {
        echo "<script>alert('Please fill out all fields.');</script>";
    } else {
        $sql = "INSERT INTO services (category_id, service_name) VALUES (:category_id, :service_name)";
        $data = [
            ':category_id' => $category_id,
            ':service_name' => $service_name
        ];

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
            echo "<script>alert('Service added successfully!'); window.location.href='services_tbl.php';</script>";
            exit;
        } catch (PDOException $e) {
            echo "<script>alert('Error adding service: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
  }
  
  //EDIT/GET SERVICE
  $record = []; // Initialize to avoid undefined variable warnings

  if (isset($_GET['service_id']) && !empty($_GET['service_id'])) {
    $service_id = trim($_GET['service_id']);

    $sql = "SELECT * FROM services WHERE service_id = :serId";
    $data = [':serId' => $service_id];

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$record) {
            echo "<script>alert('Service not found.'); window.location.href='services_tbl.php';</script>";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error fetching record: " . $e->getMessage();
        exit;
    }
  } 

  // Update doctor record
  if (isset($_POST['update'])) {
    $service_id = $_POST['service_id'];
    $category_id = trim($_POST['category_id']);
    $service_name = trim($_POST['service_name']);

    // Basic validation
    if (empty($category_id) || empty($service_name)  ) {
        echo "<script>alert('Please fill out all fields.'); window.history.back();</script>";
        exit;
    }

    $sql = "UPDATE services 
            SET category_id = :category_id, 
                service_name = :service_name  
            WHERE service_id = :serId";

    $data = [
        ':category_id' => $category_id,
        ':service_name' => $service_name,
        ':serId' => $service_id
    ];

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        echo "<script>
            alert('Service updated successfully!');
            window.location.href = 'services_tbl.php';
        </script>";
        exit;
    } catch (PDOException $e) {
        echo "<script>
            alert('Error updating service: " . addslashes($e->getMessage()) . "');
            window.history.back();
        </script>";
    }
  }



?>