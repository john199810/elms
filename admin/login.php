<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="icon" href="../assets/img/logo.jpg" type="image/x-icon">

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
                                <h3>Sign In</h3>
                            </div>
                            <form action="" method="POST">
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
                                    <button class="btn btn-primary float-end" name="login">Login</button>
                                </div>
                            </form>
                        </div>
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

        // Query to fetch user details based on username
        $query = "SELECT user_id, username, password, user_category FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $db_username, $hashed_password, $user_category);
            $stmt->fetch();

            // Verify hashed password
            if (password_verify($password, $hashed_password)) {
                // Password correct, set session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $db_username;
                $_SESSION['userCategory'] = $user_category;
                $stmt->close();
                $conn->close();

                // Redirect to dashboard with SweetAlert message
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful',
                    text: 'Welcome to Admin Dashboard.',
                }).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location.href = 'admin_dashboard.php';
                    }
                });
            </script>";
                exit;
            } else {
                // Incorrect password
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: 'Incorrect password. Please try again.',
                });
            </script>";
            }
        } else {
            // User not found
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: 'Username not found.',
            });
        </script>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>

    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>