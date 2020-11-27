<?php
  // print_r(phpinfo());

  use SoapClient;

  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // ini_set("default_socket_timeout", "300");
  // error_reporting(E_ALL);

  $nama_coklat = $_POST["name"];
  $jumlah_coklat = $_POST["count"];
  $deskripsi_coklat = $_POST["desc"];
  $harga_coklat = $_POST["price"];
  $ok = 1;

  function createAddCoklatSOAPData() {
    $return_array = array();
    global $nama_coklat;
    global $jumlah_coklat;

    //add coklat info (ID, jumlah, nama)
    $coklat_baru = array();
    $coklat_baru[] = new SoapVar(100, XSD_DECIMAL, null, null, 'ID');
    $coklat_baru[] = new SoapVar($jumlah_coklat, XSD_DECIMAL, null, null, 'jumlah');
    $coklat_baru[] = new SoapVar($nama_coklat, XSD_STRING, null, null, 'nama');
    
    $coklat_baru = new SoapVar($coklat_baru, SOAP_ENC_OBJECT, null, null, 'arg0');
    $return_array[] = $coklat_baru;

    //add all bahan yang dibutuhkan pada resep coklat
    foreach ($_POST["quantity"] as $key => $val) {

      $resep_bahan_baru = array();
      $resep_bahan_baru[] = new SoapVar($_POST["quantity"][$key], XSD_DECIMAL, null, null, 'jumlahBahan');
      $resep_bahan_baru[] = new SoapVar($_POST["bahan"][$key], XSD_STRING, null, null, 'namaBahan');

      $resep_bahan_baru = new SoapVar($resep_bahan_baru, SOAP_ENC_OBJECT, null, null, 'arg1');
      $return_array[] = $resep_bahan_baru;
    } 
    return $return_array;
  }

  $api = include('configAPI.php');
  $factory_url = $api['FACTORY_COKLAT_URL'];

  $data = createAddCoklatSOAPData();
  $client = new SoapClient($factory_url);
  // for debugging
  $functions = $client->__getFunctions();
  $types = $client->__getTypes();

  // send request to web service
  try{
    $result = $client->addNewCoklat(new SoapVar($data, SOAP_ENC_OBJECT));
    print_r($result);
  } catch(SoapFault $ex){
      echo $ex->getMessage();
      echo "<br>";
  }

  //handle image for the added chocolate
  $target_dir = "assets/uploads/";
  $target_path = $target_dir . basename($_FILES["pic"]["name"]);

  if ($_FILES["pic"]["size"] > 2000000) {
    $ok = 0;
  }

  $file_extension = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
  $allowable_extension = array("jpg", "png", "jpeg", "jfif");
  if (!in_array($file_extension, $allowable_extension)) {
    $ok = 0;
  }

  if ($ok == 1) {
    $target_path_to = '../' . $target_path;
    if(move_uploaded_file($_FILES["pic"]["tmp_name"], $target_path_to) == 1) {
    } else {

    }
  }

  //insert to database
  require_once ("connectDB.php");

  $sql = "INSERT INTO coklat(choco_name, price, imgpath, amount, amountsold, description) VALUES ('" . $nama_coklat . "', " . $harga_coklat . ", '" . $target_path . "', " . $jumlah_coklat . ", 0, '" . $deskripsi_coklat . "')";

  try {
    $conn->query($sql);
    echo "Coklat berhasil ditambahkan.";
  } catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), '\n';
    echo "Coklat gagal ditambahkan.";
  }

  $conn->close();

  header("Location: {$_SERVER['HTTP_REFERER']}");
  exit;
?>