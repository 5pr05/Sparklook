<?php 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }
if (!isset($_SESSION['username'])) {
  header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | Sparklook</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <?php require "blocks/menu.php" ?>
  </header>
  <div class="intro-profile">
    <h1 class="welcome">WELCOME TO THE SPARKLOOK, <?= htmlspecialchars($_SESSION['username']); ?></h1>
    <div class="error">
      <?php 
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        }
      ?>
    </div>
    <div class="profile-pic">
      <?php
      $username = $_SESSION['username'];
      $extensions = ['png', 'PNG'];
      $profilePicPath = '../img/default-pic.png';
      foreach ($extensions as $extension) {
        $path = "../uploads/$username.$extension";
        if (file_exists($path)) {
          $profilePicPath = $path;
          break;
        }
      }
      ?>
      <img src="<?= $profilePicPath; ?>" alt="PROFILE PICTURE" class="profile-pic__img">
      
    </div>
    <form action="../php/processes/profile-pic.php" method="post" enctype="multipart/form-data" class="profile-pic__form">
      <label for="profile-pic" class="label-pic">SELECT PROFILE PICTURE <br><span class="label-pic__decription">(image must be in png extension only | no more than 2mb)</span> </label>
      <input type="file" id="profile-pic" name="profile-pic" required accept="image/png">
      <div class="form-sign__group">
        <button type="submit" name="submit-profile-pic">UPLOAD PICTURE</button>
      </div>
    </form>
  </div>
  <footer>
  <?php 
    require "blocks/footer-menu.php";
    if (!isset($_SESSION['username'])) {
      header('Location: 404page.php');
    }
    ?>
  </footer>

</body>
</html>
