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
  $username = $getusername($_COOKIE["currentUsername"]);
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Detail page </title>
        <link rel="stylesheet" href="../styles/choco-detail.css">
    </head>
    <body>
        <div class="navbar">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="lihattransaksi.php?username=<?php echo $username ?>">History</a></li>
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
        <button class="btn-add" onclick="location.href = 'ChocoBuyDetail.php?id=<?php echo $id; ?>'"> <b> Buy Now </b> </button>
    </body>
</html>