<?php
// voegt bestanden toe.
include_once('loginForm.php');
include('Register.php');
include('login.php');


// controleerd of de 'registersubmit' gepost is.
if (isset($_POST['registersubmit'])) {
//    lees de waarden uit de POST en controleerd ze op speciale tekens.
    $userEmail       = htmlspecialchars($_POST['registeremail']);
    $userPassword    = htmlspecialchars($_POST['registerpassword']);

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