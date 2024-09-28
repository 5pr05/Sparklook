<?php
/**
 * This file handles the function for updating a user's profile picture.
 *
 * @package Users
 * @author Isfandiyar Akhmedbayev
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('db.php');

/**
 * Function to update a user's profile picture.
 *
 * @return void The function does not return a value but sets session variables and redirects the user based on the result of the operation.
 */
function updateProfilePic() {
    $username = $_SESSION['username'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] == 0) {

            if (empty($username)) {
                $_SESSION['message'] = "USERNAME IS EMPTY";
                header('Location: ../profile.php');
                exit();
            }

            $fileSize = $_FILES['profile-pic']['size'];
            if ($fileSize > 2 * 1024 * 1024) {
                $_SESSION['message'] = "FILE EXCEED 2MB";
                header('Location: ../profile.php');
                exit();
            }

            $uploads = 'uploads/';
            $extension = pathinfo($_FILES['profile-pic']['name'], PATHINFO_EXTENSION);
            $path = $uploads . $username . '.' . $extension;

            $allowed_extensions = array('png');
            if (!in_array($extension, $allowed_extensions)) {
                $_SESSION['message'] = "INVALID FILE TYPE";
                header('Location: ../profile.php');
                exit();
            }
            if (move_uploaded_file($_FILES['profile-pic']['tmp_name'], '../../'. $path)) {
                list($width, $height) = getimagesize('../../'. $path);
                $newwidth = 300;
                $newheight = 300;

                $thumb = imagecreatetruecolor($newwidth, $newheight);
                $source = imagecreatefrompng('../../'. $path);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                imagepng($thumb, '../../'. $path);
                $_SESSION['message'] = "PROFILE PICTURE SUCCESSFULLY UPDATED";
                header('Location: ../profile.php');
            } else {
                $_SESSION['message'] =  "FAILED TO UPLOAD";
                header('Location: ../profile.php');
            }
        }
    }
}

updateProfilePic();
?>
