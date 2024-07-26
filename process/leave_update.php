<?php
include('db_config.php');

// Include PHPMailer dependencies
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

// Initialize PHPMailer
$mail = new PHPMailer(true); // Passing `true` enables exceptions

// Check if form is submitted
if (isset($_POST['edit_status'])) {
    // Get form data
    $application_id = $_POST['application_id'];
    $status = $_POST['status'];

    try {
        // Update leave status in the database
        $update = $conn->query("UPDATE leaveapplications SET leave_status = '$status' WHERE application_id = '$application_id'");

        // Check if update was successful
        if ($update) {
            // Fetch employee email based on application_id
            $sql = "SELECT e.email_address, CONCAT(e.first_name, ' ', e.last_name) AS full_name 
                FROM leaveapplications la
                JOIN employees e ON la.employee_id = e.employee_id
                WHERE la.application_id = '$application_id'";
            $result = $conn->query($sql);

            // Check if employee email is fetched
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $email = $row['email_address'];
                $full_name = $row['full_name'];

                // Determine email subject and content based on leave status
                $subject = 'Leave Application Status Update';
                $message = "<!DOCTYPE html>";
                $message .= "<html>";
                $message .= "<head><meta charset='utf-8'></head>";
                $message .= "<body>";
                $message .= "<h1>Leave Application Status Update</h1>";
                $message .= "<p><b>Dear $full_name,</b></p>";

                if ($status == 'approved') {
                    $message .= "<p>Your leave application has been <strong>approved</strong>.</p>";
                } elseif ($status == 'cancelled') {
                    $message .= "<p>Your leave application has been <strong>cancelled</strong>.</p>";
                } else {
                    // Handle other statuses if needed
                    $message .= "<p>Your leave application status has been updated to <strong>$status</strong>.</p>";
                }

                $message .= "<p>Thank you.</p>";
                $message .= "<p>Best regards,<br>Employee Management System</p>";
                $message .= "</body>";
                $message .= "</html>";

                // Send OTP email using PHPMailer
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'sisonpatrick1998@gmail.com'; // Replace with your Gmail address
                $mail->Password = 'uyge vczs zdjd acln'; // Replace with your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->setFrom('sisonpatrick1998@gmail.com', 'Employee Management System');
                $mail->addAddress($email, $full_name);
                $mail->isHTML(true);

                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->AltBody = 'This is the plain text version of the email content';

                // Send email
                $mail->send();

                // Redirect after sending email
                $_SESSION['email'] = $email;
                $_SESSION['forget'] = 'Email sent successfully. Please check your inbox.';
                header("location: ../admin/pending_leave.php");
                exit;
            } else {
                echo 'Employee email not found.';
            }
        } else {
            echo 'Error updating leave status in the database.';
        }
    } catch (Exception $e) {
        echo "Error: {$e->getMessage()}";
    }
}

// Close the database connection
$conn->close();
?>
