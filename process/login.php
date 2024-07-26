<?php
session_start();
include 'db_config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Username or password is empty!'
            });
          </script>";
        exit;
    }

    // Prepare SQL statement to check if the employee exists
    $stmt = $conn->prepare("SELECT * FROM employees WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['employee_id'] = $user['employee_id'];
            $_SESSION['login_time'] = time(); // Set login time

            // Redirect to the employee dashboard with employee_id
            echo "<script>window.location.href = 'employee_dashboard.php?employee_id=" . $user['employee_id'] . "';</script>";
            exit;
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid password!'
                });
              </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid username!'
            });
          </script>";
    }

    $stmt->close();
    $conn->close();
}

