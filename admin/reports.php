<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reports</title>

   <link rel="stylesheet" href="../assets/css/bootstrap.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


   <script defer src="../assets/fontawesome/js/all.min.js"></script>
   <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
   <link rel="stylesheet" href="../assets/css/app.css">
   <link rel="icon" href="../assets/img/logo.jpg" type="image/x-icon">
   <style type="text/css">
      .notif:hover {
         background-color: rgba(0, 0, 0, 0.1);
      }
   </style>
</head>

<body>
   <div id="app">
      <div id="sidebar" class='active'>
         <div class="sidebar-wrapper active">
            <div class="sidebar-header" style="height: 50px;margin-top: -30px">
               <i class="fa fa-users text-success me-4"></i>
               <span>ELMS</span>
            </div>
            <div class="sidebar-menu">
               <ul class="menu">
                  <li class="sidebar-item ">
                     <a href="admin_dashboard.php" class='sidebar-link'>
                        <i class="fa fa-home text-success"></i>
                        <span>Dashboard</span>
                     </a>
                  </li>
                  <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                        <i class="fa fa-building text-success"></i>
                        <span>Department</span>
                     </a>
                     <ul class="submenu ">
                        <li>
                           <a href="add_department.php">Add Department</a>
                        </li>
                        <li>
                           <a href="manage_department.php">Manage Department</a>
                        </li>
                     </ul>
                  </li>
                  <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Designation</span>
                     </a>
                     <ul class="submenu ">
                        <li>
                           <a href="add_designation.php">Add Designation</a>
                        </li>
                        <li>
                           <a href="manage_designation.php">Manage Designation</a>
                        </li>
                     </ul>
                  </li>
                  <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                        <i class="fa fa-users text-success"></i>
                        <span>Employees</span>
                     </a>
                     <ul class="submenu ">
                        <li>
                           <a href="add_employee.php">Add Employee</a>
                        </li>
                        <li>
                           <a href="manage_employee.php">Manage Employee</a>
                        </li>
                     </ul>
                  </li>
                  <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Leave Type</span>
                     </a>
                     <ul class="submenu ">
                        <li>
                           <a href="add_leave_type.php">Add Leave Type</a>
                        </li>
                        <li>
                           <a href="manage_leave_type.php">Manage Leave Type</a>
                        </li>
                     </ul>
                  </li>
                  <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Leave Management</span>
                     </a>
                     <ul class="submenu ">
                        <li>
                           <a href="all_leave.php">All Leaves</a>
                        </li>
                        <li>
                           <a href="pending_leave.php">Pending Leaves</a>
                        </li>
                        <li>
                           <a href="approve_leave.php">Approve Leaves</a>
                        </li>
                        <li>
                           <a href="not_approve_leave.php">Not Approve Leaves</a>
                        </li>
                     </ul>
                  </li>
                  <li class="sidebar-item  has-sub">
                     <a href="#" class='sidebar-link'>
                        <i class="fa fa-user text-success"></i>
                        <span>Users</span>
                     </a>
                     <ul class="submenu ">
                        <li>
                           <a href="add_user.php">Add User</a>
                        </li>
                        <li>
                           <a href="manage_user.php">Manage Users</a>
                        </li>
                     </ul>
                  </li>
                  <li class="sidebar-item">
                     <a href="attendance_record.php" class='sidebar-link'>
                        <i class="fa fa-notes text-success"></i>
                        <span>Attendance Record</span>
                     </a>
                  </li>
                  <li class="sidebar-item active ">
                     <a href="reports.php" class='sidebar-link'>
                        <i class="fa fa-chart-bar text-success"></i>
                        <span>Reports</span>
                     </a>
                  </li>
               </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
         </div>
      </div>
      <div id="main">
         <nav class="navbar navbar-header navbar-expand navbar-light">
            <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
            <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                  <li class="dropdown">
                     <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="avatar me-1">
                           <img src="<?php echo $profile; ?>" alt="" srcset="">
                        </div>
                        <div class="d-none d-md-block d-lg-inline-block">Hi, <?php echo $userCategory; ?></div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="update_credentials.php?user_id=<?php echo $userID; ?>"><i data-feather="lock"></i> Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../process/logout.php"><i data-feather="log-out"></i> Logout</a>
                     </div>
                  </li>
               </ul>
            </div>
         </nav>

         <div class="main-content container-fluid">
            <div class="page-title">
               <div class="row">
                  <div class="col-12 col-md-6 order-md-1 order-last">
                     <h3>Reports</h3>
                  </div>
                  <div class="col-12 col-md-6 order-md-2 order-first">
                     <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="admin_dashboard.php" class="text-success">Dashboard</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Reports</li>
                        </ol>
                     </nav>
                  </div>
               </div>

            </div>


            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts">
               <div class="row match-height">
                  <div class="col-md-12 col-12">
                     <div class="card">
                        <div class="card-content">
                           <div class="card-body">
                              <form class="form form-vertical">
                                 <div class="form-body">
                                    <div class="row">
                                       <div class="col-12">
                                          <div class="card-body">
                                             <div class="chart chart-lg">
                                                <canvas id="chartjs-pie"></canvas>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- // Basic Vertical form layout section end -->
         </div>
      </div>
   </div>
   <script src="../assets/js/feather-icons/feather.min.js"></script>
   <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
   <script src="../assets/js/app.js"></script>

   <script src="../assets/js/main.js"></script>
   <script src="../assets/js/chart.js"></script>
   <script>
      document.addEventListener("DOMContentLoaded", function() {
         // Pie chart
         new Chart(document.getElementById("chartjs-pie"), {
            type: "pie",
            data: {
               labels: ["Approved", "Pending", "Cancelled"],
               datasets: [{
                  data: [34, 12, 15],
                  backgroundColor: [
                     window.theme.primary,
                     window.theme.warning,
                     window.theme.danger,
                  ],
                  borderColor: "transparent"
               }]
            },
            options: {
               maintainAspectRatio: true,
               legend: {
                  display: true
               }
            }
         });
      });
   </script>
</body>

</html>