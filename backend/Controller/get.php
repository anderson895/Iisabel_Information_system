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
                    "img" => $product['PRODUCT_IMG'],
                     "publish" => $product['DATE_PUBLISH']
                ];
                $data[] = $pro;
            }

            echo json_encode($data);
        } elseif ($_GET['SubmitType'] == 'GetDashboard') {
            $date = $_GET['date'];
        
            // Convert string to DateTime object
            $dateObject = new DateTime($date);
            // Get the month as a numeric value (1 to 12)
            $monthNumeric = $dateObject->format('n');
            // Optional: Get the month as a string (January to December)
            $monthString = $dateObject->format('F');
        
            $getSiteVisits = $db->getSiteVisits($date);
            $getSiteVisitsPermonthAllDay = $db->getSiteVisitsPermonthAllDay($monthNumeric);
            $data = [];
            $dataPermonth = [];
        
            while ($visit = $getSiteVisits->fetch_assoc()) {
                $visits = [
                    'date' => $visit['DATE'],
                    'time' => $visit['visit_hour'],
                    'total_visit' => $visit['total_visits']
                ];
        
                $data[] = $visits;
            }
        
            while ($visitPerMonth = $getSiteVisitsPermonthAllDay->fetch_assoc()) {
                $visitPerMonthData = [
                    'date' => $visitPerMonth['DATE'],
                    'day_of_month' => $visitPerMonth['day_of_month'],
                    'total_visitsPerDay' => $visitPerMonth['total_visits']
                ];
        
                $dataPermonth[] = $visitPerMonthData;
            }
        
            echo json_encode(['data' => $data, 'dataPermonth' => $dataPermonth]);

        }
        
    }
}
