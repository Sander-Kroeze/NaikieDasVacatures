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
            <li>
                <img style="cursor: pointer" width="55px" src="" onclick="window.open('index.php?page=home')"
                     alt="logo"/>
            </li>
            <li>
                <a style="cursor:pointer;" class="nav_a  <?php if ($_GET['page'] === 'home') {
                    echo 'active';
                }
                if (empty($_GET['page'])) {
                    echo 'active';
                } ?> " id="a" onclick="location.href='index.php'">Home</a>
            </li>
            <li>
                <a style="cursor:pointer;" class="nav_a  <?php if ($_GET['page'] === 'pagina2') {
                    echo 'active';
                } ?> " id="a" onclick="location.href='index.php?page=pagina2'">pagina 2</a>
            </li>
        </ul>
    </nav>
</div>
