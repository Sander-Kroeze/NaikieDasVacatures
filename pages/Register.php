<?php


class Register
{

    public function registerUser($userEmail, $userPassword)
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=naikiedasvacatures", DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // Controleer of het formaat van het emailaddres geldig is.
        if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
            echo "<script type='text/javascript'>alert('$userEmail is een geldig email');</script>";
        } else {
//          als het niet geldig is krijg je hier een melding van.
            echo "<script type='text/javascript'>alert('$userEmail is een ongeldige email');</script>";
            exit;
        }

        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        // zoek of email bestaat in de database
        $sql = "SELECT email FROM users WHERE email = '$userEmail'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array(
            $userEmail
        ));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo "<script type='text/javascript'>alert('het email adres: $userEmail, bestaat al!');</script>";
            exit;
        } else {
            echo "<script type='text/javascript'>alert('$hashedPassword');</script>";
          // emailadres bestaat nog niet, dus we maken een INSERT-query om de gegevens in de DB te zetten.
            $query = "INSERT INTO users (email, password)  VALUES ('$userEmail', '$hashedPassword')";
            $db->exec($query);
        }
    }
}