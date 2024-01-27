<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  
  require './PHPMailer/src/Exception.php';
  require './PHPMailer/src/PHPMailer.php';
  require './PHPMailer/src/SMTP.php';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $message = $_POST["message"];

      // Set recipient email address
      $to = "memijekelvinclark@gmail.com";

      // Set subject
      $subject = "New Customer Contact: $email";

      // Compose the email message
      $email_message = "Name: $name\n";
      $email_message .= "Email: $email\n";
      $email_message .= "Message: $message\n";
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
          $mail->Subject = "New Customer Contact: $email";
          $mail->Body    = $email_message;

          $mail->send();
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
      // Redirect back to the form with a success message
      header("Location: contact.php?status=success");
      exit();
  }
  ?>