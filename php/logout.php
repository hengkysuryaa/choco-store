<?php
require_once 'connectDB.php';

$deleteCookie = $conn->prepare("DELETE FROM `cookies` WHERE `cookie_auth`=?");
$deleteCookie->bind_param("s", $_COOKIE['currentUsername']);
$deleteCookie->execute();

setcookie('currentUsername', '', time() - 60, '/');
$deleteCookie->close();
$conn->close();
header('Location: ../pages/logout.html');
