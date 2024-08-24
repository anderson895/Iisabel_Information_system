<?php
include('../class.php');
$db = new global_class();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['SubmitType'])) {

       
        
        if ($_POST['SubmitType'] == 'Login') {
            if (isset($_POST['UserType'])) {
                if ($_POST['UserType'] == 'Admin') {
                    $password = $_POST['password'];
                    $loginResult = $db->login('admin', $_POST['username']);
                    if ($loginResult->num_rows > 0) {
                        $user = $loginResult->fetch_assoc();
                        if (password_verify($password, $user['PASSWORD'])) {
                            session_start();
                            $_SESSION['admin_id'] = $user['ID'];
                            $_SESSION['USERNAME'] = $user['USERNAME'];
                            echo 200;
                        } else {
                            echo 'Login Failed';
                        }
                    } else {
                        echo 'Login Failed';
                    }
                } elseif ($_POST['UserType'] == 'SMEs') {
                    $password = $_POST['password'];
                    $loginResult = $db->login($_POST['smesType'], $_POST['username']);
                    if ($loginResult->num_rows > 0) {
                        $user = $loginResult->fetch_assoc();
                        if (password_verify($password, $user['PASSWORD'])) {

                            if($user['STATUS']=='1'){

                                session_start();
                                if ($_POST['smesType'] == 'accommodation') {
                                    $_SESSION['smes_id'] = $user['ACCOM_ID'];
                                    $_SESSION['USERNAME'] = $user['USERNAME'];
                                    $_SESSION['STATUS'] = $user['STATUS'];
                                    
                                } elseif ($_POST['smesType'] == 'seller') {
                                    $_SESSION['smes_id'] = $user['SELLER_ID'];
                                    $_SESSION['USERNAME'] = $user['USERNAME'];
                                } elseif ($_POST['smesType'] == 'restaurant') {
                                    $_SESSION['smes_id'] = $user['RESTO_ID'];
                                    $_SESSION['USERNAME'] = $user['USERNAME'];
                                } else {
                                    $_SESSION['smes_id'] = '404';
                                }
                                $_SESSION['smes_type'] = $_POST['smesType'];
                                echo 200;

                            }else{
                                
                                echo $user['jDeactReason'];
                            }
                          
                        } else {
                            echo 'Login Failed';
                        }
                    } else {
                        echo 'Login Failed';
                    }
                } else {
                    $password = $_POST['password'];
                    $loginResult = $db->login('tourist', $_POST['username']);
                    if ($loginResult->num_rows > 0) {
                        $user = $loginResult->fetch_assoc();
                        if (password_verify($password, $user['PASSWORD'])) {
                            session_start();
                            $_SESSION['user_id'] = $user['USER_ID'];
                            $_SESSION['USERNAME'] = $user['USERNAME'];
                            echo 200;
                        } else {
                            echo 'Login Failed';
                        }
                    } else {
                        echo 'Login Failed';
                    }
                }
            }
        } elseif ($_POST['SubmitType'] == 'SMEsSignUp') {
            $table = $_POST['smesType'];
            $smesId = $table . '-' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $checkSmesId = $db->checkSmesId($table, $smesId);
            while ($checkSmesId->num_rows > 0) {
                $smesId = $table . '-' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $checkSmesId = $db->checkSmesId($table, $smesId);
            }

            $signup = $db->SMEsSignup($smesId, $_POST['smesType'], $_POST['name'], $_POST['address'], $_POST['username'], $_POST['password']);
            if ($signup == 200) {
                session_start();
                $_SESSION['smes_id'] = $smesId;
                $_SESSION['smes_type'] = $_POST['smesType'];
                  $_SESSION['USERNAME'] = $_POST['username'];
            }

            echo $signup;
        } elseif ($_POST['SubmitType'] == 'TouristSignup') {
            
           // Set Manila time zone
            date_default_timezone_set('Asia/Manila');

            // Generate OTP (6-digit number)
            $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

            // Calculate OTP expiration time (5 minutes from now)
            $expiration = new DateTime();
            $expiration->add(new DateInterval('PT5M')); // PT5M means 5 minutes
            $expiration->setTimezone(new DateTimeZone('UTC')); // Convert to UTC for storage

            // Convert expiration time back to Manila time for display (if needed)
            $expiration->setTimezone(new DateTimeZone('Asia/Manila'));
            $otp_expiration = $expiration->format('Y-m-d H:i:s'); // Format as per your database's datetime format

            // Example usage
            $touristId = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $signup = $db->touristSignUp(
                $touristId,
                $_POST['name'],
                $_POST['username'],
                $_POST['password'],
                $_POST['email'],
                $otp,
                $otp_expiration
            );



            if ($signup == 200) {
                session_start();
                $_SESSION['target_user_for_otp'] = $touristId;
                $_SESSION['USERNAME'] = $_POST['username'];
            }

            echo $signup;
        } elseif ($_POST['SubmitType'] == 'EditAccomDetails') {
            echo $db->editAccomDetails($_POST);
        } elseif ($_POST['SubmitType'] == 'EditRestoDetails') {
            echo $db->editRestoDetails($_POST);
        } elseif ($_POST['SubmitType'] == 'EditSellerDetails') {
            echo $db->editSellerDetails($_POST);
        } elseif ($_POST['SubmitType'] == 'SMEsUploadNewImage') {
            echo $db->uploadSMEsImage($_POST['ID'], $_FILES['accomImage']);
        } elseif ($_POST['SubmitType'] == 'DeleteSMEsImage') {
            echo $db->deleteSMEsImage($_POST['id'], $_POST['fileName']);
        } elseif ($_POST['SubmitType'] == 'SMEsAddNewProduct') {
            echo $db->addNewProduct($_POST['ID'], $_POST['productName'], $_FILES['productImage']);
        } elseif ($_POST['SubmitType'] == 'DeleteProduct') {
            echo $db->deleteProduct($_POST['id'], $_POST['img'],$_POST['product_name']);
        } elseif ($_POST['SubmitType'] == 'AddNewContact') {
            echo $db->addNewContact($_POST['contactName'], $_POST['contactNo']);
        } elseif ($_POST['SubmitType'] == 'DeleteContact') {
            echo $db->deleteContact($_POST['id']);
        } elseif ($_POST['SubmitType'] == 'EditContact') {
            echo $db->editContact($_POST['editHotlineId'], $_POST['EditContactName'], $_POST['EditContactNo']);
        } elseif ($_POST['SubmitType'] == 'DeleteNews') {
            echo $db->deleteNews($_POST['id']);
        } elseif ($_POST['SubmitType'] == 'AddNewsUpdate') {
            echo $db->addNews($_POST);
        } elseif ($_POST['SubmitType'] == 'EditNews') {
            echo $db->editNews($_POST);
        } elseif ($_POST['SubmitType'] == 'newsUploadImg') {
            echo $db->uploadNewsImage($_POST['id'], $_FILES['newsImg']);
        } elseif ($_POST['SubmitType'] == 'AddTouristSpot') {
            echo $db->addNewSpot($_POST);
        } elseif ($_POST['SubmitType'] == 'EditTouristSpot') {
            echo $db->editSpot($_POST);
        } elseif ($_POST['SubmitType'] == 'spotUploadImg') {
            echo $db->uploadSpotImage($_POST['id'], $_FILES['spotImg']);
        } elseif ($_POST['SubmitType'] == 'DeleteSpot') {
            echo $db->deleteSpot($_POST['id']);
        } elseif ($_POST['SubmitType'] == 'SMEsChangeStatus') {
            echo $db->changeSMEsStatus($_POST['table'], $_POST['id'], $_POST['newStatus']);
            
        } elseif ($_POST['SubmitType'] == 'SMEsChangeStatusDeactivation') {
            echo $db->changeSMEsStatusDeactivate($_POST['table'], $_POST['id'], $_POST['newStatus'],$_POST['reasonInputted'],);

        } elseif ($_POST['SubmitType'] == 'Rate') {
            session_start();
            echo $db->rate($_POST, $_SESSION['user_id']);
        } elseif ($_POST['SubmitType'] == 'deleteReviews') {

            echo $db->deleteRevs($_POST['id']);
        }
    }
}
