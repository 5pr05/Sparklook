<?php
/**
 * This file handles the function for registering a new user.
 *
 * @package    
 * @author     Isfandiyar Akhmedbayev
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('db.php');

/**
 * Function to register a new user.
 *
 * @param mysqli $connection The database connection object.
 *
 * @return void The function does not return a value but sets session variables and redirects the user based on the result of the operation.
 */
function register($connection){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $raw_password = $_POST['password'];
    $raw_passwordConf = $_POST['conf-password'];
    $profilePic = "default-pic.png";
    $hash_password = password_hash($raw_password, PASSWORD_DEFAULT);
    if (empty($username) || empty($email) || empty($raw_password) || empty($raw_passwordConf)){
        $_SESSION['message'] = "REQUIRED FIELD";
        $_SESSION['prev_username'] = $username;
        $_SESSION['email'] = $email;
        header('Location: ../signup.php');
    } else if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $_SESSION['message'] = "USERNAME CAN ONLY CONTAIN 0-9 A-Z a-z";
        $_SESSION['prev_username'] = $username;
        $_SESSION['email'] = $email;
        header('Location: ../signup.php');
    } else if (!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/', $email)) {
        $_SESSION['message'] = "ENTER CORRECT EMAIL";
        $_SESSION['prev_username'] = $username;
        $_SESSION['email'] = $email;    
        header('Location: ../signup.php');
    } else {
        if (strlen($raw_password) < 8){
            $_SESSION['message'] = "PASSWORD IS TOO SHORT";
            $_SESSION['prev_username'] = $username;
            $_SESSION['email'] = $email;
            header('Location: ../signup.php');
        } else if (strlen($raw_password) > 48){
            $_SESSION['message'] = "PASSWORD IS TOO LONG";
            $_SESSION['prev_username'] = $username;
            $_SESSION['email'] = $email;
            header('Location: ../signup.php');
        }
        if (strlen($username) < 3){
            $_SESSION['message'] = "USERNAME IS TOO SHORT";
            $_SESSION['prev_username'] = $username;
            $_SESSION['email'] = $email;
            header('Location: ../signup.php');
        } else if (strlen($username) > 30){
            $_SESSION['message'] = "USERNAME IS TOO LONG";
            $_SESSION['prev_username'] = $username;
            $_SESSION['email'] = $email;
            header('Location: ../signup.php');
        } else if ($raw_password != $raw_passwordConf){
            $_SESSION['message'] = "PASSWORDS DO NOT MATCH";
            $_SESSION['prev_username'] = $username;
            $_SESSION['email'] = $email;
            header('Location: ../signup.php');
        } else {
            if (checkUsername($connection, $username)) {
                $sqlDefender = $connection->prepare("INSERT INTO `users` (username,password,email,profilepic) VALUES (?, ?, ?, ?)");
                $sqlDefender->bind_param("ssss", $username, $hash_password, $email, $profilePic);
    
                if ($sqlDefender->execute()) {
                    $_SESSION['username'] = $username;
                    header('Location: ../profile.php');
                } else {
                    echo "Error: ".$sqlDefender->error;
                }
            }
            else{
                $_SESSION['prev_username'] = $username;
                $_SESSION['email'] = $email;
                header('Location: ../signup.php');
            }
        }
    }
}
register($connection);

/**
 * Function to check if a user with a given name already exists.
 *
 * @param mysqli $connection Connection to the database.
 * @param string $username Username.
 * @return bool Returns true if the user does not exist and false if it does.
 */
function checkUsername($connection, $username){
    $stmt = $connection->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}
?>
