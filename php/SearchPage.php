<?php
  $getusername = include('getusername.php');
  $username = $getusername($_COOKIE["currentUsername"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<body>
    <ul>
        <li><a class="active" href="#">Home</a></li>
        <li class="logout-link"><a href="logout.php">Logout</a></li>
    </ul>

    <br>
    <br>
    <br>
    
      <?php 

        include 'connectDB.php';

        $content_per_page = 3;
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
        $start = ($page>1) ? ($page * $content_per_page) - $content_per_page : 0;

        $search = $_GET["search"];

        echo "TESUTO" . $search;

        $sql = "SELECT * FROM coklat WHERE choco_name LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        $total_row = mysqli_num_rows($result);

        $total_page = ceil($total_row / $content_per_page);

        $sql2 = "SELECT * FROM coklat WHERE choco_name LIKE '%$search%' LIMIT $start, $content_per_page";
        $result2 = mysqli_query($conn, $sql2);

        while ($row = mysqli_fetch_assoc($result2)) {

            echo "<center>";
            echo "<table border='1'>";
            echo "<tr>";
            echo "<td>".$row["choco_name"]."</td>";
            echo "<td> Price: ".$row["price"]."</td>";
            echo "</tr>";
            echo "</table>";
            echo "<br>";
            echo "</center>";

        }
    ?>
<br>
<center> <div>
    <?php 
        for($i=1; $i<=$total_page; $i++) {
            echo "<a href='?search=$search&page=$i'>".$i."</a>";
        }
    ?>
</div> </center>


</body>
</html>