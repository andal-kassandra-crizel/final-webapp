<?php
include 'dbconnection.php';
session_start();

if (!empty($_POST['email']) && !empty($_POST['password'])) {

    $query = "SELECT * FROM account WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

          
            switch ($_SESSION['role']) {
                case 'admin':
                    header("Location: clinic_admin/admin.php");
                    break;
                default:
                    header("Location: home.php");
                    break;
            }
            exit;
        } else {
            $_SESSION['msg'] = "Incorrect email or password.";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['msg'] = "Account not found.";
        header("Location: login.php");
        exit;
    }

} else {
    $_SESSION['msg'] = "Please fill in all fields.";
    header("Location: login.php");
    exit;
}
?>
