<?php
if (isset($_SESSION["STATUS"]) && $_SESSION['STATUS'] === '1') {

    include('sidenav.php');
// query om gegevens van een bepaalde reactie op te halen.
    $query = "SELECT offr.cv, offr.motivation, u.email
FROM offerreaction offr
INNER JOIN users u
    on offr.idUser = u.userID
WHERE offerReactionID = ?";

// haalt de gegevens op uit de database
    $stmt2 = $db->prepare($query);
    $stmt2->execute(array($_GET['reaction']));
    $userInformation = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($userInformation as $userInfo) {
        ?>
        <div class="divJobReactions">
            <p>Motievatie:</p>
            <p><?php echo $userInfo['motivation']; ?></p>
            <p>cv</p>
            <!--        hier kun je het cv mee downloaden.-->
            <?php echo '<a class="linkJoboffer" href="uploads/cv/' . $userInfo['cv'] . '" download=""> Download cv</a><br>'; ?>
        </div>
        <br>
        <p>Persoonlijk bericht:</p>
        <div class="divJobReactions">
            <form id="reactionAccept" name="reactionAccept" method="POST" action="" enctype="multipart/form-data">
                <textarea required name="persMessage" form="reactionAccept" rows="9" cols="50"></textarea><br>
                <input type="datetime-local" id="DateTimeAppointment" name="DateTimeAppointment" required><br>
                <input type="hidden" value="<?php $userInfo['email'] ?>" name="userEmail">
                <input type="hidden" name="offerID" value="<?php echo  $userInfo['idJoboffer'] ;?>">
                <input type="hidden" name="reactionID" value="<?php echo $_GET['reaction']; ?>">
                <input type="hidden" name="submitAcceptMessage" value="true">
                <input type="submit" class="loginbutton" value="Uitnodiging Versturen" style="color: white"
                       id="submit"/>
            </form>
        </div>
        <?php
    }
} else {
    echo "
  <script>
    alert('U moet ingelogd zijn om deze pagina te bekjijken.');
    location.href='index.php';
  </script>
  ";
}
