<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Take Action</title>
   <link rel="stylesheet" href="../assets/css/bootstrap.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

   <script defer src="../assets/fontawesome/js/all.min.js"></script>
   <link rel="stylesheet" href="../assets/vendors/chartjs/Chart.min.css">
   <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
   <link rel="stylesheet" href="../assets/css/app.css">
   <link rel="shortcut icon" href="../assets/images/favicon.svg" type="image/x-icon">
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
                  <li class="sidebar-item has-sub">
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
                  <li class="dropdown nav-icon">
                     <a href="#" data-bs-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                        <div class="d-lg-inline-block">
                           <i data-feather="bell"></i>
                        </div>
                     </a>
                     <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                        <h6 class='py-2 px-4'>Notifications</h6>
                        <ul class="list-group rounded-none">
                           <li class="list-group-item border-0 align-items-start">
                              <div class="row mb-2">
                                 <div class="col-md-12 notif">
                                    <a href="leave_details.html">
                                       <h6 class='text-bold'>John Doe</h6>
                                       <p class='text-xs'>
                                          applied for leave at 05-21-2021
                                       </p>
                                    </a>
                                 </div>
                                 <div class="col-md-12 notif">
                                    <a href="leave_details.html">
                                       <h6 class='text-bold'>Jane Doe</h6>
                                       <p class='text-xs'>
                                          applied for leave at 05-21-2021
                                       </p>
                                    </a>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </li>
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
               <h3>Leave Details</h3>
            </div>
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
                                          <table class='table' id="table1">

                                             <tbody>
                                                <tr>
                                                   <td><b>Full Name:</b> John Doe</td>
                                                   <td><b>Age:</b> 23</td>
                                                   <td><b>Gender:</b> Male</td>
                                                </tr>
                                                <tr>
                                                   <td><b>Leave Type:</b> Sick Leave</td>
                                                   <td><b>Leave Date:</b> 05-23- to 05-25-2021</td>
                                                   <td><b>Posting Date:</b> 05-23-2021</td>
                                                </tr>
                                                <tr>
                                                   <td><b>Leave Status:</b> pending</td>
                                                   <td></td>
                                                   <td></td>
                                                </tr>
                                                <tr>
                                                   <td><b>Admin Remark:</b> waiting for approval</td>
                                                   <td></td>
                                                   <td></td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>

                                       <div class="col-12 d-flex justify-content-end">
                                          <button type="submit" class="btn btn-primary me-1 mb-1">Approve</button>
                                          <button type="submit" class="btn btn-primary me-1 mb-1">Not Approve</button>
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
   <script src="../assets/vendors/chartjs/Chart.min.js"></script>
   <script src="../assets/vendors/apexcharts/apexcharts.min.js"></script>
   <script src="../assets/js/pages/dashboard.js"></script>
   <script src="../assets/js/main.js"></script>
</body>

</html>