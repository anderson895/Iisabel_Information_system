<?php
include('../../../backend/class.php');
$db = new global_class();
session_start();
if (isset($_SESSION['smes_type'], $_SESSION['smes_id']) && $_SESSION['smes_type'] == 'seller') {
    $checkUserId = $db->checkSmesId($_SESSION['smes_type'], $_SESSION['smes_id']);
    if ($checkUserId->num_rows > 0) {
        $seller = $checkUserId->fetch_assoc();
    } else {
        header("Location: ../../index.php");
        exit;
    }
} else {
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMEs | Seller</title>
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../global/css/styles.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="../../../assets/system-img/logo.png" type="image/x-icon">
</head>

<alert class="alert"></alert>

<body class="">