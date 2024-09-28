<?php
/**
 * This file handles the function for checking if a username exists in the database.
 *
 * @package Users
 * @author Isfandiyar Akhmedbayev
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('db.php');

/**
 * Function to check if a username exists in the database.
 *
 * @param mysqli $connection The database connection object.
 *
 * @return void The function does not return a value but echoes '1' if the username exists and '0' otherwise.
 */
function checkUsername($connection) {
    $username = $_POST['usernameComp'];

    $stmt = $connection->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '1';
    }

    if ($result->num_rows < 0) {
        echo '0';
    }
}

checkUsername($connection);
?>
