<?php
include('jobOfferPage.php');
include('jobOfferReaction.php');

if (isset($_POST['submitReaction'])) {
//    lees de waarden uit de POST en controleerd ze op speciale tekens.
    $userID = htmlspecialchars($_POST['userID']);
    $jobOfferID = htmlspecialchars($_POST['jobOfferID']);
    $motivation = htmlspecialchars($_POST['Motivation']);

    if (empty($motivation) && empty($_FILES['fileToUpload']['name'])) {
        echo "<script type='text/javascript'>alert('Bijde vakken moeten ingevult zijn.');</script>";
        exit;
    }

//  haalt de lokatie op waar je zit in je mappen structuur
    $currentDirectory = getcwd();
//      de map waar de files in komen die meegestuurd worden
    $uploadDirectory = "/uploads/cv/";

    $errors = []; // Store errors here
//  pakt de naam van de meegestuurde file
    $fileName = $_FILES['fileToUpload']['name'];
//  de tijd in miliseconden voor een unique file naam
    $milliseconds = round(microtime(true) * 1000);
    $newFileName = $milliseconds . '_' . $fileName;

    $cvInfo = $newFileName;

//  pakt de laatste character van de variable om te controleren of er een bestand is mee gestuurd
    $last = substr("$newFileName", -1); // returns "s"

//  als er geen bestand is mee gestuurd staat er een underscore op het eind, als je een bestand mee stuur krijg je altijd .docx of .jpg bijvoorbeeld
    if ($last === '_') {
//      de naam wordt naar 0 gezet zodat we het er uit kunnen filteren.
        $newFileName = '0';
    }
//  informatie over het bestand
    $fileSize = $_FILES['fileToUpload']['size'];
    $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
    $fileType = $_FILES['fileToUpload']['type'];
//  upload het bestand.
    $uploadPath = $currentDirectory . $uploadDirectory . basename($newFileName);
    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

//  roept een functie aan in een class
    $newJobOffer = new jobOfferReaction;
    $newJobOffer->addReactionToJobOffer($userID, $jobOfferID, $motivation, $cvInfo);
}