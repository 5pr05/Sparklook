<?php
/**
 * This file handles the function for ending a user session.
 *
 * @package Users 
 * @author Isfandiyar Akhmedbayev
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Function to end a user session.
 *
 * @return void The function does not return a value but redirects the user to the index page and ends the session.
 */
function logout(){
	$_SESSION = array();
	session_destroy();
	header("Location: ../index.php");
	exit();
}

logout();
?>
