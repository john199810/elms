<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/app.css">
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
                        <li class="sidebar-item active">
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
                        <li class="sidebar-item has-sub">
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
                                <div class="d-none d-md-block d-lg-inline-block">Hi, <?php echo $username; ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="update.php"><i data-feather="user"></i> Account</a>
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
                            <h3>Update Password</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Password</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>


                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" id="updateCredentialsForm" method="POST">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="username">Username</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="old-password">Old Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" class="form-control" name="old_password" id="old-password" value="<?php echo htmlspecialchars($password); ?>">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-key"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="new-password">New Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" class="form-control" name="new_password" id="new-password" required>
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-key"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="confirm-password">Confirm Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" class="form-control" name="confirm_password" id="confirm-password" required>
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-key"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1" name="update">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>
        </div>
    </div>
    <?php
    session_start();
    include '../process/db_config.php'; // Adjust path as necessary

    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $username = $_POST['username'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Fetch the current password from the database
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $current_password = $user['password'];
        $stmt->close();

        // Verify the old password
        if (!password_verify($old_password, $current_password)) {
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Old password is incorrect.'
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = 'update_credentials.php';
            }
        });
        </script>";
            exit;
        }

        // Check if new password and confirm password match
        if ($new_password !== $confirm_password) {
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Passwords do not match.'
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = 'update_credentials.php';
            }
        });
        </script>";
            exit;
        }

        // Ensure the new password meets the criteria
        if (!preg_match('/^(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/', $new_password)) {
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Password must be at least 8 characters long and contain at least one special character.'
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = 'update_credentials.php';
            }
        });
        </script>";
            exit;
        }

        // Update the username and password in the database
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $update_query = "UPDATE users SET username = ?, password = ? WHERE user_id = ?";
        $stmt_update = $conn->prepare($update_query);
        $stmt_update->bind_param("ssi", $username, $hashed_password, $user_id);

        if ($stmt_update->execute()) {
            echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Credentials Updated Successfully',
            text: 'Your username and password have been updated.',
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = 'admin_dashboard.php'; // Adjust the redirect URL as needed
            }
        });
        </script>";
        } else {
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to update credentials. Please try again later.'
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = 'update_credentials.php';
            }
        });
        </script>";
        }

        $stmt_update->close();
        $conn->close();
    }
    ?>


    <script>
        document.getElementById('updateCredentialsForm').addEventListener('submit', function(event) {
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const passwordRegex = /^(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;

            if (newPassword !== confirmPassword) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Passwords do not match.'
                });
                return false;
            }

            if (!passwordRegex.test(newPassword)) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Password must be at least 8 characters long and contain at least one special character.'
                });
                return false;
            }
        });

        feather.replace();
    </script>

    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>