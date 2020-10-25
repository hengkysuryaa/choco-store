<?php
require_once 'connectDB.php';

$deleteCookie = $conn->prepare("DELETE FROM `cookies` WHERE `cookie_auth`=?");
$deleteCookie->bind_param("s", $_COOKIE['currentUsername']);
$deleteCookie->execute();

setcookie('currentUsername', '', time() - 60, '/');
$deleteCookie->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="refresh" content="4; url=login.php" />
    <title>Chocolate Factory: Logout</title>
    <link rel="stylesheet" href="../styles/logout.css" />
  </head>
  <body>
    <div class="flex-container">
      <h1>You've been logged out!</h1>
      <h4>You'll be redirected to the login page</h4>
    </div>
  </body>
</html>