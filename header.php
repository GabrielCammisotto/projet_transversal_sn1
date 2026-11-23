<?php include("config.php") ?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header class="header">
        <nav class="nav_bar">
            <img src="./images/hangled-icone.svg" alt="logo">
            <h1 class="title"><span style="color: #F2C14E">The</span> hangled</h1>
            <section class="option_bar">
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./play.php">play</a></li>
                    <li><a href="./rule.php">how to play</a></li>
                    <li><a href="./ranking.php">ranking list</a></li>
                    <?php if (isset($_SESSION['login'])): ?>
                        <li><a href="./logout.php" class="bouton_nav">logout</a></li>
                    <?php else :?>
                        <li><a href="./login.php" class="bouton_nav">login</a></li>
                    <?php endif ; ?>
                </ul>
            </section>
        </nav>
    </header>
