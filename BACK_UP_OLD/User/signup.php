<?php
include('../global/components/login-top.php');
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>
<form id="frmTouristSignUp" class="frm-signup container card p-5 mt-5">
    <center>
        <h5 class="text-success">ISABELAPP</h5>
        <img src="../assets/system-img/logo.png" class="login-logo">
        <h6 class="">Tourist Signup</h6>
    </center>
    <div class="input-container">
        <label for="touritstName">Name</label>
        <input type="text" class="form-control" id="touritstName" required>
    </div>
    <div class="input-container">
        <label for="touristUsername">Username</label>
        <input type="text" class="form-control" id="touristUsername" required>
    </div>
    <div class="input-container">
        <label for="touristPassword">Password</label>
        <div class="loginPasswordContainer">
            <input type="password" id="touristPassword" class="input-password form-control input" required required>
            <button type="button" id="btnShowPassword" class="btn">
                <i class="show-password-icon bi bi-eye-slash-fill"></i>
            </button>
        </div>
    </div>

    <span class="text-success m-1" style="font-size: 13px;">Already have an account? <a href="tourist-login.php">Login</a></span>
    <div class="mt-3 d-flex justify-content-center">
        <button type="submit" class="btn btn-success m-1">Signup</button>
    </div>
</form>
<?php
include('../global/components/login-bottom.php');
?>
<script>
    $('body').removeClass('bg-success');
</script>