<?php
/**
 * This file handles the function for displaying a list of the user's ideas.
 *
 * @package Ideas
 * @author Isfandiyar Akhmedbayev
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('db.php');

/**
 * Function to display a list of the user's ideas.
 *
 * @param mysqli $connection The database connection object.
 *
 * @return void The function does not return a value but echoes HTML links to the user's ideas and sets session variables based on the result of the operation.
 */
function displayIdeas($connection) {
	$username = $_SESSION['username'];

	$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
	$ideasOnPage = 7;

	if (isset($username)) {
		$result = $connection->query("SELECT * FROM `ideas` WHERE username = '$username'");
		$totalIdeas = $result->num_rows;
		$totalPages = ceil($totalIdeas / $ideasOnPage);

		if ($currentPage > $totalPages) {
			$currentPage = $totalPages;
		}
		if ($currentPage < 1) {
			$currentPage = 1;
		}

		$startIndex = ($currentPage - 1) * $ideasOnPage;
		$result = $connection->query("SELECT * FROM `ideas` WHERE username = '$username' LIMIT $startIndex, $ideasOnPage");

		if ($result) {
			while ($row = $result->fetch_assoc()) {
				echo "<a href='idea.php?id=" . $row["id"] . "' class='all-idea'>" . htmlspecialchars($row["title"]) . "</a><br>";
			}
		} else {
			echo "Error: ".$connection->error;
		}
	} else {
		$_SESSION['message'] = "SIGN IN FIRST";
		header('Location: ../add-idea.php');
	}
}

displayIdeas($connection);
?>
