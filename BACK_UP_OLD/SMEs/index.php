<?php
include('../global/components/login-top.php');
if (isset($_SESSION['smes_id'])) {
    if (isset($_SESSION['smes_type'])) {
        $checkSmesId = $db->checkSmesId($_SESSION['smes_type'], $_SESSION['smes_id']);
        if ($checkSmesId->num_rows > 0) {
            if ($_SESSION['smes_type'] == 'accommodation') {
                header("Location: SMEs/accommodation/index.php");
                exit();
            } elseif ($_SESSION['smes_type'] == 'seller') {
                header("Location: SMEs/seller/index.php");
                exit();
            } elseif ($_SESSION['smes_type'] == 'restaurant') {
                header("Location: SMEs/restaurant/index.php");
                exit();
            }
        }
    }
}
?>
<form id="frmSMEsLogin" class="frm-login container card p-5 mt-5">
    <center>
        <h5 class="text-success">ISABELAPP</h5>
        <img src="../assets/system-img/logo.png" class="login-logo">
        <h6 class="">SMEs Login</h6>
    </center>
    <div class="input-container">
        <label for="smesAccountType">Account Type</label>
        <select class="form-control" id="smesAccountType" required>
            <option disabled selected value="">Select Account Type</option>
            <option value="accommodation">Accommodation</option>
            <option value="seller">Seller</option>
            <option value="restaurant">Restaurant</option>
        </select>
    </div>
    <div class="input-container">
        <label for="smesUsername">Username</label>
        <input type="text" id="smesUsername" class="form-control input" required>
    </div>
    <div class="input-container">
        <label for="smesPassword">Password</label>
        <div class="loginPasswordContainer">
            <input type="password" id="smesPassword" class="input-password form-control input" required>
            <button type="button" id="btnShowPassword" class="btn">
                <i class="show-password-icon bi bi-eye-slash-fill"></i>
            </button>
        </div>
    </div>
    <span class="text-success m-1" style="font-size: 13px;">Don't have an account? <a href="signup.php">Signup</a></span>
    <div class="mt-3 d-flex justify-content-center">
        <a href="../index.php" class="btn btn-dark m-1">Back</a>
        <button type="submit" class="btn btn-success m-1">Login</button>
    </div>
</form>
<?php
include('../global/components/login-bottom.php');
