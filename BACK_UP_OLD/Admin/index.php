<?php
include('../global/components/login-top.php');
if (isset($_SESSION['admin_id'])) {
    $checkUserId = $db->checkUserId('admin', $_SESSION['admin_id']);
    if ($checkUserId->num_rows > 0) {
        header("Location: dashboard.php");
        exit();
    }
}
?>
<form id="frmAdminLogin" class="frm-login container card p-5 mt-5">
    <center>
        <h5 class="text-success">ISABELAPP</h5>
        <img src="../assets/system-img/logo.png" class="login-logo">
        <h6 class="">Admin Login</h6>
    </center>
    <div class="input-container">
        <label for="adminUsername">Username</label>
        <input type="text" id="adminUsername" class="form-control input" required>
    </div>
    <div class="input-container">
        <label for="adminPassword">Password</label>
        <div class="loginPasswordContainer">
            <input type="password" id="adminPassword" class="input-password form-control input" required>
            <button type="button" id="btnShowPassword" class="btn">
                <i class="show-password-icon bi bi-eye-slash-fill"></i>
            </button>
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-center">
        <a href="../index.php" class="btn btn-dark m-1">Back</a>
        <button type="submit" class="btn btn-success m-1">Login</button>
    </div>
</form>
<?php
include('../global/components/login-bottom.php');
