<?php
include('sidenav.php');
// haalt gegevens uit de url/database
$query = "SELECT j.name, j.description, j.status, jb.branchName, jf.functionName
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

// user gedeelte

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


// admin gedeelte