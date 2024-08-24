<?php
include('backend/class.php');
$db = new global_class();
$db->insertSiteVisit();
header('location: landing');
exit;
