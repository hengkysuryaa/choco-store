<?php
return function ($cookie_auth) {
    require('connectDB.php');

    $checkRole = $conn->prepare("SELECT `token_expiry_time` FROM `cookies` WHERE `cookie_auth`=?");
    $checkRole->bind_param("s", $cookie_auth);
    $checkRole->execute();
    $checkRole->bind_result($token_expiry_time);
    $checkRole->fetch();
    $checkRole->close();
    $conn->close();

    $current_timestamp = new DateTime("now");
    $token_expiry_timestamp = new DateTime($token_expiry_time);

    if ($token_expiry_timestamp < $current_timestamp) {
      return false;
    }
    return true;
};
