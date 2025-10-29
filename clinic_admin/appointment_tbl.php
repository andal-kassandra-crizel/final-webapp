<?php 
include 'dbconnection.php';

// APPROVE / DISAPPROVE / CANCEL APPOINTMENT ACTIONS
if (isset($_POST['action']) && isset($_POST['id'])) {
    $action = $_POST['action'];
    $appointment_id = $_POST['id'];
    $message = $_POST['message'] ?? '';

    // Map actions to statuses
    $statusMap = [
        'approve' => 'Approved',
        'disapprove' => 'Disapproved',
        'cancel' => 'Cancelled'
    ];

    if (array_key_exists($action, $statusMap)) {
        $status = $statusMap[$action];
        $sql = "UPDATE appointments SET status = :status, message = :message WHERE appointment_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['status' => $status, 'message' => $message, 'id' => $appointment_id]);
    }

    header("Location: appointment_tbl.php");
    exit;
}

// FETCH ALL APPOINTMENTS
$sql = "
    SELECT 
        a.appointment_id,
        a.user_id,
        a.firstname,
        a.middlename,
        a.lastname,
        a.age,
        s.service_name,
        d.doctor_name,
        a.appointment_date,
        a.status
    FROM appointments a
    LEFT JOIN account ac ON a.user_id = ac.user_id
    LEFT JOIN doctors d ON a.doctor_id = d.doctor_id
    LEFT JOIN services s ON a.service_id = s.service_id
    ORDER BY a.appointment_date DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$appList = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <div class="container-fluid px-4 mt-4">
                    <h1 class="mb-4 text-primary fw-bold">Appointment Management</h1>

                    <div class="card shadow-lg border-0 mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-calendar-check me-1"></i> Appointment List
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>App ID</th>
                                        <th>User ID</th>
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Service</th>
                                        <th>Doctor</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($appList)): ?>
                                        <?php foreach ($appList as $app): ?>
                                            <?php 
                                                $status = htmlspecialchars($app['status']);
                                                $badgeClass = match($status) {
                                                    'Approved' => 'bg-success',
                                                    'Disapproved' => 'bg-warning text-dark',
                                                    'Cancelled' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                            ?>
                                            <tr>
                                                <td><?= $app['appointment_id'] ?></td>
                                                <td><?= htmlspecialchars($app['user_id']) ?></td>
                                                <td><?= htmlspecialchars($app['firstname'].' '.$app['middlename'].' '.$app['lastname']) ?></td>
                                                <td><?= htmlspecialchars($app['age']) ?></td>
                                                <td><?= htmlspecialchars($app['service_name']) ?></td>
                                                <td><?= htmlspecialchars($app['doctor_name']) ?></td>
                                                <td><?= htmlspecialchars($app['appointment_date']) ?></td>
                                                <td><span class="badge <?= $badgeClass ?>"><?= $status ?: 'Pending' ?></span></td>

                                                <td>
                                                    <?php if ($status === 'Approved'): ?>
                                                        <button class="btn btn-success btn-sm" disabled>Approved</button>

                                                    <?php elseif ($status === 'Cancelled'): ?>
                                                        <button class="btn btn-danger btn-sm" disabled title="Cancelled by user — no further actions allowed">Cancelled</button>

                                                    <?php elseif ($status === 'Disapproved'): ?>
                                                        <button class="btn btn-warning btn-sm text-dark" disabled>Disapproved</button>

                                                    <?php else: ?>
                                                        <form method="post" class="d-inline">
                                                            <input type="hidden" name="id" value="<?= $app['appointment_id'] ?>">
                                                            <input type="hidden" name="action" value="approve">
                                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                        </form>

                                                        <button 
                                                            class="btn btn-warning btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#disapproveModal"
                                                            data-id="<?= $app['appointment_id'] ?>">
                                                            Disapprove
                                                        </button>

                                                        <button 
                                                            class="btn btn-danger btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#cancelModal"
                                                            data-id="<?= $app['appointment_id'] ?>">
                                                            Cancel
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="9" class="text-center text-muted">No appointments found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>

    <!-- Disapprove Modal -->
    <div class="modal fade" id="disapproveModal" tabindex="-1" aria-labelledby="disapproveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title fw-bold" id="disapproveModalLabel">Disapprove Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2 text-dark fw-semibold">Are you sure you want to disapprove this appointment?</p>
                    <div class="mb-3">
                        <label for="disapproveMsg" class="form-label">Reason:</label>
                        <textarea name="message" id="disapproveMsg" class="form-control" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="id" id="disapproveId">
                    <input type="hidden" name="action" value="disapprove">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning text-dark">Confirm Disapprove</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold" id="cancelModalLabel">Cancel Appointment</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Are you sure you want to cancel this appointment?</p>
                    <div class="mb-3">
                        <label for="cancelMsg" class="form-label">Reason:</label>
                        <textarea name="message" id="cancelMsg" class="form-control" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="id" id="cancelId">
                    <input type="hidden" name="action" value="cancel">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Confirm Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Pass appointment ID to modals dynamically
        const disapproveModal = document.getElementById('disapproveModal');
        const cancelModal = document.getElementById('cancelModal');

        disapproveModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('disapproveId').value = button.getAttribute('data-id');
        });

        cancelModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            document.getElementById('cancelId').value = button.getAttribute('data-id');
        });
    </script>
</body>
</html>
