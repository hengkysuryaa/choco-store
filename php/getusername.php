<?php
return function ($cookie_auth) {
    require('connectDB.php');

    $getUsername = $conn->prepare("SELECT `username` FROM `cookies` WHERE `cookie_auth`=?");
    $getUsername->bind_param("s", $cookie_auth);
    $getUsername->execute();
    $getUsername->bind_result($username);
    $getUsername->fetch();
    $getUsername->close();
    $conn->close();
    return $username;
};