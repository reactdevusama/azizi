<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Initialize variables

$name = '';
$email = '';
$phone_number = '';
$successMessage = '';



if (isset($_POST["send"])) {
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $phone_number = $_POST["Phone"];

    require 'src/PHPMailer.php';
    require 'src/Exception.php';
    require 'src/SMTP.php';

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'usamabadarbasra@gmail.com';
        $mail->Password   = 'jxkz meji uqnb zndz'; // Use your App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('usamabadarbasra@gmail.com', 'Contact Form');
        $mail->addAddress('usamabadar281@gmail.com', 'CEO Email');
        // $mail->addAddress('rafat.dxb@gmail.com', 'CEO Email');

        

        $mail->isHTML(true);
        $mail->Subject = 'New Record';
        $mail->Body    = "Sender Name: $name <br> Sender Email: $email <br> Phone Number: $phone_number";

        $mail->send();
        

                  
              // Clear form data
        $name = '';
        $email = '';
        $phone_number = '';
     


   // Set success message in session
   $_SESSION['success_message'] = "Your information has been received!";


        header('Location: index.php');
        exit; 
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>