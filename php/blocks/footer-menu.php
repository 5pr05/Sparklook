<?php 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }
?>
<nav class="menu">
  <a href="processes/logout.php" class="menu__link menu__link__hover">
    <span class="footer-menu__text">LOG OUT</span>
  </a>
  <a href="my-ideas.php" class="menu__link menu__link__hover">
    <span class="footer-menu__text">MY IDEAS</span>
  </a>
  <a href="all-ideas.php" class="menu__link">
    <span class="footer-menu__text">ALL IDEAS</span>
  </a>
  <a href="change-password.php" class="menu__link menu__link__hover">
    <span class="footer-menu__text">CHANGE PASSWORD</span>
  </a>
</nav>
