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
                            session_start();
                            if ($_POST['smesType'] == 'accommodation') {
                                $_SESSION['smes_id'] = $user['ACCOM_ID'];
                            } elseif ($_POST['smesType'] == 'seller') {
                                $_SESSION['smes_id'] = $user['SELLER_ID'];
                            } elseif ($_POST['smesType'] == 'restaurant') {
                                $_SESSION['smes_id'] = $user['RESTO_ID'];
                            } else {
                                $_SESSION['smes_id'] = '404';
                            }
                            $_SESSION['smes_type'] = $_POST['smesType'];
                            echo 200;
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
            }

            echo $signup;
        } elseif ($_POST['SubmitType'] == 'TouristSignup') {
            $touristId = 'TOURIST-' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $checkTouristId = $db->getTouristUsingId($touristId);
            while ($checkTouristId->num_rows > 0) {
                $touristId = 'TOURIST-' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $checkTouristId = $db->getTouristUsingId($$touristId);
            }

            $signup = $db->touristSignUp($touristId, $_POST['name'], $_POST['username'], $_POST['password']);
            if ($signup == 200) {
                session_start();
                $_SESSION['user_id'] = $touristId;
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
            echo $db->deleteProduct($_POST['id'], $_POST['img']);
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
        } elseif ($_POST['SubmitType'] == 'Rate') {
            session_start();
            echo $db->rate($_POST, $_SESSION['user_id']);
        }
    }
}
