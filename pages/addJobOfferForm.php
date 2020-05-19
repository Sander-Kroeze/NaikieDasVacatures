<?php
include('sidenav.php');
if (isset($_SESSION["STATUS"])) {
    ?>
    <!--Velden voor het oploaden van Vacatures.-->
    <form id="addJobOffer" name="addJobOffer" method="POST" action="" enctype="multipart/form-data">
        <p>Voeg een nieuwe vacature toe.</p>
        <p>Vacature naam</p>
        <input type="text" class="input" placeholder="Vacature naam" name="jobOfferName"/> <br>

        <p>Vacature functie</p>
        <select id="cars" name="jobOfferFunction" class="input" required>
            <option selected>Selecteer een optie</option>
            <?php
            $query = "SELECT * FROM jobfunction";
            $stmt = $db->prepare($query);
            $stmt->execute(array());
            $jobFunctions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($jobFunctions as $jobFunction) {
                ?>
                <option selected
                        value="<?php echo $jobFunction['jobfunctionID']; ?>"><?php echo $jobFunction['functionName']; ?></option>
                <?php
            }
            ?>
        </select>

        <p>Vacature filiaal</p>
        <select id="cars" name="jobOfferBranch" class="input" required>
            <option selected>Selecteer een optie</option>
            <?php
            $query = "SELECT * FROM jobbranch";
            $stmt = $db->prepare($query);
            $stmt->execute(array());
            $jobBranches = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($jobBranches as $jobBranch) {
                ?>
                <option selected
                        value="<?php echo $jobBranch['jobBranchID']; ?>"><?php echo $jobBranch['branchName']; ?></option>
                <?php
            }
            ?>
        </select>

        <p>Bestand toevoegen</p>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <p>Of type zelf een vacature</p><br>
        <textarea name="textDescription" form="addJobOffer" rows="9" cols="50"></textarea><br>
        <input type="hidden" name="submitJobOffer" value="true">
        <input type="submit" class="loginbutton" value="Vacature online zetten" style="color: white" id="submit"/>
    </form>
    <?php
} else {
    echo "
  <script>
    alert('U moet ingelogd zijn om deze pagina te bekjijken.');
    location.href='index.php';
  </script>
  ";
}
?>

