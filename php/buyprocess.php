<?php 

  include 'connectDB.php';

  // init soap
  use SoapClient;

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  ini_set("default_socket_timeout", "300");
  error_reporting(E_ALL);

  function createAddSaldoSOAPData() {
    global $totalprice;
    $return_array = array();

    $saldo = new SoapVar($totalprice, XSD_DECIMAL, null, null, 'newSaldo');
    $return_array[] = $saldo;
    
    return $return_array;
  }

  // data from post
  $quantity = $_POST["quantity"];
  $address = $_POST["alamat"];
  $id = $_GET["id"];

  $getusername = include('getusername.php');
  $username = $getusername($_COOKIE["currentUsername"]);

  // query mendapat harga coklat dan stok
  $sql1 = "SELECT * FROM coklat WHERE idcoklat=$id;"; //TODO: sesuaiin id
  $result1 = mysqli_query($conn, $sql1);
  $row = mysqli_fetch_assoc($result1);
  $price = $row["price"];
  $stock = $row["amount"];
  $choconame = $row["choco_name"];
  //TODO: $username (buyer)

  // check $quantity <= $stock
  if ($stock == 0) {
    echo "<script>window.location='ChocoBuyDetail.php?id=" . $id . "';alert('Stok kosong. Anda tidak dapat membeli coklat ini.');</script>";
  }
  else {

    if ($quantity <= $stock) {

      $totalprice = $quantity * $price;
      // query insert data ke tabel transaksi TODO: sesuaiin dengan nama atribut tabel
      $sql2 = "INSERT INTO transaksi(username,choco_name,amount,totalprice,`date`,`time`,address,idcoklat) VALUES ('$username','$choconame', $quantity, $totalprice, CURDATE() , CURTIME(), '$address', $id);";
  
      if (mysqli_query($conn, $sql2)) {
          
          // query update stock & update amount sold
          $update_stock = $stock - $quantity;
          $update_amount_sold = $row["amountsold"] + $quantity;
          $sql3 = "UPDATE coklat SET amount=$update_stock, amountsold=$update_amount_sold WHERE idcoklat=$id;";
          if (mysqli_query($conn, $sql3)) {
            // request add saldo
            try{
              $factory_url = "http://localhost:8080/ws-factory/saldo?wsdl";
              $client = new SoapClient($factory_url);
              $data = createAddSaldoSOAPData($totalprice);
              $result = $client->addSaldo(new SoapVar($data, SOAP_ENC_OBJECT));
              //print_r($result);
              echo "<script>window.location='ChocoDetailUser.php?id=" . $id . "';alert('Berhasil dibeli!');</script>";
            } catch(SoapFault $ex){
                echo $ex->getMessage();
                echo "<br>";
            }

              header('Location: ChocoDetailUser.php?id='.$id);
            } else {
              echo "Error" . mysqli_error($conn);
          }
        } else {
          echo "Error" . mysqli_error($conn);
      }
  
    } else {
        echo "<script>window.location='ChocoBuyDetail.php?id=" . $id . "';alert('Anda tidak dapat membeli coklat dengan jumlah melebihi stok.');</script>"; 
    }
  }

  mysqli_close($conn);

?>