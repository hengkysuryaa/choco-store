<?php
  require_once 'connectDB.php';

  $checkRole = include('checkRole.php');
  if (!isset($_COOKIE['currentUsername'])) {
    return header('Location: login.php');
  }

  $checkTokenExpiry = include('checkTokenExpiryTime.php');
  $isTokenAvailable = $checkTokenExpiry($_COOKIE['currentUsername']);
  if (!$isTokenAvailable) {
    return header('Location: logout.php?s=0');
  }

  if ($checkRole($_COOKIE['currentUsername']) == 'user') {
    header('Location: dashboard.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Detail page </title>
        <link rel="stylesheet" href="../styles/choco-detail.css">
        <script type="text/javascript">
          function checkOrderStatus() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '../php/checkPendingRequests.php', true);
            xhr.send();
          }

          setInterval('checkOrderStatus()', 1000);
        </script>
    </head>
    <body>
        <div class="navbar">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="tambah-coklat.php">Add New Chocolate</a></li>
            <li class="logout-link"><a href="logout.php">Logout</a></li>
            <li class="search-bar">
            <form method="get" action="SearchPage.php">
                <input type="text" name="search" id="search" autocomplete="off" placeholder="Search">
            </form>
            </li>
        </ul>
        </div> <br> <br> <br>
        <?php 
            include 'connectDB.php';

            $id = $_GET["id"];

            $sql = "SELECT * FROM coklat WHERE idcoklat=$id;";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);

            echo "<div class='flex-container'>";
            echo "<h3>" . $row["choco_name"] . "</h3>";
            echo "</div>";
                
            echo "<div class='flex-container'>";
            echo "<table border='0' style='height:400px; width:100%;'>";

            $fullpath = "../" . $row["imgpath"];

            $url = urlencode("ferrero.jpg"); //TODO: assign dg hasil query row["urlpath"]

            echo "<tr>";
            echo "<td rowspan='5' class='picture-container'> <img src='". $fullpath ."' style='height:10cm; width:10cm'> </td>";
            echo "<td> Amount sold: ".$row["amountsold"]."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Price: ".$row["price"]."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Amount: ".$row["amount"]."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Description </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>".$row["description"]."</td>";
            echo "</tr>";
            echo "</table>";
            echo "</div> <br>";
        ?>  
        <button class="btn-add" onclick="location.href = 'ChocoAddStockDetail.php?id=<?php echo $id; ?>'"> <b> Add Stock </b> </button>
    </body>
</html>