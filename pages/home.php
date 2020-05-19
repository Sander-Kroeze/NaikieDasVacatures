<?php
include('sidenav.php');
?>

<h1>Home</h1>

<?php
//if (isset($_SESSION["ID"])) {
//    echo '<h1>' . $_SESSION['EMAIL'] . '</h1>';
//}

//  query die alle vacatures ophaalt uit de database
$query = "SELECT * FROM joboffer";

$stmt = $db->prepare($query);
$stmt->execute(array());
$jobOffers = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php
//  wordt door de opgehaalde gegeven heen gelopen
foreach ($jobOffers as $jobOffer) {
    ?>
    <a class="linkJoboffer" href="index.php?page=jobOfferPHP&jobofferID=<?php echo $jobOffer["jobofferID"]; ?>">
        <div class="divJobOffers">
            <!--        toont alle namen die zijn gevonden.-->
            <?php echo $jobOffer['name']; ?>
        </div>
    </a>
    <?php
}
?>
</div>