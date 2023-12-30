<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
if (isset($_POST['btn-send'])) {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'your_username@example.com'; // Replace with your SMTP username
    $mail->Password = 'your_password'; // Replace with your SMTP password
    $mail->Port = 25; // Adjust the port if necessary (587 is usually used for TLS)
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `ssl` also accepted

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        header('location:home.php?error');
    } else {
        $headers = "From: $name <$email>\r\n";

        $to = "navanathnaik5126@gmail.com";

        if (mail($to, $subject, $email, $headers)) {
            header("location.home.php?success");
        }
    }
} else {
    header("location:home.php?");
}
// <?php
//         $message="";
//         if(isset($_GET['error']))
//         {
//           $message="Please Fill in the Blanks";
//           echo'<div class="alert alert-danger">'.$message.'</div>';
//         }

//         if(isset($_GET['success']))
//         {
//           $message="Your Message has been sent";
//           echo'<div class="alert alert-success">'.$message.'</div>';
//         }
        
// ?>