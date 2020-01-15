<?php 
require_once 'const/constants.php';
require_once 'vendor/autoload.php';
// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465,'ssl'))
  ->setUsername(EMAIL)
  ->setPassword(PASSWORD)
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);




function sendVerificationEmail($userEmail, $vkey){

    global $mailer;
    $body = '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Verification</title>   
    </head> 
    <body>
    <div class="wrapper">
        <p>
            Dziekuję Ci za założenie konta na naszej stronie! Kliknij link poniżej, aby zweryfikować swoje konto!
        </p>
        <a href= "http://localhost/moto/verify.php?vkey=' . $vkey . '">Verify!</a>
    </div>
    </body>
    </html>';
// Create a message
$message = (new Swift_Message('Verification'))
  ->setFrom(EMAIL)
  ->setTo($userEmail)
  ->setBody($body, 'text/html')
  ;

// Send the message
$result = $mailer->send($message);
}


function sendPasswordResetLink($userEmail, $vkey){
  global $mailer;
  $body = '<!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8">
      <title>Verification</title>   
  </head> 
  <body>
  <div class="wrapper">
      <p>
          Witamy! 
          
          Poniżej znajduje się link do strony gdzie możesz zresetować swoje hasło!
      </p>
      <a href= "http://localhost/moto/verify.php?password-vkey=' . $vkey . '">Reset!</a>
  </div>
  </body>
  </html>';
// Create a message
$message = (new Swift_Message('Reset hasła! '))
->setFrom(EMAIL)
->setTo($userEmail)
->setBody($body, 'text/html')
;

// Send the message
$result = $mailer->send($message);
}

?>