<?php
session_start();
// error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$ch = filter_input(INPUT_POST, 'ch', FILTER_SANITIZE_STRING);

switch ($ch) {
    case 'send_otp':
        // Get mobile number from POST data
        $num = filter_input(INPUT_POST, 'mob', FILTER_SANITIZE_STRING);

        // Generate a random OTP (One Time Password)
        $otp = rand(10000, 999999);

        // Store OTP in session for verification
        $_SESSION['otp'] = $otp;

        // Initialize cURL session
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://2factor.in/API/V1/e3cf3b56-97f8-11ee-8cbb-0200cd936042/SMS/".$num."/".$otp."",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        // Execute cURL request
        $response = curl_exec($curl);
        $err = curl_error($curl);

        // Close cURL session
        curl_close($curl);

        // Check for cURL errors
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo 'success';
        }

        break;

    case 'verify_otp':
        // Get user-entered OTP from POST data
        $user_otp = filter_input(INPUT_POST, 'otp', FILTER_SANITIZE_STRING);

        // Retrieve stored OTP from session
        $verify_otp = $_SESSION['otp'];

        // Compare user-entered OTP with stored OTP
        if ($verify_otp == $user_otp) {
            header("Location:dashboard.php");
        }
        break;

    default:
        // Handle other cases or leave empty if not needed.
        break;
}
?>