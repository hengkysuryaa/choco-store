<?php 
  if (!isset($_COOKIE['currentUsername'])) {
    header('Location: ./php/login.php');
  }
  
  $checkTokenExpiry = include('./php/checkTokenExpiryTime.php');
  $isTokenAvailable = $checkTokenExpiry($_COOKIE['currentUsername']);
  if (!$isTokenAvailable) {
    return header('Location: ./php/logout.php?s=0');
  }

  header('Location: ./php/dashboard.php');
?>