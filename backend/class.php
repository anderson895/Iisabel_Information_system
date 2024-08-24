<?php
include('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function login($table, $username)
    {
        if ($_POST['UserType'] == "Tourist") {
            // Handle non-tourist logic
            $query = $this->conn->prepare("SELECT * FROM `$table` WHERE `USERNAME` = ? AND `STATUS` = '1'");
            $query->bind_param("s", $username);
            
            if ($query->execute()) {
                $result = $query->get_result();
                


                // Update last visit timestamp
                $date_today = date('Y-m-d H:i:s'); // No need for strtotime('now Asia/Manila') if your server timezone is already set correctly
                $update_query = $this->conn->prepare("UPDATE `$table` SET `LAST_VISIT` = ? WHERE `USERNAME` = ?");
                $update_query->bind_param("ss", $date_today, $username);
                
                $update_query->execute();
                 


                if ($result->num_rows > 0) {
                    return $result; 

                } else {
                    // No rows found
                    return false;
                }
            } else {
                // Query execution failed
                return false;
            }
            
        
        } else {
                // Handle non-tourist logic
                $query = $this->conn->prepare("SELECT * FROM `$table` WHERE `USERNAME` = ? AND `STATUS` = '1'");
                $query->bind_param("s", $username);
        
                if ($query->execute()) {
                    $result = $query->get_result();
                    if ($result->num_rows > 0) {
                        return $result; 
                    } else {
                    
                        return false;
                    }
                } else {
                    
                    return false;
                }
        }
    }
    


    public function FetchTotalUser()
    {
        $query = $this->conn->prepare("SELECT
             'Total' AS `Table`,
                    SUM(`Count`) AS `TotalCount`
                FROM
                    (
                        SELECT
                'accommodation' AS `Table`,
                COUNT(*) AS `Count`
            FROM
                `accommodation`
            WHERE
                `STATUS` = 1
    
            UNION
    
            
    
            SELECT
                'restaurant' AS `Table`,
                COUNT(*) AS `Count`
            FROM
                `restaurant`
            WHERE
                `STATUS` = 1
    
            UNION
    
            SELECT
                'seller' AS `Table`,
                COUNT(*) AS `Count`
            FROM
                `seller`
            WHERE
                `STATUS` = 1
            UNION
    
            SELECT
                'tourist' AS `Table`,
                COUNT(*) AS `Count`
            FROM
                `tourist`
            WHERE
                `STATUS` = 1
        ) AS `subquery`
    ");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function FetchAccomodation()
    {
        $query = $this->conn->prepare("SELECT COUNT(*) as total FROM accommodation WHERE STATUS='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function FetchSeller()
    {
        $query = $this->conn->prepare("SELECT COUNT(*) as total FROM seller WHERE STATUS='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function FetchRestaurant()
    {
        $query = $this->conn->prepare("SELECT COUNT(*) as total FROM restaurant WHERE STATUS='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function Fetchtourist()
    {
        $query = $this->conn->prepare("SELECT COUNT(*) as total FROM tourist WHERE STATUS='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function checkUserId($table, $id)
    {
        $query = $this->conn->prepare("SELECT * FROM `$table` WHERE `ID` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function changeSMEsStatus($table, $id, $newStatus)
    {
        if ($table == 'accommodation') {
            $query = $this->conn->prepare("UPDATE `accommodation` SET `STATUS`='$newStatus',jDeactReason='' WHERE `ACCOM_ID` = '$id'");
        } elseif ($table == 'seller') {
            $query = $this->conn->prepare("UPDATE `seller` SET `STATUS`='$newStatus',jDeactReason='' WHERE `SELLER_ID` = '$id'");
        } elseif ($table == 'restaurant') {
            $query = $this->conn->prepare("UPDATE `restaurant` SET `STATUS`='$newStatus',jDeactReason='' WHERE `RESTO_ID` = '$id'");
        } else {
            return $table;
        }

        if ($query->execute()) {
            return 200;
        }
    }


    public function changeSMEsStatusDeactivate($table, $id, $newStatus,$reasonInputted)
    {
        if ($table == 'accommodation') {
            $query = $this->conn->prepare("UPDATE `accommodation` SET `STATUS`='$newStatus',jDeactReason='$reasonInputted' WHERE `ACCOM_ID` = '$id'");
        } elseif ($table == 'seller') {
            $query = $this->conn->prepare("UPDATE `seller` SET `STATUS`='$newStatus',jDeactReason='$reasonInputted' WHERE `SELLER_ID` = '$id'");
        } elseif ($table == 'restaurant') {
            $query = $this->conn->prepare("UPDATE `restaurant` SET `STATUS`='$newStatus',jDeactReason='$reasonInputted' WHERE `RESTO_ID` = '$id'");
        } else {
            return $table;
        }

        if ($query->execute()) {
            return 200;
        }
    }

    public function checkSmesId($smesType, $id)
    {
        if ($smesType == 'accommodation') {
            $query = $this->conn->prepare("SELECT * FROM `accommodation` WHERE `ACCOM_ID` = '$id'");
        } elseif ($smesType == 'seller') {
            $query = $this->conn->prepare("SELECT * FROM `seller` WHERE `SELLER_ID` = '$id'");
        } elseif ($smesType == 'restaurant') {
            $query = $this->conn->prepare("SELECT * FROM `restaurant` WHERE `RESTO_ID` = '$id'");
        } else {
            return $smesType;
        }

        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function SMEsSignup($smesId, $table, $name, $address, $username, $password)
    {
        $checkUsername = $this->conn->prepare("SELECT * FROM `$table` WHERE `USERNAME` = '$username'");
        if ($checkUsername->execute()) {
            $usernameCheck = $checkUsername->get_result();
            if ($usernameCheck->num_rows > 0) {
                return 'Username is already existing!';
            }
        } else {
            return 400;
        }

        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

        if ($table == 'accommodation') {
            $sql = "INSERT INTO `accommodation`(`ACCOM_ID`, `USERNAME`, `PASSWORD`, `ACCOM_NAME`, `ADDRESS`, `STATUS`) VALUES ('$smesId', '$username', '$passwordHashed', '$name', '$address', '2')";
        } elseif ($table == 'seller') {
            $sql = "INSERT INTO `seller`(`SELLER_ID`, `USERNAME`, `PASSWORD`, `STORE_NAME`, `ADDRESS`, `STATUS`) VALUES ('$smesId', '$username', '$passwordHashed', '$name', '$address', '2')";
        } elseif ($table == 'restaurant') {
            $sql = "INSERT INTO `restaurant`(`RESTO_ID`, `USERNAME`, `PASSWORD`, `RESTO_NAME`, `ADDRESS`, `STATUS`) VALUES ('$smesId', '$username', '$passwordHashed', '$name', '$address', '2')";
        } else {
            return 400;
        }

        $query = $this->conn->prepare($sql);
        if ($query->execute()) {
            return 200;
        }
    }

    public function getSMEsImages($id)
    {
        $query = $this->conn->prepare("SELECT * FROM `smes_img` WHERE `SMES_ID` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function checkSMEsImgFileName($name)
    {
        $query = $this->conn->prepare("SELECT * FROM `smes_img` WHERE `FILE_NAME` = '$name'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function uploadSMEsImage($id, $file)
    {
        $fileName = 'SMESIMG-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $checkFileName = $this->checkSMEsImgFileName($fileName);
        while ($checkFileName->num_rows > 0) {
            $fileName = 'SMESIMG-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $checkFileName = $this->checkSMEsImgFileName($fileName);
        }

        if (!empty($_FILES['accomImage']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $newFileName = $fileName .'.'.$extension;
            $destinationDirectory = __DIR__ . '/SMEsImg/';
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    $query = $this->conn->prepare("INSERT INTO `smes_img`(`SMES_ID`, `FILE_NAME`) VALUES ('$id','$newFileName')");
                    // if ($query->execute()) {
                    //     return 200;
                    // }

                    if ($query->execute()) {

                        session_start();
                        $log_username = $_SESSION['USERNAME'];
                                        // Use date with timezone
                        $dateToday = new DateTime("now", new DateTimeZone('Asia/Manila'));
                        $formattedDate = $dateToday->format('Y-m-d H:i:s');

                        
                
                        // Log the activity
                        
                        $activityDescription = "Added new photos ".$newFileName;
            
                
                        $query_activity_log = $this->conn->prepare("INSERT INTO `activitylog` (`log_username`, `activity_description`, `date_added`) VALUES (?, ?, ?)");
                        $query_activity_log->bind_param('sss', $log_username, $activityDescription, $formattedDate);
                        $query_activity_log->execute();
                
                        return 200;
                    }
                } else {
                    return $destination; 
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }

    public function deleteSMEsImage($id, $fileName)
    {
        $fileToDelete = __DIR__ . '/SMEsImg/' . $fileName;
        $query = $this->conn->prepare("DELETE FROM `smes_img` WHERE `ID` = '$id'");
        if (file_exists($fileToDelete)) {
            if (unlink($fileToDelete) && $query->execute()) {

                   // Use date with timezone
                   $dateToday = new DateTime("now", new DateTimeZone('Asia/Manila'));
                   $formattedDate = $dateToday->format('Y-m-d H:i:s');
                   
                    // Log the activity
                   session_start();
                   $log_username = $_SESSION['USERNAME'];
                   $activityDescription = "Delete photo " . $fileName;
   
                   $query_activity_log = $this->conn->prepare("INSERT INTO `activitylog` (`log_username`, `activity_description`, `date_added`) VALUES (?, ?, ?)");
                   if (!$query_activity_log) {
                       die("Prepare failed: " . $this->conn->error);
                   }
   
                   $query_activity_log->bind_param('sss', $log_username, $activityDescription, $formattedDate);
                   if (!$query_activity_log->execute()) {
                       die("Execute failed: " . $query_activity_log->error);
                   }
   

                return 200;
            } else {
                echo "Error deleting the file.";
            }
        } else {
            echo "File does not exist.";
        }
    }


    public function deleteRevs($id)
    {
      
        $query = $this->conn->prepare("DELETE FROM `smes_rate_reviews` WHERE `ID` = '$id'");
        if ($query->execute()) {
            echo "success";
        }else{
            echo "errorsssss";
        }
    }


    // Accommodation
    public function editAccomDetails($post)
    {
        $id = $post['accomId'];
        $name = $post['accomName'];
        $description = $post['accomDescription'];
        $address = $post['accomAddress'];
        $map = $post['accomMap'];
        $email = $post['accomEmail'];
        $contactNo = $post['accomContactNo'];
        $fb = $post['accomFB'];
        $ig = $post['accomIG'];

        $query = $this->conn->prepare("UPDATE `accommodation` SET `ACCOM_NAME`='$name',`ADDRESS`='$address',`MAP`='$map',`DESCRIPTION`='$description',`EMAIL`='$email',`CONTACT_NO`='$contactNo',`FACEBOOK_LINK`='$fb',`INSTAGRAM_LINK`='$ig',`STATUS`='1' WHERE `ACCOM_ID` = '$id'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function getAccommodations()
    {
        $query = $this->conn->prepare("SELECT * FROM `accommodation`");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function getActivityLogs()
    {
        $query = $this->conn->prepare("SELECT * FROM `activitylog`");
        
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    // Resto
    public function editRestoDetails($post)
    {
        $id = $post['restoId'];
        $name = $post['restoName'];
        $description = $post['restoDescription'];
        $address = $post['restoAddress'];
        $map = $post['restoMap'];
        $email = $post['restoEmail'];
        $contactNo = $post['restoContactNo'];
        $fb = $post['restoFB'];
        $ig = $post['restoIG'];

        $query = $this->conn->prepare("UPDATE `restaurant` SET `RESTO_NAME`='$name',`ADDRESS`='$address',`MAP`='$map',`DESCRIPTION`='$description',`EMAIL`='$email',`CONTACT_NO`='$contactNo',`FACEBOOK_LINK`='$fb',`INSTAGRAM_LINK`='$ig',`STATUS`='1' WHERE `RESTO_ID` = '$id'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function getResto()
    {
        $query = $this->conn->prepare("SELECT * FROM `restaurant`");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    // Seller
    public function editSellerDetails($post)
    {
        $id = $post['sellerId'];
        $name = $post['sellerName'];
        $address = $post['sellerAddress'];
        $map = $post['sellerMap'];
        $email = $post['sellerEmail'];
        $contactNo = $post['sellerContactNo'];
        $fb = $post['sellerFB'];
        $ig = $post['sellerIG'];

        $query = $this->conn->prepare("UPDATE `seller` SET `STORE_NAME`='$name',`ADDRESS`='$address',`MAP`='$map',`EMAIL`='$email',`CONTACT_NO`='$contactNo',`FACEBOOK_LINK`='$fb',`INSTAGRAM_LINK`='$ig',`STATUS`='1' WHERE `SELLER_ID` = '$id'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function getProducts($sellerId)
    {
        $query = $this->conn->prepare("SELECT * FROM `products` WHERE `SELLER_ID` = '$sellerId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getProducById($productId)
    {
        $query = $this->conn->prepare("SELECT * FROM `products` WHERE `PRODUCT_ID` = '$productId'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addNewProduct($id, $name, $file)
    {
        $productId = 'PRO-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $checkProductId = $this->getProducById($productId);
        while ($checkProductId->num_rows > 0) {
            $productId = 'PRO-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $checkProductId = $this->getProducById($productId);
        }
    
        if (!empty($_FILES['productImage']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/products-img/';
            $newFileName = $productId . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    // Set timezone to Asia/Manila
                    date_default_timezone_set('Asia/Manila');
                    date_default_timezone_set('Asia/Manila');
                    $dateToday = date('Y-m-d H:i:s');
                    
                    // Prepare SQL query with prepared statement
                    $query = $this->conn->prepare("INSERT INTO `products`(`PRODUCT_ID`, `SELLER_ID`, `PRODUCT_NAME`, `PRODUCT_IMG`, `STATUS`, `DATE_PUBLISH`) VALUES (?, ?, ?, ?, '1', ?)");
                    if (!$query) {
                        die("Prepare failed: " . $this->conn->error); // Check for prepare errors
                    }
                    
                    $query->bind_param("sssss", $productId, $id, $name, $newFileName, $dateToday);
                    
                    if (!$query->execute()) {
                        die("Execute failed: " . $query->error); // Check for execution errors
                    }
                    
                  
                    session_start();
                    $log_username = $_SESSION['USERNAME'];
                    // Log the activity
                    $activityDescription = "Added new product " . $name;
                    
                    $query_activity_log = $this->conn->prepare("INSERT INTO `activitylog` (`log_username`, `activity_description`, `date_added`) VALUES (?, ?, ?)");
                    if (!$query_activity_log) {
                        die("Prepare failed: " . $this->conn->error); // Check for prepare errors
                    }
                    
                    $query_activity_log->bind_param('sss', $log_username, $activityDescription, $dateToday);
                    if (!$query_activity_log->execute()) {
                        die("Execute failed: " . $query_activity_log->error); // Check for execution errors
                    }
                    
                    // Return the inserted PRODUCT_ID
                    return 200;
                    

                } else {
                    return "Error moving uploaded file to destination.";
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }
    

    public function deleteProduct($id, $img,$name)
    {
        $fileToDelete = __DIR__ . '/products-img/' . $img;
        $query = $this->conn->prepare("DELETE FROM `products` WHERE `PRODUCT_ID` = '$id'");
        if (file_exists($fileToDelete)) {
            if (unlink($fileToDelete) && $query->execute()) {


                 // Use date with timezone
                $dateToday = new DateTime("now", new DateTimeZone('Asia/Manila'));
                $formattedDate = $dateToday->format('Y-m-d H:i:s');
                
                 // Log the activity
                session_start();
                $log_username = $_SESSION['USERNAME'];
                $activityDescription = "Delete product " . $name;

                $query_activity_log = $this->conn->prepare("INSERT INTO `activitylog` (`log_username`, `activity_description`, `date_added`) VALUES (?, ?, ?)");
                if (!$query_activity_log) {
                    die("Prepare failed: " . $this->conn->error);
                }

                $query_activity_log->bind_param('sss', $log_username, $activityDescription, $formattedDate);
                if (!$query_activity_log->execute()) {
                    die("Execute failed: " . $query_activity_log->error);
                }

                return 200;
            } else {
                echo "Error deleting the file.";
            }
        } else {
            echo "File does not exist.";
            echo $fileToDelete;
        }
    }

    public function getSellers()
    {
        $query = $this->conn->prepare("SELECT * FROM `seller`");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    // Contact
    public function getHotlines()
    {
        $query = $this->conn->prepare("SELECT * FROM `hotline`");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addNewContact($name, $number)
    {
        $query = $this->conn->prepare("INSERT INTO `hotline`(`HOTLINE_NAME`, `NUMBER`) VALUES ('$name', '$number')");

        if ($query->execute()) {
            return 200;
        }
    }

    public function deleteContact($id)
    {
        $query = $this->conn->prepare("DELETE FROM `hotline` WHERE `HOTLINE_ID` = '$id'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function editContact($id, $name, $number)
    {
        $query = $this->conn->prepare("UPDATE `hotline` SET `HOTLINE_NAME`='$name',`NUMBER`='$number' WHERE `HOTLINE_ID` = '$id'");
        if ($query->execute()) {
            return 200;
        }
    }

    // News
    public function getNews()
    {
        $query = $this->conn->prepare("SELECT * FROM `news`");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getNewsUsingId($id)
    {
        $query = $this->conn->prepare("SELECT * FROM `news` WHERE `NEWS_ID` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function deleteNews($id)
    {
        $query = $this->conn->prepare("DELETE FROM `news` WHERE `NEWS_ID` = '$id'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function addNews($post)
    {
        $newsId = 'NEWS-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $checkNews = $this->getNewsUsingId($newsId);
        while ($checkNews->num_rows > 0) {
            $newsId = 'NEWS-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $checkNews = $this->getNewsUsingId($newsId);
        }

        $date = new DateTime("now", new DateTimeZone('Asia/Manila'));
        $DATE_PUBLISH = $date->format('Y-m-d H:i:s');

        $query = $this->conn->prepare("INSERT INTO `news`(`NEWS_ID`, `EVENT_NAME`, `ADDRESS`, `MAP`, `DESCRIPTION`, `DATE`, `TIME`, `STATUS`,`DATE_PUBLISH`) VALUES ('$newsId','" . $post['newsName'] . "','" . $post['newsAddress'] . "','" . $post['newsMap'] . "','" . $post['newsDescription'] . "','" . $post['newsDate'] . "','" . $post['newsTime'] . "','1','$DATE_PUBLISH')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function editNews($post)
    {
        $query = $this->conn->prepare("UPDATE `news` SET `EVENT_NAME`='" . $post['EditNewsName'] . "',`ADDRESS`='" . $post['EditNewsAddress'] . "',`MAP`='" . $post['EditNewsMap'] . "',`DESCRIPTION`='" . $post['EditNewsDescription'] . "',`DATE`='" . $post['EditNewsDate'] . "',`TIME`='" . $post['EditNewsTime'] . "' WHERE `NEWS_ID` = '" . $post['newsId'] . "'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function uploadNewsImage($id, $file)
    {
        $fileName = 'SMESIMG-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $checkFileName = $this->checkSMEsImgFileName($fileName);
        while ($checkFileName->num_rows > 0) {
            $fileName = 'SMESIMG-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $checkFileName = $this->checkSMEsImgFileName($fileName);
        }

        if (!empty($_FILES['newsImg']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/SMEsImg/';
            $newFileName = $fileName . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    $query = $this->conn->prepare("INSERT INTO `smes_img`(`SMES_ID`, `FILE_NAME`) VALUES ('$id','$newFileName')");
                    if ($query->execute()) {
                        return 200;
                    }
                } else {
                    return $destination;
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }

    // Tourist Spot
    public function getTouristSpot()
    {
        $query = $this->conn->prepare("SELECT * FROM `tourist_spot`");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getTouristSpotById($id)
    {
        $query = $this->conn->prepare("SELECT * FROM `tourist_spot` WHERE `SPOT_ID` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addNewSpot($post)
    {
        $spotId = 'SPOT-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $checkSpot = $this->getTouristSpotById($spotId);
        while ($checkSpot->num_rows > 0) {
            $spotId = 'SPOT-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $checkSpot = $this->getTouristSpotById($spotId);
        }

        $query = $this->conn->prepare("INSERT INTO `tourist_spot`(`SPOT_ID`, `SPOT_NAME`, `SPOT_TYPE`, `DESCRIPTION`, `ADDRESS`, `MAP`, `FEE`, `STATUS`) VALUES ('$spotId','" . $post['spotName'] . "','" . $post['spotType'] . "','" . $post['spotDescription'] . "','" . $post['spotAddress'] . "','" . $post['spotMap'] . "','" . $post['spotFee'] . "','1')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function editSpot($post)
    {
        $query = $this->conn->prepare("UPDATE `tourist_spot` SET `SPOT_NAME`='" . $post['spotEditName'] . "',`SPOT_TYPE`='" . $post['spotEditType'] . "',`DESCRIPTION`='" . $post['spotEditDescription'] . "',`ADDRESS`='" . $post['spotEditAddress'] . "',`MAP`='" . $post['spotEditMap'] . "',`FEE`='" . $post['spotEditFee'] . "',`STATUS`='1' WHERE `SPOT_ID` = '" . $post['id'] . "'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function uploadSpotImage($id, $file)
    {
        $fileName = 'SMESIMG-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
        $checkFileName = $this->checkSMEsImgFileName($fileName);
        while ($checkFileName->num_rows > 0) {
            $fileName = 'SMESIMG-' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $checkFileName = $this->checkSMEsImgFileName($fileName);
        }

        if (!empty($_FILES['spotImg']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/SMEsImg/';
            $newFileName = $fileName . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    $query = $this->conn->prepare("INSERT INTO `smes_img`(`SMES_ID`, `FILE_NAME`) VALUES ('$id','$newFileName')");
                    if ($query->execute()) {
                        return 200;
                    }
                } else {
                    return $destination;
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }

    public function deleteSpot($id)
    {
        $query = $this->conn->prepare("DELETE FROM `tourist_spot` WHERE `SPOT_ID` = '$id'");
        if ($query->execute()) {
            return 200;
        }
    }


    // Users / Tourist
    public function getTourist()
    {
        $query = $this->conn->prepare("SELECT * FROM `tourist` ORDER BY `SORT_ID` ASC");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getAllReviewsInAccom($id)
    {
        
        $query = $this->conn->prepare("SELECT srr.RATE,srr.REVIEW,t.NAME 
        FROM smes_rate_reviews as srr
        LEFT JOIN tourist as t
        ON t.USER_ID = srr.USER_ID where srr.SMES_ID='$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getTouristUsingId($id)
    {
        $query = $this->conn->prepare("SELECT * FROM `tourist` WHERE `USER_ID` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function touristSignUp($touristId, $name, $username, $password, $email, $otp, $otp_exp)
    {
        $checkUsername = $this->conn->prepare("SELECT * FROM `tourist` WHERE `USERNAME` = ?");
        $checkUsername->bind_param("s", $username);
        
        if (!$checkUsername->execute()) {
            return 400; // Return an error code if execution fails
        }
        
        $checkUsername->store_result();
        if ($checkUsername->num_rows > 0) {
            $checkUsername->close();
            return 'Username is already existing!';
        }
        $checkUsername->close();
        
        // Check if email already exists
        $checkEmail = $this->conn->prepare("SELECT * FROM `tourist` WHERE `EMAIL` = ?");
        $checkEmail->bind_param("s", $email);
        
        if (!$checkEmail->execute()) {
            return 400; // Return an error code if execution fails
        }
        
        $checkEmail->store_result();
        if ($checkEmail->num_rows > 0) {
            $checkEmail->close();
            return 'Email is already existing!';
        }
        $checkEmail->close();
        
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        
        $insertQuery = $this->conn->prepare("INSERT INTO `tourist`(`USER_ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `NAME`, `STATUS`, `OTP`, `OTP_EXPI`) VALUES (?, ?, ?, ?, ?, '0', ?, ?)");
        $insertQuery->bind_param("sssssss", $touristId, $username, $passwordHashed, $email, $name, $otp, $otp_exp);
        
        if (!$insertQuery->execute()) {
            return 400; // Return an error code if execution fails
        }
        
        $insertQuery->close();
        return 200; // Success
        
    }
    

    // Rate
    public function rate($post, $userId)
    {
        // Use date with timezone
        $dateToday = new DateTime("now", new DateTimeZone('Asia/Manila'));
        $formattedDate = $dateToday->format('Y-m-d H:i:s');
    
        // Prepare and execute the insert query with parameterized statements
        $userIdParam = $userId;
        $smesIdParam = $post['id'];
        $rateParam = $post['star'];
        $reviewParam = $post['review'];
    
        $query = $this->conn->prepare("INSERT INTO `smes_rate_reviews` (`USER_ID`, `SMES_ID`, `RATE`, `REVIEW`) VALUES (?, ?, ?, ?)");
        $query->bind_param('ssss', $userIdParam, $smesIdParam, $rateParam, $reviewParam);
    
        if ($query->execute()) {
            // Use date with timezone
                   $dateToday = new DateTime("now", new DateTimeZone('Asia/Manila'));
                   $formattedDate = $dateToday->format('Y-m-d H:i:s');
                   
                 
                   $log_username = $_SESSION['USERNAME'];
                   $activityDescription = "Gave " . $post['star'] . " Stars" . (isset($post['review']) && !empty($post['review']) ? " and commented on $smesIdParam to " . $post['review'] : "on $smesIdParam");
   
                   $query_activity_log = $this->conn->prepare("INSERT INTO `activitylog` (`log_username`, `activity_description`, `date_added`) VALUES (?, ?, ?)");
                   if (!$query_activity_log) {
                       die("Prepare failed: " . $this->conn->error);
                   }
   
                   $query_activity_log->bind_param('sss', $log_username, $activityDescription, $formattedDate);
                   if (!$query_activity_log->execute()) {
                       die("Execute failed: " . $query_activity_log->error);
                   }
    
            return 200;
        }
    
        // Handle errors if needed
        return 500;
    }
    
    

    public function getRates()
    {
        $query = $this->conn->prepare("SELECT * FROM `smes_rate_reviews`");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    // Site Visits
    public function insertSiteVisit()
    {
        date_default_timezone_set('Asia/Manila');
        $currentDate = date('Y-m-d');
        $currentTime = time();
        $formattedTime = date('H:i:s', $currentTime);
        $query = $this->conn->prepare("INSERT INTO `site_visits`(`DATE`, `TIME`) VALUES ('$currentDate', '$formattedTime')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function getSiteVisits($date)
    {
        $query = $this->conn->prepare("SELECT `DATE` ,HOUR(`TIME`) AS visit_hour, COUNT(*) AS total_visits
                                       FROM `site_visits`
                                       WHERE `DATE` = '$date'
                                       GROUP BY visit_hour;");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }



    public function getSiteVisitsPermonthAllDay($monthNumeric)
    {
        $query = $this->conn->prepare("SELECT `DATE`, DAY(`DATE`) AS day_of_month, COUNT(*) AS total_visits
                                       FROM `site_visits`
                                       WHERE MONTH(`DATE`) = ?
                                       GROUP BY day_of_month");
        $query->bind_param('i', $monthNumeric);
    
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }
}
