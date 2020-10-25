<?php 
  if (isset($_COOKIE['currentUsername'])) {
      header('Location: ./php/dashboard.php');
  } else {
    header('Location: ./php/login.php');
  }
?>