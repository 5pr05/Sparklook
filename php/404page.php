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
  <title>404 | Sparklook</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
	<div class="intro">
    <a href="index.php" class="menu__link form-sign__link">
			<img src="../img/logo.png" alt="Sparklook" class="menu__logo-img form-sign__logo">
		</a>
    <span class="page-not-found">PAGE NOT FOUND</span>
  </div>
</body>
</html>