<nav class="menu">
  <a href="add-idea.php" class="menu__link">
    <img src="../img/add-idea-button.png" alt="WOULD YOU LIKE TO" class="menu__icon">
    <span class="menu__text">ADD IDEA</span>
  </a>
  <a href="index.php" class="menu__link">
    <img src="../img/logo.png" alt="Sparklook" class="menu__logo-img">
  </a>
  <?php
  if (isset($_SESSION['username'])) {
      echo '<a href="../php/profile.php" class="menu__link">
              <img src="../img/login-button.png" alt="PROFILE" class="menu__icon">
              <span class="menu__text">PROFILE</span>
            </a>';
  } else {
      echo '<a href="../php/signin.php" class="menu__link">
              <img src="../img/login-button.png" alt="REGISTER OR" class="menu__icon">
              <span class="menu__text">SIGN IN</span>
            </a>';
  }
  ?>
</nav>

