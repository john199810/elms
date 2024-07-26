<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="icon" href="../assets/img/logo.jpg" type="image/x-icon">


    <style type="text/css">
        .notif:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        /* Keyframe animation */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                        <li class="sidebar-item active has-sub">
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
                            <h3>Add Employee</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin_dashboard.php" class="text-success">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Employee</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>

                <?php
                // Fetch departments
                $departments = [];
                $departments_query = "SELECT department_id, department_name FROM departments";
                $result = $conn->query($departments_query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $departments[] = $row;
                    }
                }

                // Fetch designations
                $designations = [];
                $designations_query = "SELECT designation_id, designation_name FROM designations";
                $result = $conn->query($designations_query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $designations[] = $row;
                    }
                }
                ?>


                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">First Name</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" placeholder="First Name" id="first-name-icon" name="first_name">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="middle-name-icon">Middle Name</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" placeholder="Middle Name" id="middle-name-icon" name="middle_name">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="last-name-icon">Last Name</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" placeholder="Last Name" id="last-name-icon" name="last_name">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="gender-icon">Gender</label>
                                                        <div class="position-relative">
                                                            <select class="form-select" id="gender-icon" name="gender">
                                                                <option>Male</option>
                                                                <option>Female</option>
                                                                <option>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="email-icon">Email</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" placeholder="Email" id="email-icon" name="email">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-envelope"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="age-icon">Age</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" placeholder="Age" id="age-icon" name="age">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="contact-icon">Contact</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" placeholder="Contact" id="contact-icon" name="contact">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-phone"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="profile-icon">Profile</label>
                                                        <div class="position-relative">
                                                            <input type="file" class="form-control" id="profile-icon" name="profile">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="department-floating">Department</label>
                                                        <select class="form-select" id="department-floating" name="department">
                                                            <?php foreach ($departments as $department) : ?>
                                                                <option value="<?= $department['department_name'] ?>"><?= $department['department_name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="designation-column">Designation</label>
                                                        <select class="form-select" id="designation-column" name="designation">
                                                            <?php foreach ($designations as $designation) : ?>
                                                                <option value="<?= $designation['designation_name'] ?>"><?= $designation['designation_name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="username-icon">Username</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" placeholder="Username" id="username-icon" name="username">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="password-icon">Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" class="form-control" placeholder="Password" id="password-icon" name="password">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-key"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1" name="add_employee">Submit</button>
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
    include '../process/db_config.php'; // Make sure this file has your database connection details
    require_once 'phpqrcode/qrlib.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_employee'])) {
        // Sanitize and validate input data
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $department = $_POST['department'];
        $designation = $_POST['designation'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $account_status = 'Activated'; // Default to Activated
        $otp_code = ''; // Initialize OTP as blank
        $qr_code = null;

        // Check if profile image was uploaded
        if ($_FILES['profile']['error'] === UPLOAD_ERR_OK) {
            $profile_image = $_FILES['profile']['name'];
            $profile_image_tmp = $_FILES['profile']['tmp_name'];
            $profile_image_path = '../assets/img/' . $profile_image;

            // Move uploaded file to destination
            if (!move_uploaded_file($profile_image_tmp, $profile_image_path)) {
                // Handle file upload error
                echo "<script>alert('Failed to upload profile image. Please try again.');</script>";
                exit;
            }
        } else {
            // Set default profile image if no image is uploaded
            $profile_image = 'default.jpg';
            $profile_image_path = '../assets/img/default.jpg';
        }

        // Generate employee ID number
        $query = mysqli_query($conn, "SELECT MAX(employee_id) AS max_id FROM employees");
        $row = mysqli_fetch_assoc($query);
        $next_id = $row['max_id'] + 1;
        $employee_id_number = 'ELMS-' . sprintf('%03d', $next_id);

        // Generate QR code content for basic employee information
        $employee_info = [
            'ID Number' => $employee_id_number,
            'Last Name' => $last_name,
            'First Name' => $first_name,
            'Email' => $email,
            'Department' => $department,
            // Add more fields as needed
        ];
        $qr_code_content = json_encode($employee_info);

        // Generate QR code image
        $qrCodePath = '../assets/QRimages/' . $last_name . '_' . time() . '.png';
        QRcode::png($qr_code_content, $qrCodePath);

        // Insert data into employees table
        $insert_query = "INSERT INTO employees 
                    (employee_id_number, last_name, first_name, middle_name, age, gender, email_address, contact_number, department, designation, profile_image, username, password, account_status, otp_code, qr_code) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insert_query);

        $stmt->bind_param("ssssisssssssssss", $employee_id_number, $last_name, $first_name, $middle_name, $age, $gender, $email, $contact, $department, $designation, $profile_image, $username, $password, $account_status, $otp_code, $qrCodePath);

        if ($stmt->execute()) {
            // Success message using SweetAlert
            echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Employee Added Successfully',
            text: 'Data has been saved successfully.',
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = 'add_employee.php';
            }
        });
        </script>";
            exit; // Stop further execution after displaying success message
        } else {
            // Error handling if insertion fails
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to add employee. Please try again later.'
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = 'add_employee.php';
            }
        });
        </script>";
        }

        $stmt->close();
        $conn->close(); // Close database connection
    }
    ?>


    <script>
        // Trigger animations when page is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.container').style.opacity = '1';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/js/main.js"></script>

</body>

</html>