<?php
require_once 'connectDB.php';

$checkRole = include 'checkRole.php';
$username = $_POST['username'];

$getPassword = $conn->prepare("SELECT `password` FROM `users` WHERE `username`=?");
$getPassword->bind_param("s", $username);
$getPassword->execute();
$getPassword->bind_result($result);
$getPassword->fetch();
$getPassword->close();

if (isset($result)) {
    if (password_verify($_POST['password'], $result)) {
        $getCookie = $conn->prepare("SELECT `cookie_auth` FROM `cookies` WHERE `username`=?");
        $getCookie->bind_param("s", $username);
        $getCookie->execute();
        $getCookie->bind_result($loginCred);
        $getCookie->fetch();
        if (isset($loginCred)) {
            setcookie('currentUsername', $loginCred, time() + (86400 * 30), '/');
        } else {
            $loginCred = bin2hex(random_bytes(20));
            $registerCookie = $conn->prepare("INSERT INTO `cookies` VALUES (?, ?)");
            $registerCookie->bind_param("ss", $loginCred, $username);
            $registerCookie->execute();
            setcookie('currentUsername', $loginCred, time() + (86400 * 30), '/');
            $registerCookie->close();
        }
        $getCookie->close();

        header('Location: ../php/dashboard-user.php');
    } else {
        header('Location: ../pages/login.html');
    }
} else {
    header('Location: ../pages/login.html');
}

$_POST = array();
$conn->close();
