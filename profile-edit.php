<?php
session_start();
include 'dbconnection.php'; // or dbcon.php

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']);
    $middlename = trim($_POST['middlename']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);

    if (empty($firstname) || empty($lastname) || empty($email)) {
        $error = "Please fill out all required fields.";
    } else {
        $updateQuery = "UPDATE account 
                        SET firstname = :firstname, middlename = :middlename, lastname = :lastname, email = :email 
                        WHERE user_id = :uid";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
            'email' => $email,
            'uid' => $user_id
        ]);

        $_SESSION['message'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit;
    }
}

// Fetch user information
$sql = "SELECT user_id, firstname, middlename, lastname, email 
        FROM account
        WHERE user_id = :uid";
$stmt = $pdo->prepare($sql);
$stmt->execute(['uid' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<p style='color:red; text-align:center;'>User not found!</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="card shadow-lg">
    <div class="card-header bg-success text-white text-center">
      <h4>Edit Profile</h4>
    </div>
    <div class="card-body">

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?php echo $error; ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-3">
          <label class="form-label">First Name</label>
          <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Middle Name</label>
          <input type="text" name="middlename" class="form-control" value="<?php echo htmlspecialchars($user['middlename']); ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Last Name</label>
          <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-success">Save Changes</button>
          <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
