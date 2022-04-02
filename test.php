<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Test</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css et js/style.css">
</head>

<body>


  <?php include "includes/header.php" ?>

  <?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'phpmailer/src/Exception.php';
  require 'phpmailer/src/PHPMailer.php';
  require 'phpmailer/src/SMTP.php';

  $mail = new PHPMailer(true);
  $vCle = '1234';

  try {
      //Server settings
      $mail->SMTPDebug = 0;                                       //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'Logic.Gaming.Projet@gmail.com';        //SMTP username
      $mail->Password   = 'PSQS2022';                             //SMTP password
      $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('ne-pas-repondre@Logic-Gaming.fr', 'Finalisation inscription');
      //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
      $mail->addAddress('szhang0709@gmail.com');               //Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

      //Attachments
      //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Verification compte Logic-Gaming';
      $mail->Body    = '<h2>Vous avez créée un compte sur Logic-Gaming</h2>
                        <br>
                        <p>Veuillez finaliser la création de votre compte en cliquant <a href="http://localhost/Projet%20annuel/inscription.php?message='.$vCle.'">ici</a><p>';
      //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }

  ?>

  <div>
    <main>
      <div class="container p-5">

      </div>
    </main>
    <footer><?php include "includes/footer.php" ?></footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
