<?php
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
	if (!isset($_SESSION['email']) or !isset($_SESSION['prev_username'])) {
		$_SESSION['email'] = "";
		$_SESSION['prev_username'] = "";
	}	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sign up | Sparklook</title>
		<link rel="stylesheet" href="../css/styles.css">
		<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<script src="../js/usernameComp.js"></script>
		<script src="../js/checkPasswords.js"></script>
		<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
	</head>
	<body>
		<div class="form-signup">
		<div class="error" id = "message">
			<?php 
				if (isset($_SESSION['message'])) {
					echo $_SESSION['message'];
					unset($_SESSION['message']);
				}
			?>
		</div>
			<a href="index.php" class="menu__link form-sign__link">
				<img src="../img/logo.png" alt="Sparklook" class="menu__logo-img form-sign__logo">
			</a>
			<form action="../php/processes/registration.php" method="post" id="registrationForm">
				<div class="form-sign__group">
					<label for="username">USERNAME</label>
					<?php
					if(isset($_SESSION['prev_username'])){
					echo('<input type="text" id="username" name="username" required placeholder="min:3   |   max:30   |   0-9 A-Z a-z" maxlength="30" minlength="3" pattern="[A-Za-z0-9]*" value="'.$_SESSION['prev_username'].'">');
					}else {?>
						<input type="text" id="username" name="username" required placeholder="min:3   |   max:30   |   0-9 A-Z a-z" pattern="[A-Za-z0-9]*" maxlength="30" minlength="3">
					<?php }
					?> 
				</div>
				<div class="form-sign__group">
					<label for="email">EMAIL</label>
					<?php
					if(isset($_SESSION['prev_username'])){
					echo('<input type="email" id="email" name="email" required value="'.$_SESSION['email'].'">
					');
					} else {?>
						<input type="email" id="email" name="email" required>
						<?php }
						?> 
				</div>
				<div class="form-sign__group_passwords">
					<div class="form-sign__password_confirm">
						<label for="password">PASSWORD</label>
						<input type="password" id="password" name="password" required placeholder="min:8   |   max:48" maxlength="48" minlength="8">
					</div>
					<div class="form-sign__password_confirm">
						<label for="password">CONFIRM PASSWORD</label>
						<input type="password" id="conf-password" name="conf-password" required>
					</div>
				</div>
				<div class="form-sign__group">
					<button type="submit">SIGN UP</button>
				</div>
			</form>
			<div class="form-sign__text">
				<a href="signin.php">ALREADY ON THE SERVICE?<br>SIGN IN</a>
			</div>
		</div>
	</body>
</html>
