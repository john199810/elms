<?php
include('header.php');

// Include database configuration file
include('../process/db_config.php');
require_once '../phpqrcode/qrlib.php';

// Check if employee_id is provided via GET parameter
if (!isset($_GET['employee_id'])) {
    echo "Employee ID not provided.";
    exit;
}

$employee_id = $_GET['employee_id'];

// Fetch employee data based on employee_id
$query = "SELECT * FROM employees WHERE employee_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch employee details
    $employee = $result->fetch_assoc();

    // Assign variables for easy access
    $full_name = $employee['first_name'] . ' ' . $employee['last_name'];
    $employee_id_number = $employee['employee_id_number'];
    $age = $employee['age'];
    $gender = $employee['gender'];
    $email_address = $employee['email_address'];
    $contact_number = $employee['contact_number'];
    $department = $employee['department'];
    $designation = $employee['designation'];
    $profile_image = !empty($employee['profile_image']) ? '../assets/img/' . $employee['profile_image'] : '../assets/img/default.png';
    $qr_code = !empty($employee['qr_code']) ? $employee['qr_code'] : null;

    // Function to generate QR code and save it to a file
    function generateQRCode($text, $filename)
    {
        QRcode::png($text, $filename);
    }

    // If QR code exists, generate and save it
    if (!empty($qr_code)) {
        $qr_image_path = '../assets/QRimages/' . $employee['last_name'] . '_' . time() . '.png';
        generateQRCode($qr_code, $qr_image_path);
    }
} else {
    echo "Employee not found.";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />
    <link rel="icon" href="../assets/img/logo.jpg" type="image/x-icon">

    <style>
        .gradient-custom {
            background: #f6d365;
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
        }

        .card {
            border-radius: .5rem;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .profile-avatar img {
            width: 100%;
            /* Ensure the image fills the circle */
            max-width: 100px;
            /* Limit maximum size */
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .btn-custom {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-custom-lg {
            padding: 8px 30px;
            /* Larger padding for longer text */
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .card-body h6 {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .card-body hr {
            border-top: 1px solid #ccc;
        }

        .card-body p {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-8 mb-4 mb-lg-0">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white">
                                <img src="<?php echo $profile_image; ?>" alt="Avatar" class="img-fluid my-5 profile-avatar" />
                                <h5><?php echo $full_name; ?></h5>
                                <p><?php echo $designation; ?></p>
                                <a href="update.php?employee_id=<?php echo $employee_id; ?>"><i class="far fa-edit mb-2"></i></a>
                                <div class="d-flex justify-content-center flex-column align-items-center">
                                    <a href="employee_dashboard.php"><button class="btn-custom mb-2">Home</button></a>
                                    <?php if (!empty($qr_code)) : ?>
                                        <a href="<?php echo $qr_image_path; ?>" download="qr_code_<?php echo $employee['last_name']; ?>.png" class="btn btn-custom btn-custom-lg">Download QR</a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted"><?php echo $email_address; ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Phone</h6>
                                            <p class="text-muted"><?php echo $contact_number; ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Department</h6>
                                            <p class="text-muted"><?php echo $department; ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Employee ID</h6>
                                            <p class="text-muted"><?php echo $employee_id_number; ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Gender</h6>
                                            <p class="text-muted"><?php echo $gender; ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Age</h6>
                                            <p class="text-muted"><?php echo $age; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js">
    </script>
</body>

</html>