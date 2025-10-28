<?php 
include 'dbconnection.php';
include 'service_crud.php';


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
                    <h1 class="mt-mt-mb-4 text-primary fw-bold">Service Management</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Add and Manage Services</li>
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

                    <!-- Add Service Form -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-plus-circle me-1"></i> Add New Service
                        </div>
                        <div class="card-body">
                            <?php if (empty($categories)): ?>
                                <div class="alert alert-warning mb-3">
                                    No categories found. Please add a category first before adding a service.
                                </div>
                            <?php else: ?>
                                <form method="post" action="service_crud.php">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <select name="category_id" class="form-select form-select-sm" required>
                                                <option value="">-- Select Category --</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?= htmlspecialchars($category['category_id']) ?>">
                                                        <?= htmlspecialchars($category['category_name']) ?> (ID: <?= htmlspecialchars($category['category_id']) ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="service_name" placeholder="Enter Service Name" class="form-control form-control-sm" required>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <input type="submit" name="addservice" value="Add Service" class="btn btn-primary btn-sm">
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Service List Table -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-table me-1"></i> Service List
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered table-striped text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Service ID</th>
                                        <th>Category ID</th>
                                        <th>Service Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                 <tfoot>
                                 <?php
                                    $sql = 'SELECT * FROM services';
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    $serviceList = $stmt->fetchAll();
                                 ?>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($serviceList as $service): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($service['service_id']) ?></td>
                                            <td><?= htmlspecialchars($service['category_id']) ?></td>
                                            <td><?= htmlspecialchars($service['service_name']) ?></td>
                                            <td>
                                                <a href="service_edit.php?service_id=<?= $service['service_id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="services_tbl.php?delete=<?= $service['service_id'] ?>" onclick="return confirm('Are you sure you want to delete this service?')" class="btn btn-danger btn-sm"> Delete</a>
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
</body>
</html>
