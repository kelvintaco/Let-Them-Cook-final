<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Submit Recipe || Final</title>
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

          <div class="nav-link contact-link">
            <a href="contact.php" class="btn"> contact </a>
          </div>
        </div>
      </div>
    </nav>
    <!-- end of nav -->
    <main class="page">
     <section class="submit-container fade-up">
          <article>
            <form class="form submit-form" method="post">
                <div class="form-row">
                    <label html="name" class="form-label">your name</label>
                    <input type="text" name="name" id="name" class="form-input" required/>
                  </div>
              <div class="form-row">
                <label html="email" class="form-label">your email</label>
                <input type="text" name="email" id="email" class="form-input" required/>
              </div>
              <div class="form-row">
                <label html="name" class="form-label">recipe name</label>
                <input type="text" name="recipe_name" id="name" class="form-input" required/>
              </div>
              <div class="form-row">
                <label html="message" class="form-label">ingredients</label>
                <textarea name="ingredients" id="message" class="form-textarea" required></textarea>
              </div>
              <div class="form-row">
                <label html="message" class="form-label">tools</label>
                <textarea name="tools" id="message" class="form-textarea" required></textarea>
              </div>
              <div class="form-row">
                <label html="message" class="form-label">instructions/steps/procedures</label>
                <textarea name="procedures" id="message" class="form-textarea" required></textarea>
              </div>
              <div class="form-row">
                <label html="message" class="form-label">notes</label>
                <textarea name="notes" id="message" class="form-textarea" required></textarea>
              </div>
              <button type="submit" class="btn btn-block">
                Submit
              </button>
            </form>
          </article>
          <article class="submit-info">
            <h3>Want to include your favorite recipe and share it with others?</h3>
            <p>
              Just fill out the fields in this form and we will be gladly
              accept it as it will also serve as a way of improving our website.
            </p>
            <p>
              We will contact you if we added your recipe in the website.
              Thank you and happy cooking!
            </p>
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
            header("Location: submit.php?status=success");
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
