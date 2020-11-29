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

  if ($checkRole($_COOKIE['currentUsername']) == 'superuser') {
    header('Location: dashboard.php');
  }

  $getusername = include('getusername.php');
  $username = $getusername($_COOKIE["currentUsername"]);
  $role = $checkRole($_COOKIE['currentUsername']);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Detail page </title>
        <link rel="stylesheet" href="../styles/choco-detail.css">
        <script src="../scripts/choco-detail.js"> </script>
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
            <h3> Buy Chocolate </h3>
        </div>
        
        <div class="flex-container">
            <table border="0" style="height:650px; width:100%;">
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
                    echo "<td> Price: ";
                    echo "<p id='price' style='display:inline;'>".$row["price"]."</p>";
                    echo "</td>";
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
                        <p> Amount to Buy: </p>
                        <form action="buyprocess.php?id=<?php echo $id; ?>" method="POST"> 
                            <input class="plus-minus-button" type="button" onclick="minusButtonBuy()" value="-">
                            <input type="number" id="quantity" name="quantity" value="1" style="text-align: center;" readonly required>
                            <input class="plus-minus-button" type="button" onclick="plusButtonBuy()" value="+"> <br>
                            <p> Total price: </p>
                            <p id="totalprice" style="font-weight: bold;"> Rp <?php echo $row["price"] ?> </p>
                            <p> Address: </p>
                            <textarea class="address-box" rows="5" cols="100" name="alamat" placeholder="Insert your address" required></textarea> <br>
                            <button class="btn-add2" type="submit"> <b> Buy </b> </button>
                        </form>
                        <button class="btn-cancel" type="submit" onclick="location.href = 'ChocoDetailUser.php?id=<?php echo $id; ?>'"> <b> Cancel </b> </button>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>