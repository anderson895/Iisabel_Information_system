<?php
session_start();
include('../backend/class.php');
$db = new global_class();
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISABELAPP | Admin</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../global/css/login.css">
    <link rel="stylesheet" href="../global/css/styles.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="../assets/system-img/logo.png" type="image/x-icon">
</head>

<alert class="alert"></alert>

<body class="">
    <button class="btn" id="btnOpenNav">
        <i class="bi bi-list"></i>
    </button>
    <aside class="side-nav bg-success ">
        <button class="btn" id="btnCloseNav">
            <i class="bi bi-x-lg"></i>
        </button>
        <div class="text-center mt-3 mb-3">
            <a href="dashboard.php" class="logo">
                <img src="../assets/system-img/logo.png">
            </a>
        </div>
        <ul class="list-group nav-ul">
            <li><a href="dashboard.php" class="nav-dashboard"><i class="bi bi-clipboard-check-fill"></i> Dashboard</a></li>
            <li><a href="accounts.php" class="nav-accounts"><i class="bi bi-people-fill"></i> Accounts Sign in</a></li>
            <li><a href="rating-reviews.php" class="nav-ratings"><i class="bi bi-hand-thumbs-up-fill"></i> Ratings & Reviews</a></li>
            <li class="li-manage">
                <a href="#" id="btnManage" class="nav-manage"><i class="bi bi-kanban"></i> Manage</a>
                <ul class="list-group ul-manage mt-5">
                    <li><a href="news.php" class="nav-news"><i class="bi bi-newspaper"></i> News Update</a></li>
                    <li><a href="accommodation.php" class="nav-accom"><i class="bi bi-building"></i> Accommodation</a></li>
                    <li><a href="store.php" class="nav-products"><i class="bi bi-shop"></i> Products</a></li>
                    <li><a href="tourist-spot.php" class="nav-spots"><i class="bi bi-card-image"></i> Tourist Spot</a></li>
                    <li><a href="restaurant.php" class="nav-resto"><i class="bi bi-egg-fried"></i> Restaurant</a></li>
                    <li><a href="contact.php" class="nav-contact"><i class="bi bi-telephone-fill"></i> Contact</a></li>
                    <li><a href="qr.php" class="nav-qr"><i class="bi bi-qr-code"></i> QR Code</a></li>
                </ul>
            </li>
        </ul>
        <div class="logout-container text-center mt-5">
            <a href="../process/logout.php" class="btn btn-light"><i class="bi bi-box-arrow-left"></i> Logout</a>
        </div>
    </aside>
    <main class="p-3">