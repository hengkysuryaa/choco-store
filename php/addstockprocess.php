<?php 
  require_once 'connectDB.php';
  //print_r(phpinfo());
  use SoapClient;
  $configAPI = include('configAPI.php');
  $requestAPI = $configAPI['FACTORY_REQUEST_URL'];

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  ini_set("default_socket_timeout", "300");
  error_reporting(E_ALL);

  // data from post
  $amount_add = $_POST["quantity"];
  $id = $_GET["id"];
  $idrequest = null;

  function createAddStockSOAPData() {
    $return_array = array();
    global $amount_add;
    global $id;

    $id_coklat = new SoapVar($id, XSD_DECIMAL, null, null, 'arg0');
    $return_array[] = $id_coklat;

    $amount_to_add = new SoapVar($amount_add, XSD_DECIMAL, null, null, 'arg1');
    $return_array[] = $amount_to_add;
    
    return $return_array;
  }

  $data = createAddStockSOAPData();
  $client = new SoapClient($requestAPI);
  // for debugging
  $functions = $client->__getFunctions();
  $types = $client->__getTypes();

  // debugging status
  var_dump($functions);
  echo "<br>";
  var_dump($types);
  echo "<br>";
  var_dump($client);
  echo "<br>";
  var_dump($data);
  
    // send request to web service
  try{
    $result = $client->addNewRequest(new SoapVar($data, SOAP_ENC_OBJECT));

    $addPendingRq = $conn->prepare("INSERT INTO `pending_requests` VALUES (?, ?, ?)");
    $addPendingRq->bind_param("iii", $idrequest, $id, $amount_add);
    echo $idrequest;
    echo $id_coklat;
    echo $amount_add;
    $addPendingRq->execute();
    $addPendingRq->close();

    print_r($result);
    echo "<script>window.location='ChocoAddStockDetail.php?id=" . $id . "';alert('Permintaan telah dikirim ke Factory');</script>";
  } catch(SoapFault $ex){
      echo $ex->getMessage();
      echo "<br>";
  }


  /*
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

  mysqli_close($conn); */

?>