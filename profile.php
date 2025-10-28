<?php
session_start();
include 'dbconnection.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$error = '';
$success = '';

// HANDLE CANCEL REQUEST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_id'])) {
    $cancelId = $_POST['cancel_id'];

    // Update appointment status to Cancelled
    $cancelQuery = "UPDATE appointments SET status = 'Cancelled' WHERE appointment_id = :id AND user_id = :uid";
    $cancelStmt = $pdo->prepare($cancelQuery);
    $cancelStmt->execute(['id' => $cancelId, 'uid' => $user_id]);

    if ($cancelStmt->rowCount() > 0) {
        $success = "Appointment successfully cancelled.";
    } else {
        $error = "Failed to cancel appointment or unauthorized action.";
    }
}


$userSql = "SELECT firstname, middlename, lastname, email FROM account WHERE user_id = :uid";
$userStmt = $pdo->prepare($userSql);
$userStmt->execute(['uid' => $user_id]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);


$query = "
SELECT a.appointment_id AS id, a.firstname AS fname, a.middlename AS mname, a.lastname AS lname,
s.service_name AS service, d.doctor_name AS doctor, a.appointment_date AS date, a.status
FROM appointments a
JOIN services s ON a.service_id = s.service_id
JOIN doctors d ON a.doctor_id = d.doctor_id
WHERE a.user_id = ?
ORDER BY a.appointment_date ASC
";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/profile.css" rel="stylesheet">
 </head>
<body>
<div class="container-fluid">
  <div class="row">

    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 p-0 sidebar d-flex flex-column">
        <div class="text-center py-4">
            <img src="assets/img/default-profile.jpg" class="rounded-circle mb-2" width="80" height="80" alt="User">
            <h6><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></h6>
            <small><?= htmlspecialchars($user['email']) ?></small>
        </div>
        <nav class="nav flex-column mt-4 px-2">
            <a class="nav-link py-2" href="#appointments"><i class="bi bi-calendar2-check me-2"></i>My Appointments</a>
            <a class="nav-link py-2" href="profile-edit.php"><i class="bi bi-pencil-square me-2"></i>Edit Profile</a>
            <a class="nav-link py-2" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
            <a class="nav-link py-2" href="home.php"><i class="bi bi-arrow-left me-2"></i>Back</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 col-lg-10 p-4">
        <?php if ($success): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($success) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php elseif ($error): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php endif; ?>

        <!-- Appointments Table -->
        <div id="appointments" class="card profile-card p-3">
            <h5 class="mb-3">My Appointments</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $index => $appt): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($appt['fname'].' '.$appt['mname'].' '.$appt['lname']) ?></td>
                            <td><?= htmlspecialchars($appt['service']) ?></td>
                            <td><?= htmlspecialchars($appt['doctor']) ?></td>
                            <td><?= htmlspecialchars($appt['date']) ?></td>
                            <td><span class="status-badge status-<?= strtolower($appt['status']) ?>"><?= htmlspecialchars($appt['status']) ?></span></td>
                            <td>
                                <?php if ($appt['status'] === 'Approved'): ?>
                                    <a href="appointment-view.php?id=<?= $appt['id'] ?>" class="btn btn-sm btn-primary">View</a>
                                <?php elseif ($appt['status'] === 'Pending'): ?>
                                    <a href="appointment-edit.php?id=<?= $appt['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal" data-id="<?= $appt['id'] ?>">Cancel</button>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-secondary" disabled>Cancelled</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-3">
                <a href="appointment.php" class="btn btn-primary">Book New Appointment</a>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Cancel Confirmation Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-confirm">
      <div class="modal-header">
        <div class="icon-box"><i class="bi bi-x-circle"></i></div>
      </div>
      <div class="modal-body mt-4">
        <h4>Are you sure?</h4>
        <p>Do you really want to cancel this appointment? This action cannot be undone.</p>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <form method="post" id="cancelForm">
          <input type="hidden" name="cancel_id" id="cancelId">
          <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">No</button>
          <button type="submit" class="btn btn-danger">Yes, Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
 
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Pass appointment ID to modal
  const cancelModal = document.getElementById('cancelModal');
  cancelModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const appointmentId = button.getAttribute('data-id');
    document.getElementById('cancelId').value = appointmentId;
  });
</script>

</body>
</html>
