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

function pleaseSelectAccountType()
{
?>
    <div class="container card p-5 text-center mt-5">
        <h4 class="text-danger">Please Select Account Type!</h4>
        <span class="text-success m-1" style="font-size: 13px;">Already have an account? <a href="index.php">Login</a></span>
    </div>
<?php
}

?>

<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['smes_type']) && $_GET['smes_type'] == 'accommodation') ? 'active' : '' ?>" href="signup.php?smes_type=accommodation">Accommodation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['smes_type']) && $_GET['smes_type'] == 'seller') ? 'active' : '' ?>" href="signup.php?smes_type=seller">Seller</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['smes_type']) && $_GET['smes_type'] == 'restaurant') ? 'active' : '' ?>" href="signup.php?smes_type=restaurant">Restaurant</a>
        </li>
    </ul>
</div>

<?php

if (isset($_GET['smes_type'])) {
    $smesType = $_GET['smes_type'];
    if ($smesType == 'accommodation' || $smesType == 'seller' || $smesType == 'restaurant') {
?>
        <form id="frmSMEsSignUp" class="frm-signup container card p-5 mt-5">
            <center>
                <h5 class="text-success">ISABELAPP</h5>
                <img src="../assets/system-img/logo.png" class="login-logo">
                <h6 class=""><?= ucfirst($smesType) ?> Account Signup</h6>
            </center>
            <div class="input-container">
                <label for="smesName"><?= ucfirst($smesType) ?> Name</label>
                <input type="text" class="form-control" id="smesName" required>
            </div>
            <div class="input-container">
                <label for="smesAddress">Address</label>
                <input type="text" class="form-control" id="smesAddress" placeholder="st / blg / blk & lot, barangay, municipality" required>
            </div>
            <div class="input-container">
                <label for="smesUsername">Username</label>
                <input type="text" class="form-control" id="smesUsername" required>
            </div>
            <div class="input-container">
                <label for="smesPassword">Password</label>
                <div class="loginPasswordContainer">
                    <input type="password" id="smesPassword" class="input-password form-control input" required required>
                    <button type="button" id="btnShowPassword" class="btn">
                        <i class="show-password-icon bi bi-eye-slash-fill"></i>
                    </button>
                </div>
            </div>

            <span class="text-success m-1" style="font-size: 13px;">Already have an account? <a href="index.php">Login</a></span>
            <div class="mt-3 d-flex justify-content-center">
                <input type="hidden" id="smesType" value="<?= $smesType ?>">
                <button type="submit" class="btn btn-success m-1">Signup</button>
            </div>
        </form>
<?php
    } else {
        pleaseSelectAccountType();
    }
} else {
    pleaseSelectAccountType();
}
?>
<!-- <form id="frmSMEsSignup" class="frm-signup container card p-5 mt-5">
    <center>
        <h5 class="text-success">ISABELAPP</h5>
        <img src="../assets/system-img/logo.png" class="login-logo">
        <h6 class="">SMEs Signup</h6>
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
    <span class="text-success m-1" style="font-size: 13px;">Already have an account? <a href="index.php">Login</a></span>
    <div class="mt-3 d-flex justify-content-center">
        <a href="signup.php" class="btn btn-primary m-1">Signup</a>
    </div>
</form> -->
<?php
include('../global/components/login-bottom.php');
?>
<script>
    $('body').removeClass('bg-success');
</script>