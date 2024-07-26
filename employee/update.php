<?php
include ('header.php');
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
                        <li class="sidebar-item ">
                            <a href="employee_dashboard.php" class='sidebar-link'>
                                <i class="fa fa-home text-success"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="apply_leave.php" class='sidebar-link'>
                                <i class="fa fa-plane text-success"></i>
                                <span>Apply Leave</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="leave_status.php" class='sidebar-link'>
                                <i class="fa fa-plane text-success"></i>
                                <span>Leave Status</span>
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
                                <a class="dropdown-item" href="update_password.php"><i data-feather="settings"></i> Settings</a>
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
                            <h3>Update Profile</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Form section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="update.php" method="POST" class="form" autocomplete="off">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-icon">First Name</label>
                                                        <input type="text" class="form-control" placeholder="First Name" id="first-name-icon" name="first_name" value="<?php echo $userData['first_name']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-icon">Last Name</label>
                                                        <input type="text" class="form-control" placeholder="Last Name" id="last-name-icon" name="last_name" value="<?php echo $userData['last_name']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="middle-name-icon">Middle Name</label>
                                                        <input type="text" class="form-control" placeholder="Middle Name" id="middle-name-icon" name="middle_name" value="<?php echo $userData['middle_name']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="gender-icon">Gender</label>
                                                        <select class="form-select" id="gender-icon" name="gender">
                                                            <option <?php if ($userData['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                                            <option <?php if ($userData['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="age-icon">Age</label>
                                                        <input type="text" class="form-control" placeholder="Age" id="age-icon" name="age" value="<?php echo $userData['age']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="contact-icon">Contact</label>
                                                        <input type="text" class="form-control" placeholder="Contact" id="contact-icon" name="contact" value="<?php echo $userData['contact_number']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="email-icon">Email</label>
                                                        <input type="email" class="form-control" placeholder="Email" id="email-icon" name="email" value="<?php echo $userData['email_address']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1" name="update_employee">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Form section end -->
            </div>
        </div>
    </div>
    <?php
    require_once '../phpqrcode/qrlib.php';
    session_start();

    // Check if the update form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_employee'])) {
        // Establish database connection
        include '../process/db_config.php'; // Adjust path as necessary

        // Sanitize and validate input data
        $employee_id = $_SESSION['employee_id'];
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];

        // Update profile without changing profile image
        $update_profile_query = "UPDATE employees SET 
                        last_name = ?, 
                        first_name = ?, 
                        middle_name = ?, 
                        age = ?, 
                        gender = ?, 
                        email_address = ?, 
                        contact_number = ? 
                        WHERE employee_id = ?";
        $stmt_update = $conn->prepare($update_profile_query);
        $stmt_update->bind_param("sssisssi", $last_name, $first_name, $middle_name, $age, $gender, $email, $contact, $employee_id);

        // Check if prepare() was successful
        if ($stmt_update === false) {
            // Handle prepare error
            die('MySQL prepare error: ' . htmlspecialchars($conn->error));
        }

        // Execute the statement
        if ($stmt_update->execute()) {
            // Update successful, proceed to update QR code
            updateQRCode($conn, $employee_id, $last_name, $first_name);
            // Success message using SweetAlert and redirect
            echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Profile Updated Successfully',
            text: 'Data has been updated successfully.',
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = 'update.php'; 
            }
        });
        </script>";
            exit; // Stop further execution after displaying success message and redirecting
        } else {
            // Error handling if update fails
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Failed to update profile. Please try again later.'
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = 'update.php';
            }
        });
        </script>";
        }

        // Close statement
        $stmt_update->close();
        // Close connection (consider moving this to the end of your script)
        $conn->close();
    }

    // Function to update QR code based on employee details
    function updateQRCode($conn, $employee_id, $last_name, $first_name)
    {
        // Generate updated QR code content
        $employee_info = [
            'Last Name' => $last_name,
            'First Name' => $first_name,
            // Add more fields as needed
        ];
        $qr_code_content = json_encode($employee_info);

        // Generate new QR code image path
        $qrCodePath = '../assets/QRimages/' . $last_name . '_' . time() . '.png';

        // Generate new QR code
        QRcode::png($qr_code_content, $qrCodePath);

        // Update QR code path in database
        $update_qr_query = "UPDATE employees SET qr_code = ? WHERE employee_id = ?";
        $stmt_qr = $conn->prepare($update_qr_query);
        $stmt_qr->bind_param("si", $qrCodePath, $employee_id);
        $stmt_qr->execute();
        $stmt_qr->close();
    }
    ?>


    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>