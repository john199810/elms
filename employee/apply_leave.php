<?php
include 'header.php';


// Include database configuration file
include('../process/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $leave_id = $_POST['leave_id'];
    $date_of_application = $_POST['date_of_application'];
    $remarks = $_POST['remarks'];
    $leave_status = 'pending'; // Default leave status
    $reference_number = uniqid('ref_'); // Generate a unique reference number

    // Handle file upload
    $attachment_path = NULL;
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $target_dir = "../assets/leaveAttachments/";
        $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
            $attachment_path = $target_file;
        } else {
            $_SESSION['leave_application_status'] = [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Failed to upload attachment.'
            ];
            header('Location: apply_leave.php');
            exit();
        }
    }

    // Prepare SQL query
    $sql = "INSERT INTO leaveapplications (reference_number, employee_id, leave_id, date_of_application, attachment, leave_status, remarks, date_created, date_updated) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("siissss", $reference_number, $employee_id, $leave_id, $date_of_application, $attachment_path, $leave_status, $remarks);

        // Execute statement
        if ($stmt->execute()) {
            $_SESSION['leave_application_status'] = [
                'icon' => 'success',
                'title' => 'Success',
                'text' => 'Leave application submitted successfully!'
            ];
        } else {
            $_SESSION['leave_application_status'] = [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Failed to submit leave application: ' . $stmt->error
            ];
        }

        // Close statement
        $stmt->close();
    } else {
        $_SESSION['leave_application_status'] = [
            'icon' => 'error',
            'title' => 'Error',
            'text' => 'Failed to prepare statement: ' . $conn->error
        ];
    }

    // Close connection
    $conn->close();

    // Redirect back to the form page to show SweetAlert
    header('Location: apply_leave.php');
    exit();
}


// Prepare and execute statement
$stmt = $conn->prepare("SELECT leave_id, leave_name FROM leavetypes");
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($leave_id, $leave_name);

// Fetch the results into an array
$leave_types = [];
while ($stmt->fetch()) {
    $leave_types[] = [
        'leave_id' => $leave_id,
        'leave_name' => $leave_name
    ];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Leave</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
                        <li class="sidebar-item active">
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
                            <h3>Apply for Leave</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="employee_dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Leave Application</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>


                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="apply_leave.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="leave-type">Select Leave Type</label>
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="leave-type" name="leave_id">
                                                                    <?php foreach ($leave_types as $leave_type) : ?>
                                                                        <option value="<?php echo $leave_type['leave_id']; ?>"><?php echo $leave_type['leave_name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="date-of-application">Date of Application</label>
                                                        <div class="position-relative">
                                                            <input type="date" class="form-control" id="date-of-application" name="date_of_application">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="attachment">Attachment</label>
                                                        <div class="position-relative">
                                                            <input type="file" class="form-control" id="attachment" name="attachment">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-paperclip"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="remarks">Remarks</label>
                                                        <div class="position-relative">
                                                            <textarea class="form-control" placeholder="Remarks" id="remarks" name="remarks"></textarea>
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-comments"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>



    <!-- Handle form submission with SweetAlert -->
    <?php if (isset($_SESSION['leave_application_status'])) : ?>
        <script>
            Swal.fire({
                icon: '<?php echo $_SESSION['leave_application_status']['icon']; ?>',
                title: '<?php echo $_SESSION['leave_application_status']['title']; ?>',
                text: '<?php echo $_SESSION['leave_application_status']['text']; ?>'
            });
            <?php unset($_SESSION['leave_application_status']); ?>
        </script>
    <?php endif; ?>

    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>