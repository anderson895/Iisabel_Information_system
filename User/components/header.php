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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    
</head>




<div class="alert"></div>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 ">
  



  
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ISABELAPP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-success" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">
                    <?php if ($isLogin): ?>
                        <a class="navbar-brand text-center" href="#">
                            <i class="fas fa-user"></i> <?= ucfirst($user['NAME']); ?>
                        </a>
                    <?php else: ?>
                        ISABELAPP
                    <?php endif; ?>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <?php if ($isLogin): ?>
                        <div class="navs-a-container">
                            <a href="../process/logout.php" class="btn btn-dark"><i class="bi bi-box-arrow-left"></i> Logout</a>
                        </div>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="tourist-login.php">Tourist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../SMEs">SMEs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Admin">Admin</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Button for toggling the offcanvas menu on smaller screens -->
<button class="btn btn-success d-md-none mt-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNav" aria-controls="sideNav" aria-expanded="false" aria-label="Toggle navigation">
    Menu
</button>

<!-- Offcanvas menu for mobile view -->
<div class="offcanvas offcanvas-start bg-success text-light" id="sideNav" tabindex="-1" aria-labelledby="sideNavLabel">
    <div class="offcanvas-header">
        <h5 id="sideNavLabel" class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <a href="index.php?page=news" id="nav-news" class="d-block mb-2 text-decoration-none <?= (isset($_GET['page']) && $_GET['page'] == 'news') ? 'side-nav-active' : '' ?> text-light hover-effect">
            <i class="bi bi-newspaper"></i> News Update
        </a>
        <a href="index.php?page=accommodation" id="nav-accom" class="d-block mb-2 text-decoration-none <?= (isset($_GET['page']) && $_GET['page'] == 'accommodation') ? 'side-nav-active' : '' ?> text-light hover-effect">
            <i class="bi bi-building"></i> Accommodation
        </a>
        <a href="index.php?page=products" id="nav-products" class="d-block mb-2 text-decoration-none <?= (isset($_GET['page']) && $_GET['page'] == 'products') ? 'side-nav-active' : '' ?> text-light hover-effect">
            <i class="bi bi-shop"></i> SMEs
        </a>
        <a href="index.php?page=tourist_spot" id="nav-ts" class="d-block mb-2 text-decoration-none <?= (isset($_GET['page']) && $_GET['page'] == 'tourist_spot') ? 'side-nav-active' : '' ?> text-light hover-effect">
            <i class="bi bi-card-image"></i> Tourist Spot
        </a>
        <a href="index.php?page=restaurant" id="nav-resto" class="d-block mb-2 text-decoration-none <?= (isset($_GET['page']) && $_GET['page'] == 'restaurant') ? 'side-nav-active' : '' ?> text-light hover-effect">
            <i class="bi bi-egg-fried"></i> Restaurant
        </a>
        <a href="index.php?page=hotline" id="nav-contact" class="d-block mb-2 text-decoration-none <?= (isset($_GET['page']) && $_GET['page'] == 'hotline') ? 'side-nav-active' : '' ?> text-light hover-effect">
            <i class="bi bi-telephone-fill"></i> Emergency Hotline
        </a>
    </div>
</div>

<!-- Add this to your CSS file or <style> tag -->
<style>
    .hover-effect:hover {
        background-color: rgba(255, 255, 255, 0.2); /* Change background on hover */
        color: #ffffff; /* Change text color on hover */
    }
    .side-nav-active {
        font-weight: bold;
    }
</style>


<!-- Sidebar for larger screens -->
<div class="side-nav bg-light d-none d-md-block">
        <a href="index.php?page=news" id="nav-news" class="<?= (isset($_GET['page']) && $_GET['page'] == 'news') ? 'side-nav-active' : '' ?>"><i class="bi bi-newspaper"></i> News Update</a>
        <a href="index.php?page=accommodation" id="nav-accom" class="<?= (isset($_GET['page']) && $_GET['page'] == 'accommodation') ? 'side-nav-active' : '' ?>"><i class="bi bi-building"></i> Accommodation</a>
        <a href="index.php?page=products" id="nav-products" class="<?= (isset($_GET['page']) && $_GET['page'] == 'products') ? 'side-nav-active' : '' ?>"><i class="bi bi-shop"></i> SMEs</a>
        <a href="index.php?page=tourist_spot" id="nav-ts" class="<?= (isset($_GET['page']) && $_GET['page'] == 'tourist_spot') ? 'side-nav-active' : '' ?>"><i class="bi bi-card-image"></i> Tourist Spot</a>
        <a href="index.php?page=restaurant" id="nav-resto" class="<?= (isset($_GET['page']) && $_GET['page'] == 'restaurant') ? 'side-nav-active' : '' ?>"><i class="bi bi-egg-fried"></i> Restaurant</a>
        <a href="index.php?page=hotline" id="nav-contact" class="<?= (isset($_GET['page']) && $_GET['page'] == 'hotline') ? 'side-nav-active' : '' ?>"><i class="bi bi-telephone-fill"></i> Emergency Hotline </a>
    </div>









    <main class="container">