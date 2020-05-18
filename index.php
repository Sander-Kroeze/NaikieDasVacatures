<?php
// start een session
session_start();
$_SESSION['Status'] = 0;
$sidebarStatus = 0;

//include andere bestanden.
include('config/DBconfig.php');
include_once('header.php');

if ($sidebarStatus = 0) {
    include('sidenav.php');
}

//kijkt naar welke pagina hij moet gaan.
if(isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "home";
}

?>

    <div class="content-all-pages">
        <?php
            if ($page) {
                include('pages/' . $page . '.php');
            }
        ?>
    </div>
    <div class="push"></div>

<?php

// include een footer.
include_once('footer.php');
