<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
require_once('processes/db.php');
if(isset($_SESSION['row'])){
    $row=$_SESSION['row'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random idea | Sparklook</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <?php require "blocks/menu.php" ?>
    </header>
    <div class="intro">
        <div class="card">
            <a href="index.php" class="menu__link form-sign__link">
                <img src="../img/logo.png" alt="Sparklook" class="menu__logo-img form-sign__logo">
            </a>
            <?php 
                if (isset($row['title']) && !empty($row['title'])) {
                    echo '<h3 id="title" class="name">' . htmlspecialchars($row['title']) . '</h3>';
                } else {
                    echo '<h3 id="title" class="name">EMPTY FIELD</h3>';
                }
    if(isset($row['description'])) { 
        echo '<p id="description" class="description">' . htmlspecialchars($row['description']) . '</p>'; 
    } else { 
        echo '<p id="description" class="description">Empty field, click on the round button below to start searching for an idea</p>'; 
    } 
?>

            <div class="random-idea__button">
                <form method="post" action = '../php/processes/random.php'>
                    <input type="hidden" name="viewed" value="1">
                    <button type="submit" class="center-button__link">
                        <img src="../img/circle-button.png" width="150" class="center-button__img" alt="Search for random idea">
                    </button>
                </form>
            </div>
        </div>
        <div class="viewed-ideas">
            <h2 class="viewed-ideas__title">VIEWED IDEAS</h2>
            <div class="viewed-ideas__list">
                    <?php 
                        include('processes/pagination.php');
                        pagination($connection, 'viewed_ideas');
                    ?>
            </div>
        </div>
    </div>
</body>
</html>
