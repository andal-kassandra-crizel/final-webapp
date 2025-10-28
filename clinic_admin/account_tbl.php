<?php 
include 'dbconnection.php';


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
                    <h1 class="mt-mb-4 text-primary fw-bold">Account Management</h1>

                     <!-- Account List Table -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-table me-1"></i> Account List
                        </div>
                     <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered table-striped text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>User ID</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                <?php
                                     $sql = 'SELECT * FROM account';
                                     $stmt = $pdo->prepare($sql);
                                     $stmt->execute();
                                     $accList = $stmt->fetchAll();
                                ?>
                               </tfoot>
                                <tbody>
                                    <?php foreach ($accList as $account): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($account['user_id']) ?></td>
                                            <td><?= htmlspecialchars($account['firstname']) ?></td>
                                            <td><?= htmlspecialchars($account['middlename']) ?></td>
                                            <td><?= htmlspecialchars($account['lastname']) ?></td>
                                            <td><?= htmlspecialchars($account['role']) ?></td>
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
