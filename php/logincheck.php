<?php
require_once 'connectDB.php';

$checkRole = include('checkRole.php');
$email = $_POST['email'];

$getPassword = $conn->prepare("SELECT `password` FROM `users` WHERE `email`=?");
$getPassword->bind_param("s", $email);
$getPassword->execute();
$getPassword->bind_result($result);
$getPassword->fetch();
$getPassword->close();

if (isset($result)) {
    if (password_verify($_POST['password'], $result)) {
        $getCookie = $conn->prepare("SELECT `cookie_auth` FROM `cookies` WHERE `email`=?");
        $getCookie->bind_param("s", $email);
        $getCookie->execute();
        $getCookie->bind_result($loginCred);
        $getCookie->fetch();
        if (isset($loginCred)) {
            setcookie('currentUsername', $loginCred, time() + (86400 * 30), '/');
        } else {
            $loginCred = bin2hex(random_bytes(20));
            $registerCookie = $conn->prepare("INSERT INTO `cookies` VALUES (?, ?)");
            $registerCookie->bind_param("ss", $loginCred, $email);
            $registerCookie->execute();
            setcookie('currentUsername', $loginCred, time() + (86400 * 30), '/');
            $registerCookie->close();
        }
        $getCookie->close();
        header('Location: dashboard.php');
    } else {
        header('Location: login.php');
    }
} else {
    header('Location: login.php');
}

$_POST = array();
$conn->close();
?>