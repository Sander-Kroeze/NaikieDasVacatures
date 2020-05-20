<?php
include('acceptPage.php');
include('mailer.php');

if (isset($_POST['submitAcceptMessage'])) {
//  controleerd of er geen tekens tussen zitten die gegevens kunnen verkrijgen.
    $isSet = 'submitAcceptMessage';
    $dateTime = htmlspecialchars($_POST['DateTimeAppointment']);
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

//  controleerd of het ook getallen zijn
    if (!is_numeric($minPoints)) {
        echo "<script type='text/javascript'>alert('voer een geldige datum en tijd in. (voorbeeld: 20-05-2020 18:30)  $minPoints');</script>";
        exit;
    }
//  Roept een method aan om een mail te versturen
    $newMail = new mailer;
    $newMail->makeNewMail($dateTime, $perMessage, $isSet);
}
