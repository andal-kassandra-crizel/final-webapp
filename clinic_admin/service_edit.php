<?php
include 'dbconnection.php'; // Database connection
include 'service_crud.php';

?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php'; ?>

    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <?php include 'includes/sidebar.php'; ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-user-edit me-1"></i>
                                        Edit Doctor
                                    </div>
                                    <div class="card-body">
                                        <form action="service_edit.php" method="post">
                                            <input type="hidden" name="service_id" 
                                                value="<?= htmlspecialchars($record['service_id'] ?? '') ?>">

                                            <input type="text" name="category_id" 
                                                value="<?= htmlspecialchars($record['category_id'] ?? '') ?>" 
                                                placeholder="Enter Category ID" 
                                                class="form-control form-control-sm mb-3">
                                            
                                            <input type="text" name="service_name" 
                                                value="<?= htmlspecialchars($record['service_name'] ?? '') ?>" 
                                                placeholder="Enter Service Name" 
                                                class="form-control form-control-sm mb-3">
                                            
                                            <input type="submit" name="update" 
                                                value="Update Service" 
                                                class="form-control form-control-sm btn btn-success">

                                        </form>
                                        <a href="services_tbl.php" 
                                           class="form-control form-control-sm btn btn-primary mt-2">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </main>
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
