<?php
  require_once 'connectDB.php';

  $checkRole = include('checkRole.php');
  if (!isset($_COOKIE['currentUsername'])) {
    return header('Location: login.php');
  }

  $checkTokenExpiry = include('checkTokenExpiryTime.php');
  $isTokenAvailable = $checkTokenExpiry($_COOKIE['currentUsername']);
  if (!$isTokenAvailable) {
    return header('Location: logout.php');
  }

  if ($checkRole($_COOKIE['currentUsername']) == 'user') {
    header('Location: dashboard.php');
  }

  $getusername = include('getusername.php');
  $username = $getusername($_COOKIE["currentUsername"]);
  $role = $checkRole($_COOKIE['currentUsername']);

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Detail page </title>
        <link rel="stylesheet" href="../styles/choco-detail.css">
        <script src="../scripts/choco-detail.js"> </script>
    </head>
    <body>
        <div class="navbar">
        <ul>
            <li><a class="active" href="dashboard.php">Home</a></li>
            <?php if ($role == 'user'): ?>
            <li><a href="lihattransaksi.php?username=<?php echo $username ?>">History</a></li>
            <?php elseif ($role == 'superuser'): ?>
            <li><a href="tambah-coklat.php">Add New Chocolate</a></li>
            <?php endif; ?>
            <li class="logout-link"><a href="logout.php">Logout</a></li>
            <li class="search-bar">
            <form method="get" action="SearchPage.php">
                <input type="text" name="search" id="search" autocomplete="off" placeholder="Search">
            </form>
            </li>
        </ul>
        </div> <br> <br> <br>
        <div class="flex-container">
            <h3> Add Stock </h3>
        </div>
        
        <div class="flex-container">
            <table border="0" style="height:500px; width:100%;">
                <?php 

                    include 'connectDB.php';

                    $id = $_GET["id"];

                    $sql = "SELECT * FROM coklat WHERE idcoklat=$id;";
                    $result = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_assoc($result);

                    $fullpath = "../" . $row["imgpath"];

                    $url = urlencode("ferrero.jpg"); //TODO: assign dg hasil query row["urlpath"]

                    echo "<tr>";
                    echo "<td rowspan='7' class='picture-container'> <img src='". $fullpath ."' style='height:10cm; width:10cm'> </td>";
                    echo "<td>".$row["choco_name"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Amount sold: ".$row["amountsold"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Price: ".$row["price"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Amount remaining: ".$row["amount"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Description </td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>".$row["description"]."</td>";
                    echo "</tr>";
                ?>  
                <tr>
                    <td style="height: 150px;"> 
                        <p> Amount to add: </p>
                        <form action="addstockprocess.php?id=<?php echo $id ?>" method="POST"> 
                            <input class="plus-minus-button" type="button" onclick="minusButton()" value="-">
                            <input type="number" id="quantity" name="quantity" value="1" style="text-align: center;" readonly required>
                            <input class="plus-minus-button" type="button" onclick="plusButton()" value="+">  <br> <br>             
                            <button class="btn-add2" type="submit"> <b> Add </b> </button>
                        </form>
                        <button class="btn-cancel" type="submit" onclick="location.href = 'ChocoDetailSuperuser.php?id=<?php echo $id; ?>'"> <b> Cancel </b> </button>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>