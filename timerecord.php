<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time In / Time Out</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="icon" href="assets/img/logo.jpg" type="image/x-icon">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-top: 50px;
            animation: fadeIn 2s;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            animation: slideUp 1s;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-secondary {
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-secondary:hover {
            transform: scale(1.05);
        }

        .modal-body {
            text-align: center;
        }

        .time-display {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .back-homepage {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .back-homepage i {
            transition: transform 0.3s;
        }

        .back-homepage:hover i {
            transform: translateX(-5px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div id="auth">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4">Time In / Time Out</h1>
                <div id="date-time" class="time-display"></div>
            </div>
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h3>Scan QR Code</h3>
                                <p>Scan your QR code to time in</p>
                            </div>
                            <div class="d-flex justify-content-center mb-3">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#qrModal">Scan QR</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="index.html" class="back-homepage">
                                    <i class="fas fa-arrow-left"></i> Back to Homepage
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR Modal -->
        <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrModalLabel">Scan QR Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <video id="qr-video" width="100%" autoplay></video>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script>
        // Display current date and time
        function updateDateTime() {
            const now = new Date();
            const dateTimeStr = now.toLocaleString();
            document.getElementById('date-time').textContent = dateTimeStr;
        }
        setInterval(updateDateTime, 1000);

        // Initialize QR code scanner
        window.addEventListener('load', () => {
            const codeReader = new ZXing.BrowserQRCodeReader();
            codeReader.decodeFromInputVideoDevice(undefined, 'qr-video').then(result => {
                // Send AJAX request to PHP script with the scanned QR code
                fetch('process_qr.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ qr_code: result.text })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Scan successful: ' + data.message);
                        // Text-to-Speech for success
                        const msg = new SpeechSynthesisUtterance(data.message);
                        window.speechSynthesis.speak(msg);
                    } else {
                        alert('Scan failed: ' + data.message);
                        // Text-to-Speech for failure
                        const msg = new SpeechSynthesisUtterance(data.message);
                        window.speechSynthesis.speak(msg);
                    }
                })
                .catch(error => console.error('Error:', error));
            }).catch(err => {
                console.error(err);
            });
        });
    </script>
</body>

</html>
