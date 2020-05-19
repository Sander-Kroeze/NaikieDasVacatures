<?php
include('acceptPage.php');

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['submitAcceptMessage'])) {

    $dateTime = htmlspecialchars($_POST['DateTimeAppointment']);
    $userEmail = htmlspecialchars($_POST['userEmail']);
    $perMessage = htmlspecialchars($_POST['persMessage']);

//  controleert of ze allebij leeg zijn
    if (empty($dateTime) || empty($perMessage)) {
        echo "<script type='text/javascript'>alert('Alle vakken moeten ingevult zijn');</script>";
        exit;
    }
//  Controle of de juiste gegevens zijn ingevult bij het Datum/tijd vakje
    $minUnderscore = str_replace('-', '', $dateTime);
    $minT = str_replace('T', '', $minUnderscore);
    $minPoints = str_replace(':', '', $minT);

    if(!is_numeric($minPoints)) {
        echo "<script type='text/javascript'>alert('voer een geldige datum en tijd in. (voorbeeld: 20-05-2020 18:30)  $minPoints');</script>";
        exit;
    }

// mailt de gegevens die zijn ingevoerd
    require_once 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';  //mailtrap SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'ba5327638e3ad0';   //username
        $mail->Password = '58c4a4d2f59ccc';   //password
        $mail->Port = 2525;                    //smtp port

        $mail->setFrom('NaikieDas@jawel.com', 'Harry');
        $mail->addAddress('user@user.nl', 'Henk');

        $mail->isHTML(true);


        $correctDateFormat = str_replace('T', ' ', $dateTime);

        $mail->Subject = 'Reactie vacature NaikieDas';
        $bodyTime = '<p>Kun je om deze tijd bij ons komen: </p>' . $correctDateFormat;

        $mail->Body = $perMessage . 'kun je om deze tijd lang komen: ' .$correctDateFormat . '?' ;

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "<script type='text/javascript'>alert('Het bericht is verzonden');</script>";

        }
    } catch (Exception $e) {
        echo "<script type='text/javascript'>alert('Het bericht kon niet verzonder worden.');</script>";

    }
}
