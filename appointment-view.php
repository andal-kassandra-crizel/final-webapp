<?php
include 'dbconnection.php';
include 'app-view.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Appointment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-secondary text-white text-center">
            <h4>View Appointment</h4>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['firstname']) ?>" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['middlename']) ?>" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['lastname']) ?>" disabled>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Service</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['service_name']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Doctor</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['doctor_name']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Appointment Date</label>
                <input type="date" class="form-control" value="<?= htmlspecialchars($appointment['appointment_date']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['status']) ?>" disabled>
            </div>

            <div class="text-center mt-4">
                <a href="profile.php" class="btn btn-secondary">Back to Profile</a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
