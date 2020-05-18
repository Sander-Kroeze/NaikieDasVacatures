<?php
// start een session
session_start();
$_SESSION['Status'] = 0;

//include andere bestanden.
include_once('config/DBconfig.php');
include_once('header.php');

//kijkt naar welke pagina hij moet gaan.
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}

?>

    <div class="content-all-pages">
        <?php
            if ($page) {
                include('pages/' . $page . '.php');
            }
        ?>
    </div>

<?php

// include een footer.
include_once('footer.php');
