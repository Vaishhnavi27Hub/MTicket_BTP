<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';

include 'connect.php';
session_start();

if (isset($_GET['pid']) && !empty($_SESSION['email'])) {
    $ticketNo = $_GET['pid'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $source = $_SESSION['source'];
    $destination = $_SESSION['dest'];
    $amount = $_SESSION['final'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = 'email-smtp.ap-south-1.amazonaws.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "AKIAWQUOZ33PVOYWEFAF";
    $mail->Password = "BLH1NEYOH3IRR0A3yJTU8GH6pcSasjmjYm2IY7GTp7re";

    // Set email details
    $mail->setFrom('22cs3032@rgipt.ac.in', 'Vaishhnavi Kadiyala');
    $mail->addAddress($email, $name);
    $mail->Subject = 'Your Ticket Confirmation';

    // Email body content
    $mail->Body = "
        Hello $name,<br><br>
        Your ticket has been successfully confirmed.<br>
        <b>Booking Details:</b><br>
        Ticket Number: $ticketNo<br>
        Source: $source<br>
        Destination: $destination<br>
        Amount Paid: ₹$amount<br><br>
        Thank you for choosing our service!
    ";
    $mail->isHTML(true);

    // Send email
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Email has been sent successfully!";
        
    }
} else {
    echo "Invalid request!";
}
?>
