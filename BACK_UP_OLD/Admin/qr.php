<?php
include('components/header.php');
?>

<h4 class="page-title"><i class="bi bi-qr-code"></i> QR Code</h4>
<div class="container mt-4 table-container d-flex flex-wrap">
    <div class="qr-container card m-2">
        <img src="../assets/qr-codes/qrcode_news-update.png">
        <h6 class="text-center">News Update</h6>
    </div>
    <div class="qr-container card m-2">
        <img src="../assets/qr-codes/qrcode_ts.png">
        <h6 class="text-center">Tourist Spot</h6>
    </div>
    <div class="qr-container card m-2">
        <img src="../assets/qr-codes/qrcode_contact.png">
        <h6 class="text-center">Contact</h6>
    </div>
    <div class="qr-container card m-2">
        <img src="../assets/qr-codes/qrcode_store.png">
        <h6 class="text-center">Stores</h6>
    </div>
    <div class="qr-container card m-2">
        <img src="../assets/qr-codes/qrcode_accom.png">
        <h6 class="text-center">Accommodation</h6>
    </div>
    <div class="qr-container card m-2">
        <img src="../assets/qr-codes/qrcode_resto.png">
        <h6 class="text-center">Restaurants</h6>
    </div>
</div>
<?php
include('components/footer.php');
?>
<script>
    $(document).ready(function() {
        $('.nav-qr').addClass('nav-selected');
        $('.nav-manage').addClass('nav-selected');
    });
</script>