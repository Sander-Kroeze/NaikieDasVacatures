<?php
include('jobOfferPage.php');
include('functions/addJobOffer.php');
include('functions/jobOfferReaction.php');
include('functions/mailer.php');

if (isset($_POST['submitReaction'])) {
//    lees de waarden uit de POST en controleerd ze op speciale tekens.
    $userID = htmlspecialchars($_POST['userID']);
    $jobOfferID = htmlspecialchars($_POST['jobOfferID']);
    $motivation = htmlspecialchars($_POST['Motivation']);

    if (empty($motivation) && empty($_FILES['fileToUpload']['name'])) {
        echo "<script type='text/javascript'>alert('Bijde vakken moeten ingevult zijn.');</script>";
        exit;
    }

    if (!empty($motivation) && empty($_FILES['fileToUpload']['name'])) {
        echo "<script type='text/javascript'>alert('Bijde vakken moeten ingevult zijn.');</script>";
        exit;
    }

    if (empty($motivation) && !empty($_FILES['fileToUpload']['name'])) {
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

if (isset($_POST['changeStatus'])) {
    try {
        $db = new PDO("mysql:host=localhost;dbname=naikiedasvacatures", DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $nieuweStatus = htmlspecialchars($_POST['nieuweStatus']);
    $vacatureID = htmlspecialchars($_POST['jobofferID']);

//  update de gegevens in de database ----------------------------------------------------------->
    $query_updateArtikel = "UPDATE joboffer SET status = '$nieuweStatus' WHERE jobofferID = '$vacatureID'";
    $db->exec($query_updateArtikel);

//  redirect je terug met een alert ----------------------------------------------------------->
    echo "
            <script>
            alert('De status in aangepast');
            location.href='index.php?page=jobOfferPHP&jobofferID=$vacatureID';
              </script>
         ";
}

if (isset($_POST['submitAfwijzen'])) {
    $persMessage = '<p>Bedankt voor je bericht! Je bent niet aangenomen</p>';
    $isSet = 'submitAfwijzen';
    $time = 0;
//  Roept een method aan om een mail te versturen
    $newMail = new mailer;
    $newMail->makeNewMail($time, $persMessage, $isSet);
}

if (isset($_POST['deleteJobOffer'])) {
//  maakt connectie met de DB
    $conn = new mysqli('localhost', 'root', '', 'naikiedasvacatures');
//  controleert de input
    $offerID = htmlspecialchars($_POST['jobOfferID']);

    $query = $conn->query("SELECT * FROM offerreaction
    WHERE idJobOffer = '$offerID'");

//  controleerd als er resultaat is
    if ($query->num_rows === '0') {
//      als het niet zo is verwijderd hij alleen de vacature
        $query2 = "DELETE FROM joboffer WHERE jobofferID = '$offerID';";
        $conn->query($query2);
    } else {
//      als het wel zo is dan verwijderd hij eerst de reacties en dan de vacature
        $query2 = "DELETE FROM offerreaction WHERE idJobOffer = '$offerID';";
        $conn->query($query2);

        $query3 = "DELETE FROM joboffer WHERE jobofferID = '$offerID';";
        $conn->query($query3);
    }

    echo "<script type='text/javascript'>alert('De vacature is verwijderd!');</script>";
    echo "<script>location.href='index.php';</script>";
}

// als deze is geset word de pagina gedupliceerd
if (isset($_POST['dupliceerJobOffer'])) {
//  sql statement
    $offerID = htmlspecialchars($_POST['dupliceerJobOfferID']);
    $conn = new mysqli('localhost', 'root', '', 'naikiedasvacatures');

    $sql = "SELECT * FROM joboffer WHERE jobofferID = '$offerID'";
    $joboffers = $conn->query($sql);

    foreach ($joboffers as $joboffer) {
//      roept een functie aan in een class
        $newJobOffer = new addJobOffer;
        $newJobOffer->newJobOffer($joboffer['name'], $joboffer['idJobfunction'], $joboffer['idJobbranch'], $joboffer['description']);
    }
}



















