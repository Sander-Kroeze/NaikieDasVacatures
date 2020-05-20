<?php

include('addJobOfferForm.php');
include('functions/addJobOffer.php');

if (isset($_POST['submitJobOffer'])) {
//    lees de waarden uit de POST en controleerd ze op speciale tekens.
    $jobOfferName           = htmlspecialchars($_POST['jobOfferName']);
    $jobOfferFunction       = htmlspecialchars($_POST['jobOfferFunction']);
    $jobOfferBranch         = htmlspecialchars($_POST['jobOfferBranch']);
    $textDescription        = htmlspecialchars($_POST['textDescription']);

    if (!empty($textDescription) && !empty($_FILES['fileToUpload']['name'])) {
        echo "<script type='text/javascript'>alert('Vul alleen De beschrijving in of voeg alleen een bestand toe, niet allebei');</script>";
        exit;
    }

    if (empty($textDescription) && !empty($_FILES['fileToUpload']['name'])) {
        //  haalt de lokatie op waar je zit in je mappen structuur
        $currentDirectory = getcwd();
//      de map waar de files in komen die meegestuurd worden
        $uploadDirectory = "/uploads/";

        $errors = []; // Store errors here
//      pakt de naam van de meegestuurde file
        $fileName = $_FILES['fileToUpload']['name'];
//      de tijd in miliseconden voor een unique file naam
        $milliseconds = round(microtime(true) * 1000);
        $newFileName = $milliseconds . '_'. $fileName;

        $descriptionInfo = $newFileName;

//      pakt de laatste character van de variable om te controleren of er een bestand is mee gestuurd
        $last = substr("$newFileName", -1); // returns "s"

//      als er geen bestand is mee gestuurd staat er een underscore op het eind, als je een bestand mee stuur krijg je altijd .docx of .jpg bijvoorbeeld
        if ($last === '_') {
//      de naam wordt naar 0 gezet zodat we het er uit kunnen filteren.
            $newFileName = '0';
        }
//      informatie over het bestand
        $fileSize = $_FILES['fileToUpload']['size'];
        $fileTmpName  = $_FILES['fileToUpload']['tmp_name'];
        $fileType = $_FILES['fileToUpload']['type'];
//      upload het bestand.
        $uploadPath = $currentDirectory . $uploadDirectory . basename($newFileName);
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    }

    if (!empty($textDescription) && empty($_FILES['fileToUpload']['name'])) {
        $descriptionInfo = htmlspecialchars($_POST['textDescription']);
    }


//  roept een functie aan in een class
    $newJobOffer = new addJobOffer;
    $newJobOffer->newJobOffer($jobOfferName, $jobOfferFunction, $jobOfferBranch, $descriptionInfo);
}