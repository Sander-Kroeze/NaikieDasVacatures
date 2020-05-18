<?php


class login
{
    public function loginUserOrManager($email, $password)
    {
//      maakt connectie met de DB
        try {
            $db = new PDO("mysql:host=localhost;dbname=naikiedasvacatures", DB_USER, DB_PASS);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
//      kijkt of de gegevens overeen komen met een manager of een user
        try {
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $db->prepare($sql); $stmt->execute(array($email));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

//          Als er resultaat is dan
            if ($result) {
//              het opgehaalde password uit het resultaat
                $hash = $result['password'];
                if (password_verify($password, $hash)) {
//                  maakt session waardes aan die gebruikt kunnen worden.
                    $mijnSession = session_id();
                    $_SESSION['ID'] = $mijnSession;
                    $_SESSION['EMAIL'] = $result['email'];
                    $_SESSION['PASSWORD'] = $result['password'];
                    $_SESSION['user_ID'] = $result['userID'];

                    echo "<script>location.href='index.php?page=home';</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Je wachtwoord is fout');</script>";
                }
            } elseif (!$result) {
                try {
                    $sql = "SELECT * FROM manager WHERE manEmail = ?";
                    $stmt = $db->prepare($sql); $stmt->execute(array($email));
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    $hash = $result['manPassword'];

                    if (password_verify($password, $hash)) {
                        $mijnSession = session_id();
                        $_SESSION['ID'] = $mijnSession;
                        $_SESSION['EMAIL'] = $result['manEmail'];
                        $_SESSION['PASSWORD'] = $result['manPassword'];
                        $_SESSION['STATUS'] = $result['isManager'];
                        $_SESSION['user_ID'] = $result['managerID'];

                        echo "<script>location.href='index.php?page=home';</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('Je wachtwoord is fout');</script>";
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            } else {
                echo "<script type='text/javascript'>alert('Je email is fout.');</script>";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}