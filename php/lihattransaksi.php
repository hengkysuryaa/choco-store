<!DOCTYPE html>
<html>
  <head>
    <title> Transaksi </title>
    <link rel="stylesheet" href="../styles/lihat-transaksi.css">
  </head>

  <body>
    <div class="flex-container">
      <h3> Transaction History </h3>
    </div>

    <div class="flex-container">
      <table border="1" style="width:100%; text-align:left"> 
        <tr>
          
          <td> <b> Chocolate Name </b> </td>
          <td> <b> Amount </b> </td>
          <td> <b> Total Price </b> </td>
          <td> <b> Date </b> </td>
          <td> <b> Time </b> </td>
          <td> <b> Address </b> </td> 
        </tr>
        <?php

          require_once('connectDB.php');

          // $conn = mysqli_connect("localhost", "root", "aaaaaaab", "willy_wangky");
          // if ($conn->connect_error) {
          //   die("Connection failed: " . $conn->connect_error);
          // }
          $username = $_GET["username"];
          $sql = "SELECT * FROM transaksi WHERE username='$username';";
          try {
            $result = $conn->query($sql);
          } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), '\n';
          }

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>".$row["choco_name"]."</td>";
              echo "<td>".$row["amount"]."</td>";
              echo "<td>".$row["totalprice"]."</td>";
              echo "<td>".$row["date"]."</td>";
              echo "<td>".$row["time"]."</td>";
              echo "<td>".$row["address"]."</td>";
              echo "</tr>";
            }
          } else {
            echo "<td colspan='6'> <center> No Transaction </center> </td>";
          }
          $conn->close();
        ?>
      </table>

    </div>
  </body>

</html>