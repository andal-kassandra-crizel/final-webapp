<?php
session_start();
include 'dbconnection.php';
include 'app-edit.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Appointment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="card shadow-lg">
    <div class="card-header bg-success text-white text-center">
      <h4>Edit Appointment</h4>
    </div>

    <div class="card-body">
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" id="editForm">
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control" value="<?= htmlspecialchars($appointment['firstname']) ?>" <?= $readonly ? 'readonly' : '' ?>>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Middle Name</label>
            <input type="text" name="middlename" class="form-control" value="<?= htmlspecialchars($appointment['middlename']) ?>" <?= $readonly ? 'readonly' : '' ?>>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control" value="<?= htmlspecialchars($appointment['lastname']) ?>" <?= $readonly ? 'readonly' : '' ?>>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Category</label>
          <select name="category" id="category" class="form-select" <?= $readonly ? 'disabled' : '' ?>>
            <option value="">Select Category</option>
            <?php foreach ($categories as $cat): ?>
              <option value="<?= $cat['category_id'] ?>" <?= $cat['category_id'] == $appointment['category_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['category_name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Service</label>
          <select name="service" id="service" class="form-select" <?= $readonly ? 'disabled' : '' ?>>
            <option value="<?= $appointment['service_id'] ?>"><?= htmlspecialchars($appointment['service_name']) ?></option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Doctor</label>
          <select name="doctor" id="doctor" class="form-select" <?= $readonly ? 'disabled' : '' ?>>
            <option value="<?= $appointment['doctor_id'] ?>"><?= htmlspecialchars($appointment['doctor_name']) ?></option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Appointment Date</label>
          <input type="date" name="appointment_date" class="form-control" value="<?= htmlspecialchars($appointment['appointment_date']) ?>" <?= $readonly ? 'readonly' : '' ?>>
        </div>

        <div class="text-center mt-4">
          <?php if (!$readonly): ?>
            <button type="submit" class="btn btn-success">Save Changes</button>
          <?php endif; ?>
          <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src = "assets/js/app-edit.js"></script>
</body>
</html>
