<?php
session_start();
header('Content-Type: application/json');
include 'dbconnection.php'; 

try {
    $requiredFields = ['firstname', 'middlename', 'lastname', 'email', 'age', 'service_id', 'doctor_id', 'date'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            echo json_encode(["status" => "error", "message" => "Missing field: $field"]);
            exit;
        }
    }

    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $age = trim($_POST['age']);
    $service_id = intval($_POST['service_id']);
    $doctor_id = intval($_POST['doctor_id']);
    $appointment_date = $_POST['date'];
    $message = !empty($_POST['message']) ? trim($_POST['message']) : null;

    // ✅ Step 1: Reuse logged-in user ID if available
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        // Step 2: Try to find user by email
        $stmt = $pdo->prepare("SELECT user_id FROM account WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $user_id = $user['user_id'];
            $_SESSION['user_id'] = $user_id; // store it in session
        } else {
            // Step 3: Only insert if truly a new user (first-time visitor)
            $tempPassword = password_hash("temporary123", PASSWORD_DEFAULT);
            $insertUser = $pdo->prepare("INSERT INTO account (firstname, middlename, lastname, email, password) VALUES (?, ?, ?, ?, ?)");
            $insertUser->execute([$firstname, $middlename, $lastname, $email, $tempPassword]);
            $user_id = $pdo->lastInsertId();
            $_SESSION['user_id'] = $user_id;
        }
    }

    // Step 4: Insert the appointment only
    $query = "INSERT INTO appointments 
                (user_id, firstname, middlename, lastname, email, age, service_id, doctor_id, appointment_date, message)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user_id, $firstname, $middlename, $lastname, $email, $age, $service_id, $doctor_id, $appointment_date, $message]);

    echo json_encode(["status" => "success", "message" => "Your appointment has been successfully booked!"]);

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Unexpected error: " . $e->getMessage()]);
}

?>