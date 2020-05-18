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
        <input type="text" class="input" placeholder="Vacature functie" name="jobOfferFunction"/> <br>
        <p>Vacature filiaal</p>
        <input type="text" class="input" placeholder="Vacature filiaal" name="jobOfferBranch"/> <br>
        <p>Bestand toevoegen</p>
        <input type="file" name="jobOfferFile" id="fileToUpload"> <br>
        <p>Of type zelf een vacature</p><br>
        <textarea name="textDescription" form="addJobOffer" rows="9" cols="50">
    </textarea><br>
        <input type="hidden" name="submit" value="true">
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

