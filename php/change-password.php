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
		<title>Change Password | Sparklook</title>
		<link rel="stylesheet" href="../css/styles.css">
		<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link
			href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap"
			rel="stylesheet">
	</head>
	<body>
		<div class="form-signin">
			<div class="error">
				<?php 
					if (isset($_SESSION['message'])) {
						echo $_SESSION['message'];
						unset($_SESSION['message']);
					}
					if (!isset($_SESSION['username'])) {
						header('Location: 404page.php');
					}
				?>
			</div>
			<a href="index.php" class="menu__link form-sign__link">
				<img
					src="../img/logo.png"
					alt="Sparklook"
					class="menu__logo-img form-sign__logo">
			</a>
				<form action="../php/processes/ch-pass.php" method="post">
					<div class="form-sign__group">
						<label for="current-password">CURRENT PASSWORD</label>
						<input type="password" id="current-password" name="current-password" required>
					</div>
					<div class="form-sign__group">
						<div class="form-sign__password">
							<label for="new-password">NEW PASSWORD</label>
							<input type="password" id="new-password" name="new-password" required>
						</div>
					</div>
					<div class="form-sign__group">
						<button type="submit">SUBMIT</button>
					</div>
				</form>
		</div>
	</body>
</html>
