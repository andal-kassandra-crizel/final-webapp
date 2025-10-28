<?php 
include 'dbconnection.php';

// DELETE SERVICE CATEGORY (with check)
if (isset($_GET['delete'])) {
    $category_id = trim($_GET['delete']);

    try {
        // Check if category is linked to any services
        $checkServices = $pdo->prepare("SELECT COUNT(*) FROM services WHERE category_id = :catId");
        $checkServices->execute([':catId' => $category_id]);
        $serviceCount = $checkServices->fetchColumn();

        // Check if category is linked to any appointments
        $checkAppointments = $pdo->prepare("
            SELECT COUNT(*) FROM appointments a
            JOIN services s ON a.service_id = s.service_id
            WHERE s.category_id = :catId
        ");
        $checkAppointments->execute([':catId' => $category_id]);
        $appointmentCount = $checkAppointments->fetchColumn();

        if ($serviceCount > 0 || $appointmentCount > 0) {
            // If category is in use — show a nice Bootstrap alert
            $errorMessage = "You cannot delete this category because it has existing services or appointments.";
        } else {
            // Proceed with deletion
            $sql = 'DELETE FROM service_categories WHERE category_id = :catId';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':catId' => $category_id]);
            $successMessage = "Service Category deleted successfully!";
        }
    } catch (PDOException $e) {
        $errorMessage = "Error deleting category: " . htmlspecialchars($e->getMessage());
    }
}

// ADD CATEGORY
if (isset($_POST['addcategory'])) {
    $category_name = trim($_POST['category_name']);

    if (empty($category_name)) {
        $errorMessage = "Please fill out all fields.";
    } else {
        try {
            $sql = "INSERT INTO service_categories (category_name) VALUES (:category_name)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':category_name' => $category_name]);
            $successMessage = "Service Category added successfully!";
        } catch (PDOException $e) {
            $errorMessage = "Error adding service category: " . htmlspecialchars($e->getMessage());
        }
    }
}

// FETCH ALL CATEGORIES
$sql = 'SELECT * FROM service_categories ORDER BY category_id ASC';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$categoryList = $stmt->fetchAll();
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
                <h1 class="mt-4 text-primary fw-bold">Service Category Management</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Add and Manage Service Categories</li>
                </ol>

                <!-- Alert Messages -->
                <?php if (!empty($successMessage)): ?>
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i> <?= $successMessage ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php elseif (!empty($errorMessage)): ?>
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> <?= $errorMessage ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Add Service Form -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-plus-circle me-1"></i> Add New Service Category
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="text" name="category_name" placeholder="Enter Category Name" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="text-end">
                                <input type="submit" name="addcategory" value="Add Category" class="btn btn-primary btn-sm">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Service Category List Table -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-table me-1"></i> Service Category List
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table table-bordered table-striped text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categoryList as $category): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($category['category_id']) ?></td>
                                        <td><?= htmlspecialchars($category['category_name']) ?></td>
                                        <td>
                                            <a href="category-edit.php?category_id=<?= $category['category_id'] ?>" class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                            <a href="service-category_tbl.php?delete=<?= $category['category_id'] ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Are you sure you want to delete this category?')">
                                                 Delete
                                            </a>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
