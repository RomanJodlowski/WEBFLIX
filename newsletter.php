<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

if (isset($_POST['email'])) {

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (empty($email)) {

        $_SESSION['given_email'] = $_POST['email'];
        header('Location: indexnewsletter.php');

    } else {

        require 'connect_db.php';

        $query = $link->prepare('INSERT INTO users VALUES (NULL, :email)');
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();

        try {
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;

            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;

            $mail->Username = 'jodlowski.roman@gmail.com'; // login gmail
            $mail->Password = 'kwoyvhiuxgxwilgs'; // password

            $mail->CharSet = 'UTF-8';
            $mail->setFrom('no-reply@webflix.uk');
            $mail->addAddress($email);
            $mail->addReplyTo('office@webflix.uk', 'Office');

            $mail->isHTML(true);
            $mail->Subject = 'Newsletter';
            $mail->Body = '<html>
	        <head>
	          <title>Newsletter</title>
	        </head>
	        <body>
	          <h1>Hello!</h1>
	          <p>Download the newest: <a href="https://webflix/news.pdf">Download</a>
	          </p>
	          <hr>
	          <p>Admin test:</p>
	          <p>Webflix</p>
	          <p>Unsubscribe: <a href="https://webflix.uk/unsubscribe">UNSUB</a>
	          </p>
	        </body>
	        </html>
	    	';

            $mail->addAttachment('image/logo.jpg');

            $mail->send();


        } catch(Exception $e) {
            echo "Sending error: {$mail->ErrorInfo}";
        }

    }


} else {
    exit();
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>

    <meta charset="utf-8">
    <title>Request for newsletter</title>
    <meta name="description" content="Sending an email">
    <meta name="keywords" content="news">

    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">

</head>

<body>

<div class="container">

    <header>
        <h1>send</h1>
    </header>

    <main>
        <article>
            <p class="content">thanks</p>
        </article>
    </main>

</div>

</body>
</html>