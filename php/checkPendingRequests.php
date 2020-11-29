<?php
    use SoapClient;
    require_once 'connectDB.php';
    $configAPI = include('configAPI.php');
    $requestAPI = $configAPI['FACTORY_REQUEST_URL'];

    function createRequestStockSOAPData($idCoklat, $idRequest, $jumlah) {
        $return_array = array();

        $request_baru = array();
        $request_baru[] = new SoapVar($idCoklat, XSD_DECIMAL, null, null, 'idCoklat');
        $request_baru[] = new SoapVar($idRequest, XSD_DECIMAL, null, null, 'idRequest');
        $request_baru[] = new SoapVar($jumlah, XSD_DECIMAL, null, null, 'jumlah');
        $request_baru = new SoapVar($request_baru, SOAP_ENC_OBJECT, null, null, 'arg0');

        $return_array[] = $request_baru;

        return $return_array;
    }

    $getPendingRqs = $conn->query("SELECT * FROM `pending_requests`");
    $pendingRqs = $getPendingRqs->fetch_all(MYSQLI_ASSOC);
    
    foreach ($pendingRqs as $pendingRq) {
        $data = createRequestStockSOAPData($pendingRq["idcoklat"], $pendingRq["idrequest"], $pendingRq["jumlah"]);
        $client = new SoapClient($requestAPI);
        // for debugging
        $functions = $client->__getFunctions();
        $types = $client->__getTypes();

        try {
            $result = $client->getRequestStatus(new SoapVar($data, SOAP_ENC_OBJECT));
            if ($result->return == "delivered") {
                $updateStockCoklat = $conn->prepare("UPDATE `coklat` SET amount = amount + ? WHERE idcoklat = ?");
                $updateStockCoklat->bind_param("ii", $pendingRq["jumlah"], $pendingRq["idcoklat"]);
                $updateStockCoklat->execute();
                $updateStockCoklat->close();

                $deletePendingRq = $conn->prepare("DELETE FROM `pending_requests` WHERE idrequest = ?");
                $deletePendingRq->bind_param("i", $pendingRq["idrequest"]);
                $deletePendingRq->execute();
                $deletePendingRq->close();
            }
        } catch (SoapFault $ex) {
            echo $ex->getMessage();
            echo "<br>";
        }
    }

    $getPendingRqs->close();
    $conn->close();
?>