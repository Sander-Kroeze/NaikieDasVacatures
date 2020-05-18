<div class="sidenav">
    <p>Zoek een vacature</p>
    <p>Categoriseer</p>
    <p>Filter</p>
<!--    Admin opties -->
    <?php
        if (isset($_SESSION['STATUS'])) {
         ?>
            <button onclick="window.location.href='index.php?page=addJobOfferPHP'">Nieuwe vacature toevoegen</button>
        <?php
        }
    ?>
</div>


