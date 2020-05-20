<?php
require_once 'pages/vendor/autoload.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class mailer
{
//  functie om een mail mee te versturen
    public function makeNewMail($dateTime = NULL, $perMessage, $isSet)
    {
//      voegt meer funtionaliteit toe om mails te kunnen versturen
        require_once 'pages/vendor/autoload.php';

        $mail = new PHPMailer(true);
//      probeert een mail te versturen
        try {
//          mail intellingen.
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';  //mailtrap SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'ba5327638e3ad0';   //username
            $mail->Password = '58c4a4d2f59ccc';   //password
            $mail->Port = 2525;                    //smtp port
//          mail gegevens
            $mail->setFrom('NaikieDas@jawel.com', 'Harry');
            $mail->addAddress('user@user.nl', 'Henk');

            $mail->isHTML(true);

//          controleerd of het een afwijzing is of geaccepteerd is.
            if ($isSet === 'submitAcceptMessage') {
                $correctDateFormat = str_replace('T', ' ', $dateTime);
                $mail->Subject = 'Reactie vacature NaikieDas';
                $mail->Body = $perMessage . '<br><br>Kun je om deze tijd lang komen: ' . $correctDateFormat . '?<br><br> Met vriendelijke groet,<br><br> Henk';
            } else {
                $mail->Subject = 'Reactie vacature NaikieDas';
                $mail->Body = 'Bedankt voor je bericht! Je bent niet aangenomen.';
            }
//          als het bericht is verzonden
            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo "<script type='text/javascript'>alert('Het bericht is verzonden');</script>";

            }
//      als het niet lukt, dan?
        } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('Het bericht kon niet verzonder worden.');</script>";

        }
    }
}