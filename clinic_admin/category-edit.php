<?php
include 'dbconnection.php'; 
include 'category_crud.php';

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
                            <li class="breadcrumb-item active"></li>
                        </ol>

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-user-edit me-1"></i>
                                        Edit Category
                                    </div>
                                    <div class="card-body">
                                        <form action="category-edit.php" method="post">
                                            <input type="hidden" name="category_id" 
                                                value="<?= htmlspecialchars($record['category_id'] ?? '') ?>">
                                            
                                            <input type="text" name="category_name" 
                                                value="<?= htmlspecialchars($record['category_name'] ?? '') ?>" 
                                                placeholder="Enter Category Name" 
                                                class="form-control form-control-sm mb-3">
                                            
                                            <input type="submit" name="update" 
                                                value="Update Category" 
                                                class="form-control form-control-sm btn btn-success">

                                        </form>
                                        <a href="service-category_tbl.php" 
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
