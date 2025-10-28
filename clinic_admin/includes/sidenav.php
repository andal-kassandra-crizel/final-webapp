<?php 
include 'dbconnection.php';
include 'dashboard.php';
?>
 
             <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <!-- Number Of User -->
                            <div class="col-xl-3 col-md-6">
                             <div class="card bg-primary text-white mb-4 shadow-sm">
                                 <div class="card-body text-center">
                                     <h5 class="mb-2">Number of Users</h5>
                                     <h1 class="fw-bold display-5"><?php echo $userCount; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="account_tbl.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                              </div>
                            </div>
                            <!-- Approved Appointments -->
                            <div class="col-xl-3 col-md-6">
                              <div class="card bg-warning text-white mb-4 shadow-sm">
                                  <div class="card-body text-center">
                                     <h5 class="mb-2">Approved Appointments</h5>
                                     <h1 class="fw-bold display-5"><?php echo $approvedCount; ?></h1>
                                  </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                   <a class="small text-white stretched-link" href="appointment_tbl.php">View Details</a>
                                   <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                              </div>
                            </div>
                            <!-- Pending Appointments -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4 shadow-sm">
                                   <div class="card-body text-center">
                                     <h5 class="mb-2">Pending Appointments</h5>
                                     <h1 class="fw-bold display-5"><?php echo $pendingCount; ?></h1>
                                   </div>
                                  <div class="card-footer d-flex align-items-center justify-content-between">
                                      <a class="small text-white stretched-link" href="appointment_tbl.php">View Details</a>
                                      <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                  </div>
                                </div>
                            </div>
                            <!-- Cancel Appointments -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4 shadow-sm">
                                    <div class="card-body text-center">
                                     <h5 class="mb-2">Cancel Appointments</h5>
                                     <h1 class="fw-bold display-5"><?php echo $cancelCount; ?></h1>
                                   </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="appointment_tbl.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Pie Chart -->
                            <div class="col-xl-4 col-md-6">
                                  <div class="card mb-4">
                                      <div class="card-header bg-primary text-white">
                                        <i class="fas fa-chart-pie me-1"></i>
                                        Most Booked Service Categories
                                      </div>
                                      <div class="card-body">
                                        <canvas id="servicePieChart" width="100%" height="90"></canvas>
                                      </div>
                                  </div>
                            </div>

                            <!-- Bar Chart -->
                            <div class="col-xl-4 col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header bg-success text-white">
                                           <i class="fas fa-chart-bar me-1"></i>
                                           Age Distribution of Patients
                                        </div>
                                        <div class="card-body">
                                           <canvas id="ageBarChart" width="100%" height="90"></canvas>
                                        </div>
                                    </div>
                            </div>

                            <!-- Line/Area Chart -->
                            <div class="col-xl-4 col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-header bg-warning text-dark">
                                            <i class="fas fa-chart-line me-1"></i>
                                             Appointments Over Time
                                        </div>
                                        <div class="card-body">
                                            <canvas id="appointmentLineChart" width="100%" height="90"></canvas>
                                        </div>
                                    </div>
                            </div>

                        </div>

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
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                     </div>
                    </div>

                    <!-- Appointment List Table -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-table me-1"></i> Appointment List
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Service</th>
                                        <th>Doctor</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                 <?php
                                   $sql = " SELECT a.appointment_id, a.user_id, CONCAT(ac.firstname, ' ', ac.lastname) AS user_name, a.firstname,
                                                   a.middlename, a.lastname, a.age, s.service_name, d.doctor_name, a.appointment_date,  a.status
                                            FROM appointments a
                                            LEFT JOIN account ac ON a.user_id = ac.user_id
                                            LEFT JOIN doctors d ON a.doctor_id = d.doctor_id
                                            LEFT JOIN services s ON a.service_id = s.service_id
                                            ORDER BY a.appointment_date DESC ";
                                           $stmt = $pdo->prepare($sql);
                                           $stmt->execute();
                                           $appList = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                 ?>
                               </tfoot>
                                <tbody>
                                        <?php foreach ($appList as $app): ?>
                                            <tr>
                                                <td><?= $app['appointment_id'] ?></td>
                                                <td><?= htmlspecialchars($app['user_name'] ?: 'Guest') ?></td>
                                                <td><?= htmlspecialchars($app['firstname'].' '.$app['middlename'].' '.$app['lastname']) ?></td>
                                                <td><?= htmlspecialchars($app['age']) ?></td>
                                                <td><?= htmlspecialchars($app['service_name']) ?></td>
                                                <td><?= htmlspecialchars($app['doctor_name']) ?></td>
                                                <td><?= htmlspecialchars($app['appointment_date']) ?></td>
                                                <td><?= htmlspecialchars($app['status']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                     
                    <!-- Doctor List Table -->
                    <div class="card mb-4">
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
                                    </tr>
                                </thead>
                                <tfoot>
                                <?php
                                     $sql = 'SELECT * FROM doctors';
                                     $stmt = $pdo->prepare($sql);
                                     $stmt->execute();
                                     $doctorList = $stmt->fetchAll();
                                ?>
                               </tfoot>
                                <tbody>
                                    <?php foreach ($doctorList as $doctor): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($doctor['doctor_id']) ?></td>
                                            <td><?= htmlspecialchars($doctor['doctor_name']) ?></td>
                                            <td><?= htmlspecialchars($doctor['category_id']) ?></td>
                                            <td><?= htmlspecialchars($doctor['email']) ?></td>
                                            <td><?= htmlspecialchars($doctor['phone']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                     <!-- Service Category Table -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-table me-1"></i> Service List
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered table-striped text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Category ID</th>
                                        <th>Category Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tfoot>
                                <?php
                                  $sql = 'SELECT * FROM service_categories';
                                  $stmt = $pdo->prepare($sql);
                                  $stmt->execute();
                                  $categoryList = $stmt->fetchAll();
                                ?>
                                </tfoot>
                                    <?php foreach ($categoryList as $category): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($category['category_id']) ?></td>
                                            <td><?= htmlspecialchars($category['category_name']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>

               <!-- Load Chart.js -->
               <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                // ===== PIE CHART: Service Categories =====
                document.addEventListener("DOMContentLoaded", function() {

                    const categories = <?php echo json_encode($categories); ?>;
                    const totals = <?php echo json_encode($categoryTotals); ?>;

                    const colors = categories.map((_, i) => 
                        `hsl(${i * (360 / categories.length)}, 70%, 60%)`
                    );
                    
                    
                    // Initialize Chart.js
                    new Chart(document.getElementById('servicePieChart'), {
                      type: 'pie',
                      data: {
                          labels: categories,
                          datasets: [{
                                  data: totals,
                                  backgroundColor: colors,
                                  borderColor: '#fff',
                                  borderWidth: 1
                          }]
                     },
                     options: {
                            responsive: true,
                            plugins: {
                                legend: { 
                                      position: 'bottom' 
                                }, 
                                 title: { 
                                        display: true,
                                        text: 'Most Booked Services'
                                }
                         }
                     }
                    });
                       

                       const labelContainer = document.getElementById('chartLabels');
                       labelContainer.innerHTML = categories.map((cat, i) => `
                            <span style="
                                    display:inline-flex;
                                    align-items:center;
                                    margin: 4px 6px;
                                    font-size: 13px;
                              ">
                               <span style="
                                    width:14px;
                                    height:14px;
                                    background:${colors[i]};
                                    border-radius:3px;
                                    margin-right:6px;
                                    display:inline-block;
                               "></span>
                              ${cat}
                            </span>
                          `).join('');
                });

                // ===== BAR CHART: Age Distribution =====
                new Chart(document.getElementById('ageBarChart'), {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($ageGroups); ?>,
                        datasets: [{
                                label: 'Patients',
                                data: <?php echo json_encode($ageTotals); ?>,
                                backgroundColor: '#36a2eb'
                        }]
                    },
                   options: {
                        scales: {
                            y: { beginAtZero: true }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Patient Age Distribution'
                            },
                            legend: { display: false }
                        }
                    }
                });

                 // ===== LINE/AREA CHART: Appointments Over Time =====
                new Chart(document.getElementById('appointmentLineChart'), {
                    type: 'line',
                    data: {
                            labels: <?php echo json_encode($dates); ?>,
                            datasets: [{
                                label: 'Total Appointments',
                                data: <?php echo json_encode($dateTotals); ?>,
                                fill: true, // makes it an area chart
                                borderColor: '#ff9800',
                                backgroundColor: 'rgba(255, 193, 7, 0.3)',
                                tension: 0.3
                            }]
                    },
                    options: {
                        scales: {
                            y: { beginAtZero: true }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Appointments Booked Over Time'
                           },
                                legend: { position: 'bottom' }
                        }
                    }
                });
            </script>

            </main>
              