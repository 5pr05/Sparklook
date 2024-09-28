<?php
/**
 * This file handles the function for editing an idea in the database.
 *
 * @package Ideas
 * @author Isfandiyar Akhmedbayev
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('db.php');
$id = $_GET['id'] ?? null;

/**
 * Function to edit an existing idea in the database.
 *
 * @param mysqli $connection The database connection object.
 *
 * @return array The row of the idea that was edited.
 */
function editIdea($connection, $id) {
    $username = $_SESSION['username'];
    if (!isset($row)) {
        $row = "";
    }

    if($id) {
        $id = mysqli_real_escape_string($connection, $id);
        $query = "SELECT * FROM ideas WHERE id = $id";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            header("Location: ../404page.php");
            exit();
        }
    }

    if(isset($_POST['submit'])) {
        $sqlSelect = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($connection, $sqlSelect);
        $user = mysqli_fetch_assoc($result);

        if($user && ($user['isadmin'] == 1 || ($row && $row['username'] == $username))) {
            $title = trim(mysqli_real_escape_string($connection, $_POST['title']));
            $description = trim(mysqli_real_escape_string($connection, $_POST['description']));

            if (strlen($title) > 24){
                $_SESSION['message'] = "TITLE IS TOO LONG | 23 CHARACTERS MAX";
                header("Location: ../php/idea.php?id=$id");
                exit();
            } else if (empty($title)){
                $_SESSION['message'] = "TITLE IS REQUIRED FIELD";
                header("Location: ../php/idea.php?id=$id");
                exit();
            } else if (strlen($description) > 231) {
                $_SESSION['message'] = "DESCRIPTION IS TOO LONG | 230 CHARACTERS MAX";
                header("Location: ../php/idea.php?id=$id");
                exit();
            } else if (ctype_space($title) || ctype_space($description)) {
                $_SESSION['message'] = "TITLE OR DESCRIPTION CANNOT BE ONLY SPACES";
                header("Location: ../php/idea.php?id=$id");
                exit();
            }

            $query = "UPDATE ideas SET title = '$title', description = '$description' WHERE id = $id";
            mysqli_query($connection, $query);
            $_SESSION['message'] = "IDEA SUCCESSFULLY EDITED";
            header("Location: ../php/idea.php?id=$id");
            exit();
        } else {
            $_SESSION['message'] = "ONLY ADMIN OR IDEA OWNER CAN EDIT IDEAS";
            header("Location: ../php/idea.php?id=$id");
            exit();
        }
    }

    return $row;
}



$row = editIdea($connection, $id);
?>
