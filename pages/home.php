<?php
?>

<h1>Home</h1>

<?php
if (isset($_SESSION["ID"])) {
    echo '<h1>' . $_SESSION['EMAIL'] . '</h1>';
}
