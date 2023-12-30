<link rel="stylesheet" type="text/css" href="CSS/style.css">
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['btn-send'])) {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    //Load Composer's autoloader
    require 'PHPMailer\PHPMailer.php';
    require 'PHPMailer\SMTP.php';
    require 'PHPMailer\Exception.php';
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'navanathnaik5126@gmail.com';                     //SMTP username
        $mail->Password   = 'yslwbfocznudobss';                               //SMTP password
        $mail->SMTPSecure ="tls";            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('navanathnaik5126@gmail.com', 'Contact Form');
        $mail->addAddress('navanathnaik5126@gmail.com', 'Evoting');     //Add a recipient
        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Test Contact Form';
        $mail->Body    = "Sender Name-$name <br> Sender Email-$email <br> Message-$message";


        $mail->send();
        echo '<script>alert("Your message has been sent!");
        window.location="../home.php";</script>';
    } catch (Exception $e) {
        echo '<div class="alert">Message could not be sent!</div>';
    }
}
