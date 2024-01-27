<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact || Final</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon" />
    <!-- normalize -->
    <link rel="stylesheet" href="./css/normalize.css" />
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />
    <!-- main css -->
    <link rel="stylesheet" href="./css/main.css" />
    <script>
      function validateForm() {
          // Get values from the form
          var nameInput = document.getElementById('name');
          var emailInput = document.getElementById('email');
          var messageInput = document.getElementById('message');

          // Regular expression for checking if the input contains only letters
          var lettersOnlyRegex = /^[A-Za-z]+$/;

          // Check if the name contains only letters
          if (!lettersOnlyRegex.test(nameInput.value)) {
            alert('Please enter a valid name (letters only).');
            return false;
          }

          // Check if the email has a valid format
          var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(emailInput.value)) {
            alert('Please enter a valid email address.');
            return false;
          }

          // No need to check the message field

          // If all checks pass, the form is valid
          return true;
      }
    </script>
  </head>
  <body>
    <!-- nav  -->
    <nav class="navbar fade-up">
      <div class="nav-center">
        <div class="nav-header">
          <a href="index.html" class="nav-logo">
            <img src="./assets/logo.svg" alt="simply recipes" />
          </a>
          <button class="nav-btn btn">
            <i class="fas fa-align-justify"></i>
          </button>
        </div>
        <div class="nav-links">
          <a href="index.html" class="nav-link"> home </a>
          <a href="about.html" class="nav-link"> about </a>
          <a href="tags.html" class="nav-link"> tags </a>
          <a href="recipes.html" class="nav-link"> recipes </a>
          <a href="submit.php" class="nav-link"> Submit Your Recipe </a>

        </div>
      </div>
    </nav>
    <!-- end of nav -->
    <main class="page">
     <section class="contact-container fade-up">
          <article class="contact-info">
            <h3>Want To Get In Touch?</h3>
            <p>
              We are happily accepting suggestions and recommendations for our improvement
            </p>
            <p>Just put your queries here and we will try our best to entertain you
              as soon as possible.
            </p>
            <p>
              We always care about the perspective of the users so this will
              mean a lot to us if it means a lot to you.
            </p>
          </article>
          <article>
            <form class="form contact-form" onsubmit="return validateForm()" method="post">
              <div class="form-row">
                <label html="name" class="form-label">your name</label>
                <input type="text" name="name" id="name" class="form-input" required/>
              </div>
              <div class="form-row">
                <label html="email" class="form-label">your email</label>
                <input type="text" name="email" id="email" class="form-input" required/>
              </div>
              <div class="form-row">
                <label html="message" class="form-label">message</label>
                <textarea name="message" id="message" class="form-textarea" required></textarea>
              </div>
              <button type="submit" class="btn btn-block">
                submit
              </button>
            </form>
          </article>
        </section>

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
    </main>
    <!-- footer -->
    <footer class="page-footer">
      <p>
        &copy; <span id="date"></span>
        <span class="footer-logo">Let Them Cook</span> Built by
        <a href="https://www.facebook.com/">Nyiknyok</a>
      </p>
    </footer>
    <script src="./js/app.js"></script>
  </body>
</html>
