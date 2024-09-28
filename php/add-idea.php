<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
require_once('processes/db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADD IDEA | Sparklook</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
	<div class="form-add-idea">
		<a href="index.php" class="menu__link form-sign__link">
			<img src="../img/logo.png" alt="Sparklook" class="menu__logo-img form-sign__logo">
		</a>
		<form action="processes/add.php" method="post">
			<div class="form-sign__group">
				<label for="title">WHAT DID YOU COME UP WITH?</label>
				<input type="text" id="title" name="title" required placeholder="E.G. DOG ON ON A SKATEBOARD" maxlength="23">
			</div>
			<div class="form-sign__group">
				<label for="description">DESCRIBE IT</label>
				<textarea id="description" name="description" rows="7" cols="50" placeholder="A gleeful dog cruises on a skateboard, its fur in the wind, tongue out, and ears flapping" maxlength="230"></textarea>
			</div>
			<div class="form-sign__group">
				<button type="submit">PUBLISH</button>
			</div>
			<div class="error">
				<?php 
					if (isset($_SESSION['message'])) {
							echo $_SESSION['message'];
							unset($_SESSION['message']);
					}
				?>
			</div>
		</form>
		</div>
</body>
</html>
