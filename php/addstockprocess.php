<?php 

  $servername = "localhost";
  $username = "root";
  $password = "praktikum";
  $dbname = "willywangky";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // data from post
  $amount_add = $_POST["quantity"];

  // query get current stock
  $sql1 = "SELECT stock FROM coklat WHERE id=1;"; //TODO: sesuaiin id
  $result1 = mysqli_query($conn, $sql1);
  $current_stock = mysqli_fetch_assoc($result1);

  // query to update
  $update_stock = $current_stock["stock"] + $amount_add;
  $sql2 = "UPDATE coklat SET stock=$update_stock WHERE id=1;"; //TODO: sesuaiin id

  if (mysqli_query($conn, $sql2)) {
    header('Location: ChocoDetailSuperuser.php');
  } else {
    echo "Error" . mysqli_error($conn);
  }

  mysqli_close($conn);

?>