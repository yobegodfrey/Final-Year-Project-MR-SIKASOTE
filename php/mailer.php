<?php
$message = '';

// All the requirements
include("../env.php");
require("../vendor/phpmailer/phpmailer/src/Exception.php");
require("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
require("../vendor/phpmailer/phpmailer/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

//Sending email and setting message when send buttton is clicked
if(isset($_POST['message'])){
    //Getting information from contact form
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $email = $_POST['email'];
    $need = $_POST['need'];
    $message = $_POST['message'];

    //New mailer object
    $mail = new PHPMailer();
    $mail->IsSMTP();

    //Mailing details
    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = $EMAIL_HOST;
    $mail->Username   = $EMAIL;
    $mail->Password   = $EMAIL_PASSWORD;

    $mail->IsHTML(true);
    $mail->AddAddress("saiteja13427@gmail.com", "Sai Teja");
    $mail->SetFrom("imtech2k18@gmail.com", "News Aggregator");
    $mail->AddReplyTo($email , $first);
    $mail->Subject = "Contact Form";
    $content = "<p>First Name: $first <br> Last Name: $last <br> Need: $need <br> Message: $message </p>";
    $mail->MsgHTML($content); 

    //Sending email and setting message
    if(!$mail->Send()) {
        $message = "<div class='alert alert-danger' role='alert'>
                    Email Wasn't Sent | Some error occured!
                    </div>";
        var_dump($mail);
    } else {
        $message = "<div class='alert alert-success' role='alert'>
                    Email Sent Successfully!
                    </div>";
    }
}
?>            