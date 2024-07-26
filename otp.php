<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/css/app.css">
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
                            <form action="process/login.php" method="POST">
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
                                    <button class="btn btn-primary float-end" name="login">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>
