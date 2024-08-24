<?php




require_once 'vendor/autoload.php';
require_once 'backend/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();


// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

    $user_id = $_SESSION['target_user_for_otp'];

   
    $db = new db_connect();
    $conn = $db->connect();
    
    if (!$conn) {
       die('Failed to connect to database: ' . $db->error);
    } else {
    //    echo 'Connected to database successfully.';
       
    }
    
    

    $email = $otp = '';
    $stmt = $conn->prepare("SELECT EMAIL, OTP FROM tourist WHERE USER_ID = ?");
    $stmt->bind_param("s", $user_id);

    if ($stmt->execute()) {
        $stmt->bind_result($email, $otp);
        $stmt->fetch();
        $stmt->close();

        if (!$email) {
            http_response_code(404);
            exit;
        }

        try {
            $mail = new PHPMailer(true);

            // SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'dummydummy1stapador@gmail.com'; // SMTP username
            $mail->Password   = 'gshabvilydndzpux';             // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    // Enable implicit TLS encryption
            $mail->Port       = 465;                            // TCP port to connect to
        
            

            // Sender and recipient details
            $mail->setFrom('isabelapp@example.com', 'ISABELAPP');
            $mail->addAddress($email); // Recipient
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'OTP for verification';
            $mail->Body = 'This is Your OTP Code <b>' . $otp.'</b> FROM ISABELAPP';

            // Send email
            if (!$mail->send()) {
                throw new Exception('Mailer Error: ' . $mail->ErrorInfo);
            }

            http_response_code(200);
            exit;
        } catch (Exception $e) {
          
            echo 'Message could not be sent. Mailer Error: ' . $e->getMessage();
            exit;
        }
    } else {
        http_response_code(500); // Use 500 for database query error
        echo 'Error executing query: ' . $conn->error;
        exit;
    }
} else {
  
    echo 'Invalid request method';
    exit;
}
?>
