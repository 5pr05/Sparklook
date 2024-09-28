<?php
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sparklook</title>
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
    <div class="center-button">
      <a href="random-idea.php" class="center-button">
        <img src="../img/circle-button.png" width="250" class="center-button__img" alt="Search for random idea">
      </a>
    </div>
  </div>
</body>
</html>