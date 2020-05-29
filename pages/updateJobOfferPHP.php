<?php
include('pages/updateJobOffer.php');
include('functions/addJobOffer.php');

if (isset($_POST['updateJobOffer'])) {
    $jobofferID = htmlspecialchars($_GET['offerID']);
    $jobOfferName = htmlspecialchars($_POST['updatedName']);
    $jobOfferFunction = htmlspecialchars($_POST['updateJobFunction']);
    $jobOfferBranch = htmlspecialchars($_POST['updateJobBranch']);
    $textDescription = htmlspecialchars($_POST['updateTextDescription']);
    $filename = $_FILES['fileToUpload']['name'];

    //  contoleerd de waardes
    if (empty($jobOfferName)) {
        echo "<script type='text/javascript'>alert('Alle velden moeten ingevuld zijn.');</script>";
        exit;
    }

//  controleerd de waardes
    if (empty($jobOfferFunction)) {
        echo "<script type='text/javascript'>alert('Alle velden moeten ingevuld zijn.');</script>";
        exit;
    }

//  controleerd de waardes
    if (empty($jobOfferBranch)) {
        echo "<script type='text/javascript'>alert('Alle velden moeten ingevuld zijn.');</script>";
        exit;
    }

//  controleerd of beide waardes niet leeg zijn.
    if (!empty($textDescription) && !empty($filename)) {
        echo "<script type='text/javascript'>alert('Je mag niet en een beschrijving en een bestand uploaden!');</script>";
        exit;
    }

    $conn = new mysqli('localhost', 'root', '', 'naikiedasvacatures');

    $sql = "SELECT * FROM joboffer WHERE jobofferID = '$jobofferID'";
    $joboffers = $conn->query($sql);

    foreach ($joboffers as $joboffer) {
        $cijfersControle = mb_substr($joboffer['description'], 0, 13);
        if (is_numeric($cijfersControle)) {
            $descriptionInfo = $joboffer['description'];
        } elseif (empty($textDescription) && empty($filename)) {
            echo "<script type='text/javascript'>alert('Je moet of een beschrijving of een bestand toevoegen.');</script>";
            exit;
        }
    }

    //  controleerd of de beschrijving leeg is en de filename niet leeg is
    if (empty($textDescription) && !empty($filename)) {
        //  haalt de lokatie op waar je zit in je mappen structuur
        $currentDirectory = getcwd();
//      de map waar de files in komen die meegestuurd worden
        $uploadDirectory = "/uploads/";

        $errors = []; // Store errors here
//      pakt de naam van de meegestuurde file
        $fileName = $_FILES['fileToUpload']['name'];
//      de tijd in miliseconden voor een unique file naam
        $milliseconds = round(microtime(true) * 1000);
        $newFileName = $milliseconds . '_' . $fileName;

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
        $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
        $fileType = $_FILES['fileToUpload']['type'];
//      upload het bestand.
        $uploadPath = $currentDirectory . $uploadDirectory . basename($newFileName);
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
    }

    if (!empty($textDescription) && empty($_FILES['fileToUpload']['name'])) {
        $descriptionInfo = htmlspecialchars($_POST['updateTextDescription']);
    }

    $newJobOffer = new addJobOffer;
    $newJobOffer->updateJobOffer($jobOfferName, $jobOfferFunction, $jobOfferBranch, $descriptionInfo, $jobofferID);
}