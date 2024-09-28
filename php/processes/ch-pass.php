<?php
/**
 * This file handles the function for changing the user's password.
 *
 * @package Users
 * @author Isfandiyar Akhmedbayev
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('db.php');

/**
 * Function to change the user's password.
 *
 * @param mysqli $connection The database connection object.
 *
 * @return string The message indicating the result of the operation.
 */
function changePassword($connection) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $current_password = $_POST['current-password'];
        $new_password = $_POST['new-password'];

        $stmt = $connection->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param('s', $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (password_verify($current_password, $row['password'])) {
            $stmt = $connection->prepare("UPDATE users SET password = ? WHERE username = ?");
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt->bind_param('ss', $hashed_password, $_SESSION['username']);
            $stmt->execute();

            $_SESSION['message'] = "PASSWORD CHANGED SUCCESSFULLY";
            header("Location: ../change-password.php");
        } else {
            $_SESSION['message'] = "CURRENT PASSWORD IS INCORRECT";
            header("Location: ../change-password.php");
        }
    }

    header("Location: ../change-password.php");
    exit;
    return $_SESSION['message'];
}

changePassword($connection);
?>
