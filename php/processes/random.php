<?php
/**
 * This file handles the function for picking a random idea from the database.
 *
 * @package Ideas
 * @author Isfandiyar Akhmedbayev
 */

require_once('db.php');

/**
 * Function to pick a random idea from the database.
 *
 * @param mysqli $connection The database connection object.
 *
 * @return void The function does not return a value but sets session variables and redirects the user based on the result of the operation.
 */
function getRandomIdea($connection) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $sqlSelect = "SELECT * FROM ideas ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($connection, $sqlSelect);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['viewed_ideas'][] = $row;
        mysqli_free_result($result);
        $_SESSION['row'] = $row;
        mysqli_close($connection);
        header('Location: ../random-idea.php');
    } else {
        error_log("Error: " . mysqli_error($connection));
        mysqli_close($connection);
        header('Location: ../random-idea.php');
    }
}

getRandomIdea($connection);
?>
