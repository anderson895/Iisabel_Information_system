<?php
include('components/header.php');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == 'news') {
        include('page/news.php');
    } elseif ($page == 'accommodation') {
        include('page/accom.php');
    } elseif ($page == 'products') {
        include('page/store.php');
    } elseif ($page == 'tourist_spot') {
        include('page/ts.php');
    } elseif ($page == 'restaurant') {
        include('page/restaurant.php');
    } elseif ($page == 'hotline') {
        include('page/contacts.php');
    } else {
        header('Location: index.php?page=news');
        exit;
    }
} else {
    header('Location: index.php?page=news');
    exit;
}
include('components/footer.php');
