<?php
require_once 'connectDB.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $checkUsername = $conn->prepare("SELECT * FROM users WHERE username=?");
    $checkUsername->bind_param("s", $username);
    $checkUsername->execute();
    $checkUsername->store_result();
    $checkUsername->fetch();

    $row_count = $checkUsername->num_rows;

    if ($row_count !== 0) {
        echo 'Username is not available';
    } else {
        echo '';
    }
}

$_GET = array();
$checkUsername->free_result();
$checkUsername->close();
$conn->close();
