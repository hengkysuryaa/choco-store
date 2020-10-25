<?php

  require_once 'connectDB.php';

  $checkRole = include('checkRole.php');
  if (!isset($_COOKIE['currentUsername'])) {
    return header('Location: login.php');
  }

  if ($checkRole($_COOKIE['currentUsername']) == 'superuser') {
    header('Location: dashboard.php');
  }

  $getusername = include('getusername.php');
  $uname = $getusername($_COOKIE["currentUsername"]);

?>

<!DOCTYPE html>
<html>
  <head>
    <title> Transaksi </title>
    <link rel="stylesheet" href="../styles/lihat-transaksi.css">
  </head>

  <body>
    <div class="navbar">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a class="active" href="lihattransaksi.php?username=<?php echo $uname ?>">History</a></li>
            <li class="logout-link"><a href="logout.php">Logout</a></li>
            <li class="search-bar">
            <form method="get" action="SearchPage.php">
                <input type="text" name="search" id="search" autocomplete="off" placeholder="Search">
            </form>
            </li>
        </ul>
      </div> <br> <br> <br>
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

          $username = $_GET["username"];
          $sql = "SELECT * FROM transaksi WHERE username='$username' ORDER BY `date` DESC, `time` DESC;";
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