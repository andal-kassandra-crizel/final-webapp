<?php
include 'dbconnection.php';


   // DELETE DOCTOR
   if (isset($_GET['delete'])) {
    $doctor_id = trim($_GET['delete']);
    $sql = 'DELETE FROM doctors WHERE doctor_id = :docId';
    $data = ['docId' => $doctor_id];
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        echo "<script>alert('Doctor deleted successfully!'); window.location.href='doctors_tbl.php';</script>";
        exit;
    } catch (PDOException $e) {
        echo "<script>alert('Error deleting doctor: " . addslashes($e->getMessage()) . "');</script>";
    }
   }

   // ADD DOCTOR
  if (isset($_POST['adddoctor'])) {
    $doctor = trim($_POST['doctor_name']);
    $category_id = trim($_POST['category_id']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    if (empty($doctor) || empty($category_id) || empty($email) || empty($phone)) {
        echo "<script>alert('Please fill out all fields.');</script>";
    } else {
        $sql = "INSERT INTO doctors (doctor_name, category_id, email, phone)
                VALUES (:doctor_name, :category_id, :email, :phone)";
        $data = [
            ':doctor_name' => $doctor,
            ':category_id' => $category_id,
            ':email' => $email,
            ':phone' => $phone
        ];

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
            echo "<script>alert('Doctor added successfully!'); window.location.href='doctors_tbl.php';</script>";
            exit;
        } catch (PDOException $e) {
            echo "<script>alert('Error adding doctor: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
  }

  $record = []; // Initialize to avoid undefined variable warnings

  // Fetch doctor data when editing
  if (isset($_GET['doctor_id']) && !empty($_GET['doctor_id'])) {
    $doctor_id = trim($_GET['doctor_id']);

    $sql = "SELECT * FROM doctors WHERE doctor_id = :docId";
    $data = [':docId' => $doctor_id];

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$record) {
            echo "<script>alert('Doctor not found.'); window.location.href='doctors_tbl.php';</script>";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error fetching record: " . $e->getMessage();
        exit;
    }
  } 

  // Update doctor record
  if (isset($_POST['update'])) {
    $doctor_id = $_POST['doctor_id'];
    $doctor_name = trim($_POST['doctor_name']);
    $category_id = trim($_POST['category_id']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Basic validation
    if (empty($doctor_name) || empty($category_id) || empty($email) || empty($phone)) {
        echo "<script>alert('Please fill out all fields.'); window.history.back();</script>";
        exit;
    }

    $sql = "UPDATE doctors 
            SET doctor_name = :doctor_name, 
                category_id = :category_id, 
                email = :email, 
                phone = :phone 
            WHERE doctor_id = :docId";

    $data = [
        ':doctor_name' => $doctor_name,
        ':category_id' => $category_id,
        ':email' => $email,
        ':phone' => $phone,
        ':docId' => $doctor_id
    ];

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        echo "<script>
            alert('Doctor updated successfully!');
            window.location.href = 'doctors_tbl.php';
        </script>";
        exit;
    } catch (PDOException $e) {
        echo "<script>
            alert('Error updating doctor: " . addslashes($e->getMessage()) . "');
            window.history.back();
        </script>";
    }
  }
    
?>