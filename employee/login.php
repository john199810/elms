<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="icon" href="../assets/img/logo.jpg" type="image/x-icon">
</head>

<body>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h3>Sign In</h3>
                            </div>
                            <form action="" method="POST" id="loginForm">
                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">Username</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="username" name="username">
                                        <div class="form-control-icon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                        <a href="forget_password.php" class='float-end'>
                                            <small>Forgot password?</small>
                                        </a>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <div class="form-control-icon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <button type="submit" class="btn btn-primary float-end" name="login">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    session_start();
    include '../process/db_config.php'; // Include your database connection file

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $errorMessage = null;

        // Validate input
        if (empty($username) || empty($password)) {
            $errorMessage = 'Username or password is empty!';
        } else {
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
                    // Check if the account is deactivated
                    if ($user['account_status'] == 'Deactivated') {
                        $errorMessage = 'Your account is deactivated. Please contact your administrator.';
                    } else {
                        $_SESSION['username'] = $username;
                        $_SESSION['employee_id'] = $user['employee_id'];
                        $_SESSION['login_time'] = time(); // Set login time

                        // Redirect based on account status
                        if ($user['account_status'] == 'Activated') {
                            echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: 'Welcome to Employee Dashboard.',
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location.href = 'employee_dashboard.php?employee_id=" . $user['employee_id'] . "';
                            }
                        });
                        </script>";
                            exit;
                        } else {
                            $errorMessage = 'Your account is not activated.';
                        }
                    }
                } else {
                    $errorMessage = 'Invalid password!';
                }
            } else {
                $errorMessage = 'Invalid username!';
            }

            $stmt->close();
            $conn->close();
        }

        if ($errorMessage) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
            echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '$errorMessage'
        });
        </script>";
        }
    }
    ?>

    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>