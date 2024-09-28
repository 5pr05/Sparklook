<?php
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
	if (!isset($_SESSION['prev_username'])) {
		$_SESSION['prev_username'] = "";
		$_SESSION['message'] = "";
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sign in | Sparklook</title>
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
			?>
		</div>
			<a href="index.php" class="menu__link form-sign__link">
				<img
					src="../img/logo.png"
					alt="Sparklook"
					class="menu__logo-img form-sign__logo">
			</a>
				<form action="../php/processes/login.php" method="post">
					<div class="form-sign__group">
						<label for="username">USERNAME</label>
						<?php
							if(!isset($_SESSION['prev_username'])){
									echo('<input type="text" id="username" name="username" required>');
							}
							else{
									echo('<input type="text" id="username" name="username" required value="'.$_SESSION['prev_username'].'">');
							}
						?>
				</div>
				<div class="form-sign__group">
					<div class="form-sign__password">
						<label for="password">PASSWORD</label>
						<input type="password" id="password" name="password" required>
					</div>
				</div>
				<div class="form-sign__group">
					<button type="submit">SIGN IN</button>
				</div>
			</form>
			<div class="form-sign__text">
				<a href="signup.php">NOT ON SERVICE YET?<br>SIGN UP</a>
			</div>
		</div>
	</body>
</html>
