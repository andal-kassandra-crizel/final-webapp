<?php
include 'dbconnection.php'; 
include 'doctor_crud.php'; 

?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php'; ?>

    <body class="sb-nav-fixed">
        <?php include 'includes/header.php';?>  
        
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
                                        <form action="doctor_edit.php" method="post">
                                            <input type="hidden" name="doctor_id" 
                                                value="<?= htmlspecialchars($record['doctor_id'] ?? '') ?>">

                                            <input type="text" name="doctor_name" 
                                                value="<?= htmlspecialchars($record['doctor_name'] ?? '') ?>" 
                                                placeholder="Enter Doctor Name" 
                                                class="form-control form-control-sm mb-3">

                                            <input type="text" name="specialization" 
                                                value="<?= htmlspecialchars($record['specialization'] ?? '') ?>" 
                                                placeholder="Enter Specialization" 
                                                class="form-control form-control-sm mb-3">

                                            <input type="text" name="category_id" 
                                                value="<?= htmlspecialchars($record['category_id'] ?? '') ?>" 
                                                placeholder="Enter Category ID" 
                                                class="form-control form-control-sm mb-3">

                                            <input type="text" name="email" 
                                                value="<?= htmlspecialchars($record['email'] ?? '') ?>" 
                                                placeholder="Enter Email Address" 
                                                class="form-control form-control-sm mb-3">

                                            <input type="text" name="phone" 
                                                value="<?= htmlspecialchars($record['phone'] ?? '') ?>" 
                                                placeholder="Enter Phone Number" 
                                                class="form-control form-control-sm mb-3">

                                            <input type="submit" name="update" 
                                                value="Update Doctor" 
                                                class="form-control form-control-sm btn btn-success">

                                        </form>
                                        <a href="doctors_tbl.php" 
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
