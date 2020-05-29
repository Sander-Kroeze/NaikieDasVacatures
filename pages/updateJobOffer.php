<?php
include('pages/sidenav.php');
if (isset($_SESSION["STATUS"]) && $_SESSION['STATUS'] === '1') {
    ?>
    <h1>Bewerk de vacature</h1>
    <?php
    $query = "SELECT j.jobofferID, j.name, j.description, j.status, jb.branchName, jf.functionName
                FROM joboffer j
                INNER JOIN jobbranch jb
                    on j.idJobbranch = jb.jobBranchID
                INNER JOIN jobfunction jf
                    on j.idJobfunction = jf.jobfunctionID
                WHERE jobofferID = ?";

    $stmt = $db->prepare($query);
    $stmt->execute(array($_GET['offerID']));
    $jobOffers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($jobOffers as $jobOffer) {
        ?>
        <div class="divJobOffers">
            <form action="" method="POST" id="updateJobOffer" name="updateJobOffer" enctype="multipart/form-data">
                Naam vacature: <input class="input" value="<?php echo $jobOffer['name']; ?>" name="updatedName"><br>
                Functie:
                <select id="cars" name="updateJobFunction" class="input" required>
                    <?php
                    $query = "SELECT * FROM jobfunction";
                    $stmt = $db->prepare($query);
                    $stmt->execute(array());
                    $jobFunctions = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($jobFunctions as $jobFunction) {
                        ?>
                        <option
                                class="input"
                                value="<?php echo $jobFunction['jobfunctionID']; ?>"><?php echo $jobFunction['functionName']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select><br>
                Filiaal:
                <select id="cars" name="updateJobBranch" class="input" required>
                    <?php
                    $query = "SELECT * FROM jobbranch";
                    $stmt = $db->prepare($query);
                    $stmt->execute(array());
                    $jobBranches = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($jobBranches as $jobBranch) {
                        ?>
                        <option
                                class="input"
                                value="<?php echo $jobBranch['jobBranchID']; ?>"><?php echo $jobBranch['branchName']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select><br>

                <?php
                $cijfersControle = mb_substr($jobOffer['description'], 0, 13);

                if (is_numeric($cijfersControle)) {
                    echo 'Het bestand nu: <a class="linkJoboffer" href="uploads/' . $jobOffer['description'] . '" download=""> Download</a><br>';

                    ?>
                    Update het bestand: <input class="input" type="file" name="fileToUpload" id="fileToUpload"><br>
                    Of voeg een eigen Beschrijving toe :<br> <textarea class="input" name="updateTextDescription"
                                                                       form="updateJobOffer" rows="9"
                                                                       cols="50"></textarea><br>
                    <?php
                } else {
                    ?>
                    Upload een bestand: <input class="input" type="file" name="fileToUpload" id="fileToUpload"><br>
                    Of update de beschrijving:<br> <textarea class="input" name="updateTextDescription"
                                                             form="updateJobOffer"
                                                             rows="9"
                                                             cols="50"><?php echo $jobOffer['description']; ?></textarea>
                    <br>
                    <?php
                }
                ?>
                <input type="hidden" name="jobofferID" value="<?php echo $_GET['jobofferID']; ?>">
                <input type="submit" class="jobReactionButton" value="Oplsaan" id="submit"/>
                <input type="hidden" name="updateJobOffer" value="true">
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