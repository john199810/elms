<?php
session_start();
include('../process/db_config.php');

if (!isset($_SESSION['otp_verified']) || !$_SESSION['otp_verified']) {
    // If OTP verification is not completed, redirect to the OTP page
    header("location: otp.php");
    exit;
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    // If session email is not set, redirect to the login page
    header("location: login.php");
    exit;
}

if (isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if new password and confirm password match
    if ($newPassword === $confirmPassword) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update the password in the database
        $sql = "UPDATE users SET password = ? WHERE email_address = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashedPassword, $email);

        if ($stmt->execute()) {
            // Password updated successfully
            $_SESSION['update_success'] = 'Password updated successfully.';
        } else {
            // Error updating password
            $_SESSION['update_error'] = 'Error updating password. Please try again.';
        }
    } else {
        // Passwords do not match
        $_SESSION['update_error'] = 'Passwords do not match. Please try again.';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/css/app.css">
</head>

<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h3>Update Password</h3>
                            </div>
                            <form id="updatePasswordForm" action="update_password.php" method="POST">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="newPassword">New Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="newPassword" name="newPassword" minlength="8" required>
                                        <div class="form-control-icon">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" minlength="8" required>
                                        <div class="form-control-icon">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <button type="submit" class="btn btn-primary float-end" name="updatePassword">Update Password</button>
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
    <script src="../assets/js/main.js"></script>

    <script>
        // Display SweetAlert for update success or error message if exists
        <?php if (isset($_SESSION['update_success'])) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?= $_SESSION['update_success'] ?>',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.php'; // Redirect to login page
                }
            });
            <?php unset($_SESSION['update_success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['update_error'])) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= $_SESSION['update_error'] ?>',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['update_error']); ?>
        <?php endif; ?>
    </script>
</body>

</html>
