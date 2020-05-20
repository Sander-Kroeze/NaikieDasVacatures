<?php


class Register
{

    public function registerUser($userEmail, $userPassword)
    {
//      maakt connectie met de DB
        try {
            $db = new PDO("mysql:host=localhost;dbname=naikiedasvacatures", DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if (empty($userPassword)){
            echo "<script type='text/javascript'>alert('U heeft verkeerde gegevens ingevuld');</script>";
            exit;
        }

        // Controleer of het formaat van het emailaddres geldig is.
        if (filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        } else {
//          als het niet geldig is krijg je hier een melding van.
            echo "<script type='text/javascript'>alert('U heeft verkeerde gegevens ingevuld');</script>";
            exit;
        }

//      hashed password voor veiligheid
        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

        // zoek of email bestaat in de database
        $sql = "SELECT email FROM users WHERE email = '$userEmail'";
        $stmt = $db->prepare($sql);
        $stmt->execute(array(
            $userEmail
        ));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);



//      kijkt of er resultaat is gevonden, zo niet kan de query uitgevoerd worden.
        if ($result) {
            echo "<script type='text/javascript'>alert('het email adres: $userEmail, bestaat al!');</script>";
            exit;
        } else {
            echo "<script type='text/javascript'>alert('Je account is aangemaakt, je kan nu inloggen!');</script>";
          // emailadres bestaat nog niet, dus we maken een INSERT-query om de gegevens in de DB te zetten.
            $query = "INSERT INTO users (email, password)  VALUES ('$userEmail', '$hashedPassword')";
            $db->exec($query);
        }
    }
}