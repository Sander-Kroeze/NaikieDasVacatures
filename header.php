<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans&display=swap" rel="stylesheet">
</head>
<body>
<div class="main">
    <nav class="navigation">
        <ul>
            <?php
            if (isset($_SESSION["ID"])) {

                ?>
                <li>
                    <a style="cursor:pointer;" class="nav_a  <?php if ($_GET['page'] === 'logout') {
                        echo 'active';
                    } ?> " id="a" onclick="location.href='index.php?page=logout'">Uitloggen</a>
                </li>
                <?php
            } else {
                ?>
                <li>
                    <a style="cursor:pointer;" class="nav_a  <?php if ($_GET['page'] === 'login') {
                        echo 'active';
                    } ?> " id="a" onclick="location.href='index.php?page=loginPHP'">Log in</a>
                </li>
                <?php
            }
            ?>
            <li>
                <a style="cursor:pointer;" class="nav_a  <?php if ($_GET['page'] === 'home') {
                    echo 'active';
                }
                if (empty($_GET['page'])) {
                    echo 'active';
                } ?> " id="a" onclick="location.href='index.php'">Hoofdpagina</a>
            </li>
        </ul>
    </nav>
</div>
