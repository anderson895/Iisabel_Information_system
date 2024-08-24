<?php
// Include your database connection file
include "backend/db.php";

// Start session
session_start();

// Output JSON format
header('Content-Type: application/json');

// Verify request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the OTP entered by the user
    if (isset($_POST['otp'])) {
        $otpEntered = $_POST['otp'];

        // Validate the OTP (You would typically fetch this OTP from a database or session)
        if (isset($_SESSION['target_user_for_otp'])) {
            $user_id = $_SESSION['target_user_for_otp'];

            // Fetch stored OTP from the database
            $db = new db_connect();
            $conn = $db->connect();

            if ($conn) {
                $storedOTP = fetchOTPFromDatabase($conn, $user_id);

                if ($storedOTP !== false && $otpEntered === $storedOTP) {
                    // Successful OTP verification
                    if (updateStatus($conn, $user_id)) {
                        // Status updated successfully
                        echo json_encode(array('status' => 'success'));
                    } else {
                        echo json_encode(array('status' => 'error', 'message' => 'Error updating status'));
                    }
                } else {
                    // Invalid OTP
                    echo json_encode(array('status' => 'error', 'message' => 'Invalid OTP'));
                }
            } else {
                // Database connection failed
                echo json_encode(array('status' => 'error', 'message' => 'Database connection failed'));
            }
        } else {
            // OTP not found in session
            echo json_encode(array('status' => 'error', 'message' => 'OTP not found in session'));
        }
    } else {
        // OTP not provided
        echo json_encode(array('status' => 'error', 'message' => 'OTP not provided'));
    }
} else {
    // Invalid request method
    echo json_encode(array('status' => 'error', 'message' => 'Method Not Allowed'));
}

// Function to fetch OTP from database
function fetchOTPFromDatabase($conn, $user_id) {
    $sql = "SELECT OTP FROM tourist WHERE USER_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->bind_result($storedOTP);
    $stmt->fetch();
    $stmt->close();
    return $storedOTP;
}

// Function to update status in database
function updateStatus($conn, $user_id) {
    $sql = "UPDATE tourist SET STATUS = 1, OTP=null WHERE USER_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    if ($stmt->execute()) {
        // Status updated successfully

     
        $_SESSION['user_id'] = $user_id;

        return true;
    } else {
        // Error updating status
        return false;
    }
}
?>
