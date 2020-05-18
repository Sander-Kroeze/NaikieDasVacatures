<?php

include('addJobOfferForm.php');
include('addJobOffer.php');

if (isset($_POST['submitJobOffer'])) {
//    lees de waarden uit de POST en controleerd ze op speciale tekens.
    $jobOfferName           = htmlspecialchars($_POST['jobOfferName']);
    $jobOfferFunction       = htmlspecialchars($_POST['jobOfferFunction']);
    $jobOfferBranch         = htmlspecialchars($_POST['jobOfferBranch']);
    $textDescription        = htmlspecialchars($_POST['textDescription']);

    if () {
        $newFileName = '0';
    } else {
        $currentDirectory = getcwd();
        $uploadDirectory = "/uploads/";

        $errors = []; // Store errors here

        $fileName = $_FILES['fileToUpload']['name'];
        $milliseconds = round(microtime(true) * 1000);
        $newFileName = $milliseconds . '_'. $fileName;

        $fileSize = $_FILES['fileToUpload']['size'];
        $fileTmpName  = $_FILES['fileToUpload']['tmp_name'];
        $fileType = $_FILES['fileToUpload']['type'];

        $uploadPath = $currentDirectory . $uploadDirectory . basename($newFileName);



        if ($fileSize > 4000000) {
            $errors[] = "File exceeds maximum size (4MB)";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                echo "The file " . basename($newFileName) . " has been uploaded";
            } else {
                echo "An error occurred. Please contact the administrator.";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }


    $newJobOffer = new addJobOffer;
    $newJobOffer->newJobOffer($jobOfferName, $jobOfferFunction,$jobOfferBranch, $textDescription, $newFileName);
}