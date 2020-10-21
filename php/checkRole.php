<?php
return function ($cookie_auth) {
    require('connectDB.php');

    $checkRole = $conn->prepare("SELECT `role` FROM `users` NATURAL JOIN `cookies` WHERE `cookie_auth`=?");
    $checkRole->bind_param("s", $cookie_auth);
    $checkRole->execute();
    $checkRole->bind_result($role);
    $checkRole->fetch();
    $checkRole->close();
    $conn->close();
    return $role;
};
