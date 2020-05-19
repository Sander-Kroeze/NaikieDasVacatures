<?php

$query = "SELECT * FROM joboffer WHERE jobofferID = ?";
$stmt = $db->prepare($query);
$stmt->execute(array($_GET['jobofferID']));
$jobOffers = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($jobOffers as $jobOffer) {
    ?>
    <a href="index.php?page=jofOfferPage=<?php echo $jobOffer["jobofferID"] ?>">
        <div class="divJobOffers">
            <!--            Toont alle namen van vacatures die zijn gevonden.-->
            <?php echo $jobOffer['name']; ?>
        </div>
    </a>
    <?php
}
