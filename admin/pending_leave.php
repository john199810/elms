<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">

    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="shortcut icon" href="../assets/images/favicon.svg" type="image/x-icon">
    <link rel="icon" href="../assets/img/logo.jpg" type="image/x-icon">
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
                        <li class="sidebar-item active  has-sub">
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
                            <h3>Pending</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin_dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pending</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <?php
                // Query to fetch leaveapplications with employee and leave type details
                $sql = "SELECT la.application_id, la.employee_id, CONCAT(e.first_name, ' ', e.last_name) AS full_name, 
               lt.leave_name AS leave_type, la.date_of_application, la.remarks, la.leave_status, la.date_created
        FROM leaveapplications la
        JOIN employees e ON la.employee_id = e.employee_id
        JOIN leavetypes lt ON la.leave_id = lt.leave_id
        WHERE la.leave_status='pending'
        ORDER BY la.date_created DESC";

                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                ?>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <table class='table' id="table1">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Leave Type</th>
                                            <th>Posting Date</th>
                                            <th>Date Of Leave</th>
                                            <th>Remarks</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Loop through rows fetched from database
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo isset($row['full_name']) ? htmlspecialchars($row['full_name']) : ''; ?></td>
                                                <td><?php echo isset($row['leave_type']) ? htmlspecialchars($row['leave_type']) : ''; ?></td>
                                                <td><?php echo isset($row['date_created']) ? date('F j, Y', strtotime($row['date_created'])) : ''; ?></td>
                                                <td><?php echo isset($row['date_of_application']) ? date('F j, Y', strtotime($row['date_of_application'])) : ''; ?></td>
                                                <td><?php echo isset($row['remarks']) ? htmlspecialchars($row['remarks']) : ''; ?></td>

                                                <td>
                                                    <?php
                                                    $status_class = 'badge bg-danger'; // Default status badge class
                                                    if (isset($row['leave_status'])) {
                                                        if ($row['leave_status'] == 'disapprove') {
                                                            $status_class = 'badge bg-warning'; // Change to red for disapproved status
                                                        }
                                                        echo "<span class=\"$status_class\">" . htmlspecialchars($row['leave_status']) . "</span>";
                                                    } else {
                                                        echo "<span class=\"$status_class\">Unknown</span>"; // Handle cases where leave_status is not set
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <!-- Edit Modal Trigger -->
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['application_id']; ?>"><i class="fa fa-pen text-success"></i></a>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="editModal<?php echo $row['application_id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $row['application_id']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel<?php echo $row['application_id']; ?>">Edit Department</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form to edit department details -->
                                                                    <form action="../process/leave_update.php" method="POST">
                                                                        <input type="hidden" name="application_id" value="<?php echo $row['application_id']; ?>">

                                                                        <div class="mb-3">
                                                                            <label for="status">Status</label>
                                                                            <select class="form-control" id="status" name="status">
                                                                                <option value="approved" <?php if (isset($row['leave_status']) && $row['leave_status'] == 'approved') echo 'selected'; ?>>Approve</option>
                                                                                <option value="cancelled" <?php if (isset($row['leave_status']) && $row['leave_status'] == 'disapprove') echo 'selected'; ?>>Disapprove</option>
                                                                            </select>
                                                                        </div>

                                                                        <button type="submit" class="btn btn-primary" name="edit_status">Save Changes</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                <?php
                } else {
                    echo "<p>No pending leave applications found.</p>";
                }

                // Close the database connection
                $conn->close();
                ?>

            </div>
        </div>
    </div>


    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/js/vendors.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>