<?php
/**
 * This file handles the function for adding new ideas to the database.
 *
 * @package Ideas
 * @author Isfandiyar Akhmedbayev
 */

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
require_once('db.php');

/**
 * Function to add a new idea to the database.
 *
 * @param mysqli $connection The database connection object.
 *
 * @return string The message indicating the result of the operation.
 */
function addIdea($connection) {
	$_SESSION['message'] = "";
	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$title = trim($_POST['title']);
		$description = trim($_POST['description']);
		if (strlen($title) > 24){
			$_SESSION['message'] = "TITLE IS TOO LONG | 23 CHARACTERS MAX";
			header('Location: ../add-idea.php');	
		} else if (empty($title)) {
			$_SESSION['message'] = "TITLE IS REQUIRED FIELD";
			header('Location: ../add-idea.php');	
		} else if (strlen($description) > 231) {
			$_SESSION['message'] = "DESCRIPTION IS TOO LONG | 230 CHARACTERS MAX";
			header('Location: ../add-idea.php');	
		} else {
			$sqlDefender = $connection->prepare("INSERT INTO `ideas` (username, title, description) VALUES (?, ?, ?)");
			$sqlDefender->bind_param("sss", $username, $title, $description);

			if ($sqlDefender->execute()) {
				$_SESSION['message'] = "IDEA SUCCESSFULLY ADDED";	
				header('Location: ../add-idea.php');		
			} else {
				$_SESSION['message'] = "Error: ".$sqlDefender->error;
			}
		}
	} else {
		$_SESSION['message'] = "SIGN IN FIRST";
		header('Location: ../add-idea.php');
	}
	return $_SESSION['message'];
}

addIdea($connection);
?>
