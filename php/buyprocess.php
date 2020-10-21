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
  $quantity = $_POST["quantity"];
  $address = $_POST["alamat"];

  // query mendapat harga coklat dan stok
  $sql1 = "SELECT price,stock,amount_sold FROM coklat WHERE id=1;"; //TODO: sesuaiin id
  $result1 = mysqli_query($conn, $sql1);
  $row = mysqli_fetch_assoc($result1);
  $price = $row["price"];
  $stock =$row["stock"];
  //TODO: $username (buyer)

  // check $quantity <= $stock
  if ($stock == 0) {
    echo "<script>window.location='ChocoBuyDetail.php';alert('Stok kosong. Anda tidak dapat membeli coklat ini.');</script>";
  }
  else {

    if ($quantity <= $stock) {

      $totalprice = $quantity * $price;
      // query insert data ke tabel transaksi TODO: sesuaiin dengan nama atribut tabel
      $sql2 = "INSERT INTO transaksi(totalharga,quantity,alamat) VALUES ($totalprice, $quantity, '$address');";
  
      if (mysqli_query($conn, $sql2)) {
          
          // query update stock & update amount sold
          $update_stock = $stock - $quantity;
          $update_amount_sold = $row["amount_sold"] + $quantity;
          $sql3 = "UPDATE coklat SET stock=$update_stock, amount_sold=$update_amount_sold WHERE id=1;";
          if (mysqli_query($conn, $sql3)) {
              header('Location: ChocoDetailUser.php');
            } else {
              echo "Error" . mysqli_error($conn);
          }
        } else {
          echo "Error" . mysqli_error($conn);
      }
  
    } else {
        echo "<script>window.location='ChocoBuyDetail.php';alert('Anda tidak dapat membeli coklat dengan jumlah melebihi stok.');</script>"; 
    }
  }

  mysqli_close($conn);

?>