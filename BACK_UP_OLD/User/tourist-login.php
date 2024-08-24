<?php
include('../global/components/login-top.php');
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>
<form id="frmTouristLogin" class="frm-login container card p-5 mt-3">
    <center>
        <h5 class="text-success">ISABELAPP</h5>
        <img src="../assets/system-img/logo.png" class="login-logo">
        <h6 class="">Tourist Login</h6>
    </center>
    <div class="input-container">
        <label for="touristUsername">Username</label>
        <input type="text" id="touristUsername" class="form-control input" required>
    </div>
    <div class="input-container">
        <label for="touristPassword">Password</label>
        <div class="loginPasswordContainer">
            <input type="password" id="touristPassword" class="input-password form-control input" required>
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
