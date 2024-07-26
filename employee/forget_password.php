<?php
session_start();
include('../process/db_config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if email exists and account status is active
    $sql = "SELECT * FROM employees WHERE email_address = ? AND account_status = 'Activated'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $employee_id = $row['employee_id'];
        $full_name = $row['full_name'];

        // Generate OTP
        $otp = rand(100000, 999999);

        // Update OTP in database
        $updateSql = "UPDATE employees SET otp_code = ? WHERE employee_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ii", $otp, $employee_id);

        if ($updateStmt->execute()) {
            try {
                // Send OTP email using PHPMailer
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sisonpatrick1998@gmail.com'; // Replace with your Gmail address
                $mail->Password = 'uyge vczs zdjd acln'; // Replace with your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->setFrom('sisonpatrick1998@gmail.com', 'Your Name'); // Replace with your name
                $mail->addAddress($email, $full_name);
                $mail->isHTML(true);

                // Email subject and content
                $subject = 'Password Reset OTP';
                $message = "<!DOCTYPE html>";
                $message .= "<html>";
                $message .= "<head><meta charset='utf-8'></head>";
                $message .= "<body>";
                $message .= "<h1>Password Reset OTP</h1>";
                $message .= "<p><b>Dear $full_name,</b></p>";
                $message .= "<p>Your OTP for password reset is: <strong>$otp</strong>.</p>";
                $message .= "<p>This OTP is valid for 3 minutes only. Please use it to reset your password.</p>";
                $message .= "<p>Thank you.</p>";
                $message .= "<p>Best regards,<br>Your Name</p>"; // Replace with your name
                $message .= "</body>";
                $message .= "</html>";

                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->AltBody = 'Your OTP for password reset is: ' . $otp . '.';

                // Send email
                if ($mail->send()) {
                    $_SESSION['email'] = $email;
                    $_SESSION['forget'] = 'Email sent successfully. Please check your inbox.';
                    header("location: otp.php"); // Redirect to otp.php
                    exit;
                } else {
                    $_SESSION['forget_error'] = 'Error sending email: ' . $mail->ErrorInfo;
                    header("location: forget_password.php");
                    exit;
                }
            } catch (Exception $e) {
                $_SESSION['forget_error'] = 'Error sending email: ' . $e->getMessage();
                header("location: forget_password.php");
                exit;
            }
        } else {
            $_SESSION['forget_error'] = 'Error updating OTP in the database: ' . $updateStmt->error;
            header("location: forget_password.php");
            exit;
        }
    } else {
        $_SESSION['forget_error'] = 'Email not found or account is not active.';
        header("location: forget_password.php");
        exit;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script defer src="../assets/fontawesome/js/all.min.js"></script>
</head>

<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h3>Forgot Password</h3>
                                <p>Enter your email to reset your password</p>
                            </div>
                            <form id="forgotPasswordForm" action="forget_password.php" method="POST">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="email">Email</label>
                                    <div class="position-relative">
                                        <input type="email" class="form-control" id="email" name="email" required>
                                        <div class="form-control-icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <a id="backToLogin" href="login.php">Back to Login</a>
                            </div>
          
