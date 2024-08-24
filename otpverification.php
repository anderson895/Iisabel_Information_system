<?php 
// session_start();
// echo "<pre>";

// print_r($_SESSION);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="global/css/otp.css">
</head>
<body class="container-fluid bg-body-tertiary d-block">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
            <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                <div class="card-body p-5 text-center">
                    <h4>Verify OTP</h4>
                    <p>Your OTP was sent to you via email</p>

                    <div class="otp-field mb-4">
                        <input type="number" id="otp1" maxlength="1" oninput="moveToNext(this, 'otp2')" />
                        <input type="number" id="otp2" maxlength="1" oninput="moveToNext(this, 'otp3')" />
                        <input type="number" id="otp3" maxlength="1" oninput="moveToNext(this, 'otp4')" />
                        <input type="number" id="otp4" maxlength="1" oninput="moveToNext(this, 'otp5')" />
                        <input type="number" id="otp5" maxlength="1" oninput="moveToNext(this, 'otp6')" />
                        <input type="number" id="otp6" maxlength="1" />
                    </div>

                    <button class="btn btn-primary mb-3" onclick="verifyOTP()">
                        Verify
                    </button>

                    <p id="otp-error" class="text-danger"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <!-- Footer content here if needed -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="global/js/otp.js"></script>
</body>
</html>
