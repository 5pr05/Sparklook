<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
require_once('processes/edit-idea.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My idea | Sparklook</title>
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
            <div class="error">
                <?php 
                    if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    }
                ?>
            </div>
            <div class="buttons">
            <form action="processes/delete-idea.php" method="post" class="delete-idea">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="submit" value="DELETE">
            </form>
            <form action="idea.php?id=<?php echo $row['id']; ?>" method="post" class="edit-idea">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="submit" value="EDIT">
            </form>
            </div>
            <a href="index.php" class="menu__link form-sign__link">
                <img src="../img/logo.png" alt="Sparklook" class="menu__logo-img form-sign__logo">
            </a>
            <form action="idea.php?id=<?php echo $row['id']; ?>" method="post" id="editForm">
                <textarea name="title" id="title" class="name" placeholder="Empty field" maxlength="23" readonly><?php echo htmlspecialchars($row['title']); ?></textarea>
                <textarea name="description" id="description" class="description" rows="7" cols="50" placeholder="Empty field" maxlength="230" readonly><?php echo htmlspecialchars($row['description']); ?></textarea>
                <input type="submit" name="submit" value="SUBMIT" id="confirmButton" class="confirmButton">
            </form>
        </div>
    </div>
    <script src="../js/edit.js"></script>
</body>
</html>
