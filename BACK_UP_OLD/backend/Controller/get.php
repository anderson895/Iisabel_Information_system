<?php
include('../class.php');
$db = new global_class();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['SubmitType'])) {
        if ($_GET['SubmitType'] == 'GetNewsImages' || $_GET['SubmitType'] == 'GetSpotsImages') {
            $getImages = $db->getSMEsImages($_GET['id']);
            $data = [];
            while ($img = $getImages->fetch_assoc()) {
                $images = [
                    "id" => $img['ID'],
                    "smes_id" => $img['SMES_ID'],
                    "file_name" => $img['FILE_NAME']
                ];

                $data[] = $images;
            }

            echo json_encode($data);
        } elseif ($_GET['SubmitType'] == 'GetProducts') {
            $getProducts = $db->getProducts($_GET['id']);
            $data = [];
            while ($product = $getProducts->fetch_assoc()) {
                $pro = [
                    "id" => $product['PRODUCT_ID'],
                    "seller_id" => $product['SELLER_ID'],
                    "product_name" => $product['PRODUCT_NAME'],
                    "img" => $product['PRODUCT_IMG']
                ];
                $data[] = $pro;
            }

            echo json_encode($data);
        } elseif ($_GET['SubmitType'] == 'GetDashboard') {
            $date = $_GET['date'];
            $getSiteVisits = $db->getSiteVisits($date);
            $data = [];

            while ($visit = $getSiteVisits->fetch_assoc()) {
                $visits = [
                    'date' => $visit['DATE'],
                    'time' => $visit['visit_hour'],
                    'total_visit' => $visit['total_visits']
                ];

                $data[] = $visits;
            }

            echo json_encode($data);
        }
    }
}
