<?php
/**
 * This file handles the function for authorizing a user.
 *
 * @package Users
 * @author Isfandiyar Akhmedbayev
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('db.php');

/**
 * Function to authorize a user.
 *
 * @param mysqli $connection The database connection object.
 *
 * @return void The function does not return a value but sets session variables and redirects the user based on the result of the operation.
 */
function authorizeUser($connection) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$_SESSION['message'] = "";

	if (empty($username) || empty($password)){
			$_SESSION['message'] = "Require field!";
			header('Location: ../signin.php');
	} else {
			$sqlSelect = $connection->prepare("SELECT * FROM `users` WHERE username = ?");
			$sqlSelect->bind_param("s", $username);
			$sqlSelect->execute();
			$loginResult = $sqlSelect->get_result();

			if ($loginResult->num_rows > 0){
					$user = $loginResult->fetch_assoc();
					if (password_verify($password, $user['password'])) {
							$_SESSION['username'] = $username;
							header('Location: ../profile.php');
					} else {
							$_SESSION['message'] = "INVALID USERNAME OR PASSWORD";
							$_SESSION['prev_username'] = $username;
							header('Location: ../signin.php');
					}
			} else {
					$_SESSION['message'] = "INVALID USERNAME OR PASSWORD";
					$_SESSION['prev_username'] = $username;
					header('Location: ../signin.php');
			}
	}
}

authorizeUser($connection);
?>
