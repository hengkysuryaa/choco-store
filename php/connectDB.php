<?php
$config = include('configDB.php');
$db_hostname = $config['DB_HOSTNAME'];
$db_username = $config['DB_USERNAME'];
$db_password = $config['DB_PASSWORD'];
$db_database_name = $config['DB_DATABASE_NAME'];

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database_name);

if ($conn->connect_errno) {
    echo ('Unable to connect' . $conn->connect_error);
    exit();
}
