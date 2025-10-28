<?php 
include 'dbconnection.php';
include 'doctor_crud.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>

<body class="sb-nav-fixed">
    <?php include 'includes/header.php'; ?>  

    <div id="layoutSidenav">
        <?php include 'includes/sidebar.php'; ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-mb-4 text-primary fw-bold">Doctors Management</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Add and Manage Doctors</li>
                    </ol>
                    
                    <!-- PHP: Fetch Categories for Dropdown -->
                    <?php
                    try {
                        $stmt = $pdo->query("SELECT category_id, category_name FROM service_categories ORDER BY category_name ASC");
                        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        $categories = [];
                        echo "<div class='alert alert-danger'>Error fetching categories: " . htmlspecialchars($e->getMessage()) . "</div>";
                    }
                    ?>
                    
                    <!-- Add Doctor Form -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-user-md me-1"></i> Add New Doctor
                        </div>
                        <div class="card-body">
                            <form method="post" action="doctor_crud.php">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <input type="text" name="doctor_name" placeholder="Enter Doctor Name" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="category_id" class="form-select form-select-sm" required>
                                            <option value="">-- Select Category --</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= htmlspecialchars($category['category_id']) ?>">
                                                    <?= htmlspecialchars($category['category_name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <input type="email" name="email" placeholder="Enter Email Address" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="phone" placeholder="Enter Phone Number" class="form-control form-control-sm" required>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <input type="submit" name="adddoctor" value="Add Doctor" class="btn btn-primary btn-sm">
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Doctor List Table -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-table me-1"></i> Doctor List
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered table-striped text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category ID</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = 'SELECT * FROM doctors';
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    $doctorList = $stmt->fetchAll();

                                    foreach ($doctorList as $doctor): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($doctor['doctor_id']) ?></td>
                                            <td><?= htmlspecialchars($doctor['doctor_name']) ?></td>
                                            <td><?= htmlspecialchars($doctor['category_id']) ?></td>
                                            <td><?= htmlspecialchars($doctor['email']) ?></td>
                                            <td><?= htmlspecialchars($doctor['phone']) ?></td>
                                            <td>
                                                <a href="doctor_edit.php?doctor_id=<?= $doctor['doctor_id'] ?>" class="btn btn-primary btn-sm">Edit</a>

                                                <!-- Trigger Delete Modal -->
                                                <button 
                                                    type="button" 
                                                    class="btn btn-danger btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal"
                                                    data-id="<?= $doctor['doctor_id'] ?>"
                                                    data-name="<?= htmlspecialchars($doctor['doctor_name']) ?>"
                                                    
                                                >
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </main>

            <?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p class="mb-0">Are you sure you want to delete <strong id="doctorName"></strong>?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
            <a href="#" id="confirmDeleteBtn" class="btn btn-danger btn-sm">Yes, Delete</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS + Modal Script -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
      const deleteModal = document.getElementById('deleteModal');
      const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
      const doctorName = document.getElementById('doctorName');

      deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const doctorId = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');

        doctorName.textContent = name;
        confirmDeleteBtn.href = `doctor_crud.php?delete=${doctorId}`;
      });
    });
    </script>

</body>
</html>
