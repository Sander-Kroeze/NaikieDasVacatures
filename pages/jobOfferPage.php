<?php
include('sidenav.php');
// haalt gegevens uit de url/database
$query = "SELECT j.jobofferID, j.name, j.description, j.status, jb.branchName, jf.functionName
FROM joboffer j
INNER JOIN jobbranch jb
    on j.idJobbranch = jb.jobBranchID
INNER JOIN jobfunction jf
    on j.idJobfunction = jf.jobfunctionID
WHERE jobofferID = ?";

//$query = "SELECT * FROM joboffer WHERE jobofferID = ?";
$stmt = $db->prepare($query);
$stmt->execute(array($_GET['jobofferID']));
$jobOffers = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_SESSION["STATUS"]) && $_SESSION['STATUS'] === '1') {
    ?>
    <p>Zet het Vactuur aan of uit.</p>
<!--    form voor het uit/aanzetten van een vacature-->
    <form action="" method="POST" enctype="multipart/form-data">
        <select class="input" name="nieuweStatus" onchange='this.form.submit()'>
            <option selected>selecteer een optie</option>
            <?php
            foreach ($jobOffers as $jobOffer) {
                echo 'status: ' . $jobOffer['status'];
                if ($jobOffer['status'] === '0') {
                    ?>
                    <option value="1">Zet deze vacature uit</option>
                    <?php
                } else {
                    ?>
                    <option value="0">Zet deze vacature aan</option>
                    <?php
                }
            }
            ?>
        </select>
        <noscript><input type="submit" value="submit"></noscript>
        <input type="hidden" name="changeStatus" value="true">
        <input type="hidden" name="jobofferID" value="<?php echo $_GET['jobofferID'] ?>">
    </form>
    <!--Form voor het verwijderen van een vacature-->
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="submit" class="jobReactionButton" value="Verwijder" id="submit"/>
        <input type="hidden" name="jobOfferID" value="<?php echo $_GET['jobofferID']; ?>">
        <input type="hidden" name="deleteJobOffer" value="true">
    </form>
    <?php
}


foreach ($jobOffers as $jobOffer) {
    ?>
    <div class="divJobOffers">
        <!--            Toont alle namen van vacatures die zijn gevonden.-->
        <?php echo "Naam vacature: " . $jobOffer['name'] . '<br>'; ?>
        <?php echo "Functie: " . $jobOffer['functionName'] . '<br>'; ?>
        <?php echo "Filiaal: " . $jobOffer['branchName'] . '<br>';


        $cijfersControle = mb_substr($jobOffer['description'], 0, 13);

        if (is_numeric($cijfersControle)) {

            echo 'Download het bestand om de beschrijfing te bekijken:<a class="linkJoboffer" href="uploads/' . $jobOffer['description'] . '" download=""> Download</a><br>';
        } else {
            echo 'Beschrijving: ' . $jobOffer['description'] . '<br>';
        }
        ?>
    </div>
    <?php
}
// user view
if (isset($_SESSION["user_ID"])) {
    ?>
    <p>Reageren op deze vacature.</p><br>

    <!--Velden voor het oploaden van Vacatures.-->
    <form id="addReaction" name="addReaction" method="POST" action="" enctype="multipart/form-data">
        <label>CV:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" required><br><br>
        <label>Motivatie:</label><br>
        <textarea required name="Motivation" form="addReaction" rows="9" cols="50"></textarea><br>
        <input type="hidden" name="userID" value="<?php echo $_SESSION['user_ID'] ?>">
        <input type="hidden" name="jobOfferID" value="<?php echo $_GET['jobofferID'] ?>">
        <input type="hidden" name="submitReaction" value="true">
        <input type="submit" class="loginbutton" value="Verstuur" style="color: white" id="submit"/>
    </form>
    <?php
} elseif (isset($_SESSION["STATUS"]) && $_SESSION['STATUS'] === '1') {
//  manager view
    $queryReactions = "SELECT * FROM offerreaction
Where idJoboffer = ?";

    $stmt2 = $db->prepare($queryReactions);
    $stmt2->execute(array($_GET['jobofferID']));
    $jobReactions = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <div class="divJobReactions">
        <p>Reacties</p>
        <table>
            <tr>
                <th>Download cv</th>
                <th>Motivatie</th>
                <th>Acties</th>
            </tr>
            <?php

            foreach ($jobReactions as $jobReaction) {
                ?>
                <tr>
                    <td>
                        <?php
                        //                      bestand downloaden
                        echo '<a class="linkJoboffer" href="uploads/cv/' . $jobReaction['cv'] . '" download=""> Download cv</a><br>';
                        ?>
                    </td>
                    <td><p><?php echo $jobReaction['motivation'] ?></p></td>
                    <td>
                        <button class="jobReactionButton"
                                onclick="window.location.href='index.php?page=acceptPHP&reaction=<?php echo $jobReaction['offerReactionID']; ?>'">
                            Accepteren
                        </button>
                        <form id="afwijzen" name="afwijzen" method="POST" action="" enctype="multipart/form-data">
                            <input class="jobReactionButton" type="submit" value="Afwijzen" id="submit"/>
                            <input type="hidden" name="submitAfwijzen" value="true">
                        </form>

                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php
} else {
//  view als iemand niet ingelogt is.
    echo 'login als user om een reactie te plaatsen';
}






































