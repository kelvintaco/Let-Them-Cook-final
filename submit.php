<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './vendor/autoload.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $recipeName = $_POST["recipe_name"];
    $ingredients = $_POST["ingredients"];
    $tools = $_POST["tools"];
    $procedures = $_POST["procedures"];
    $notes = $_POST["notes"];

    // Set recipient email address
    $to = "memijekelvinclark@gmail.com";

    // Set subject
    $subject = "New Recipe Submission: $recipeName";

    // Compose the email message
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Recipe Name: $recipeName\n";
    $email_message .= "Ingredients:\n$ingredients\n";
    $email_message .= "Tools:\n$tools\n";
    $email_message .= "Procedures:\n$procedures\n";
    $email_message .= "Notes:\n$notes";

    // Set additional headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    //mail($to, $subject, $email_message, $headers);
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Specify your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'clarkzerone@gmail.com'; // SMTP username
        $mail->Password   = 'xjsa fixe zkaz xjic';  // SMTP password
        $mail->SMTPSecure = 'tls';   // Enable TLS encryption
        $mail->Port       = 587;     // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false);
        $mail->Subject = "New Recipe Submission: $recipeName";
        $mail->Body    = $email_message;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    // Redirect back to the form with a success message
    header("Location: submit.html?status=success");
    exit();
        }
        ?>
