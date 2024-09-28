<?php
/**
 * This file handles the function for deleting an idea from the database.
 *
 * @package Ideas
 * @author Isfandiyar Akhmedbayev
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('db.php');

/**
 * Function to delete an idea from the database.
 *
 * @param mysqli $connection The database connection object.
 *
 * @return string The message indicating the result of the operation.
 */
function deleteIdea($connection) {
	
	$username = $_SESSION['username'];
	$id = $_POST['id'];

	if (!isset($_SESSION['username'])) {
		$_SESSION['message'] = "SIGN IN FIRST";
		header('Location: ../idea.php?id='.$id);
	}

	$sqlSelect = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($connection, $sqlSelect);
	$user = mysqli_fetch_assoc($result);

	$sqlSelectIdea = "SELECT * FROM ideas WHERE id = '$id'";
	$resultIdea = mysqli_query($connection, $sqlSelectIdea);
	$idea = mysqli_fetch_assoc($resultIdea);

	if($user && ($user['isadmin'] == 1 || $idea['username'] == $username)){
		$sqlDelete = "DELETE FROM `ideas` WHERE `ideas`.`id` = '$id'";
		$result = mysqli_query($connection, $sqlDelete);
		$_SESSION['message'] = "IDEA SUCCESSFULLY DELETED";
		header('Location: ../idea.php');
	}
	else{
		$_SESSION['message'] = "ONLY ADMIN OR IDEA OWNER CAN DELETE IDEAS";
		header('Location: ../idea.php?id='.$id);
	}
	return $_SESSION['message'];
}

deleteIdea($connection);
?>
