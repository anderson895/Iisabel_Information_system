<?php
session_start();
include('../backend/class.php');
$db = new global_class();
$isLogin = false;
if (isset($_SESSION['user_id'])) {
    $getUsers = $db->getTouristUsingId($_SESSION['user_id']);
    if ($getUsers->num_rows > 0) {
        $user = $getUsers->fetch_assoc();
        $isLogin = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISABELAPP</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../global/css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="../assets/system-img/logo.png" type="image/x-icon">
</head>

<div class="alert"></div>

<body>
    <nav class="top-nav d-flex justify-content-between align-items-center bg-success p-3 pt-0 pb-0 flex-wrap">
        <a href="index.php">
            <img src="../assets/system-img/logo.png">
        </a>
        <!--<div class="search-container">-->
        <!--    <input type="search" class="form-control" id="search">-->
        <!--    <button class="btn btn-light"><i class="bi bi-search"></i></button>-->
        <!--</div>-->
        <?php
        if ($isLogin) {
        ?>
            <div class="navs-a-container">
                <a href="../process/logout.php" class="btn btn-dark"><i class="bi bi-box-arrow-left"></i> Logout | <?= $user['NAME'] ?></a>
            </div>
        <?php
        } else {
        ?>
            <div class="navs-a-container d-flex justify-content-between" style="width: 230px;">
                <a href="tourist-login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                <a href="../SMEs"><i class="bi bi-person-check-fill"></i> SMEs</a>
                <a href="../Admin"><i class="bi bi-person-fill-gear"></i> Admin</a>
            </div>
        <?php
        }
        ?>
    </nav>

    <div class="side-nav bg-light">
        <a href="index.php?page=news" id="nav-news" class="<?= (isset($_GET['page']) && $_GET['page'] == 'news') ? 'side-nav-active' : '' ?>"><i class="bi bi-newspaper"></i> News Update</a>
        <a href="index.php?page=accommodation" id="nav-accom" class="<?= (isset($_GET['page']) && $_GET['page'] == 'accommodation') ? 'side-nav-active' : '' ?>"><i class="bi bi-building"></i> Accommodation</a>
        <a href="index.php?page=products" id="nav-products" class="<?= (isset($_GET['page']) && $_GET['page'] == 'products') ? 'side-nav-active' : '' ?>"><i class="bi bi-shop"></i> Products</a>
        <a href="index.php?page=tourist_spot" id="nav-ts" class="<?= (isset($_GET['page']) && $_GET['page'] == 'tourist_spot') ? 'side-nav-active' : '' ?>"><i class="bi bi-card-image"></i> Tourist Spot</a>
        <a href="index.php?page=restaurant" id="nav-resto" class="<?= (isset($_GET['page']) && $_GET['page'] == 'restaurant') ? 'side-nav-active' : '' ?>"><i class="bi bi-egg-fried"></i> Restaurant</a>
        <a href="index.php?page=hotline" id="nav-contact" class="<?= (isset($_GET['page']) && $_GET['page'] == 'hotline') ? 'side-nav-active' : '' ?>"><i class="bi bi-telephone-fill"></i> Contact</a>
    </div>
    <main class="container">