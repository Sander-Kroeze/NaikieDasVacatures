<?php
// voegt bestanden toe.
include_once('loginForm.php');
include('functions/Register.php');
include('functions/login.php');


// controleerd of de 'registersubmit' gepost is.
if (isset($_POST['registersubmit'])) {
//    lees de waarden uit de POST en controleerd ze op speciale tekens.
    $userEmail       = htmlspecialchars($_POST['registeremail']);
    $userPassword    = htmlspecialchars($_POST['registerpassword']);

    // zoek of email bestaat in de database
    $sql = "SELECT manEmail FROM manager WHERE manEmail = '$userEmail'";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
        $userEmail
    ));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //      kijkt of er resultaat is gevonden, zo niet kan de query uitgevoerd worden.
    if ($result) {
        echo "<script type='text/javascript'>alert('het email adres: $userEmail, bestaat al!');</script>";
        exit;
    }

    $regiserUser = new Register;
    $regiserUser->registerUser($userEmail, $userPassword);
}

// controleerd of de 'submit' gepost is.
if (isset($_POST['submit'])) {
//    lees de waarden uit de POST en controleerd ze op speciale tekens.
    $Email       = htmlspecialchars($_POST['email']);
    $Password    = htmlspecialchars($_POST['password']);

    $loginUserOrManager = new login;
    $loginUserOrManager->loginUserOrManager($Email, $Password);
}