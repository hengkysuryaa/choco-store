<?php 

  include 'connectDB.php';

  // data from post
  $amount_add = $_POST["quantity"];
  $id = $_GET["id"];

  // query get current stock
  $sql1 = "SELECT amount FROM coklat WHERE idcoklat=$id;"; //TODO: sesuaiin id
  $result1 = mysqli_query($conn, $sql1);
  $current_stock = mysqli_fetch_assoc($result1);

  // query to update
  $update_stock = $current_stock["amount"] + $amount_add;
  $sql2 = "UPDATE coklat SET amount=$update_stock WHERE idcoklat=$id;"; //TODO: sesuaiin id

  if (mysqli_query($conn, $sql2)) {
    header('Location: ChocoDetailSuperuser.php?id='.$id);
  } else {
    echo "Error" . mysqli_error($conn);
  }

  mysqli_close($conn);

?>