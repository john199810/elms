<?php
session_start();
include('../process/db_config.php');

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    if (isset($_POST['otp'])) {
        // Sanitize and validate OTP input
        $otp = implode('', $_POST['otp']); // Concatenate OTP array into a single string

        // Check if OTP matches for the provided email
        $sql = "SELECT * FROM users WHERE email_address = ? AND otp_code = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $otp);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // OTP matched, proceed to reset password or any other action
            $_SESSION['otp_verified'] = true;
            $email = $_SESSION['email'];
            header("location: update_password.php"); // Redirect to password update page
            exit;
        } else {
            // OTP did not match
            $_SESSION['otp_error'] = 'Invalid OTP entered. Please try again.';
        }
    }
} else {
    // If session email is not set, redirect to the forget password page
    header("location: forget_password.php");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm OTP</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/css/app.css">
    <style>
        .otp-input {
            width: 40px;
            text-align: center;
            margin: 0 5px;
            padding: 10px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h3>Confirm OTP</h3>
                            </div>
                            <form id="otpForm" action="otp.php" method="POST">
                                <!-- Replace the OTP input with six separate input boxes -->
                                <div class="form-group d-flex justify-content-center">
                                    <input type="text" class="form-control otp-input" id="otp1" name="otp[]" maxlength="1" required>
                                    <input type="text" class="form-control otp-input" id="otp2" name="otp[]" maxlength="1" required>
                                    <input type="text" class="form-control otp-input" id="otp3" name="otp[]" maxlength="1" required>
                                    <input type="text" class="form-control otp-input" id="otp4" name="otp[]" maxlength="1" required>
                                    <input type="text" class="form-control otp-input" id="otp5" name="otp[]" maxlength="1" required>
                                    <input type="text" class="form-control otp-input" id="otp6" name="otp[]" maxlength="1" required>
                                </div>

                                <div class="clearfix">
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // Display SweetAlert for OTP error message if exists
        <?php if (isset($_SESSION['otp_error'])) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= $_SESSION['otp_error'] ?>',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['otp_error']); ?>
        <?php endif; ?>
    </script>
</body>

</html>
