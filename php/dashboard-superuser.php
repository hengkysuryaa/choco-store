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
        <li><a href="../pages/tambah-coklat.html">Add Coklat</a></li>
        <li class="logout-link"><a href="logout.php">Logout</a></li>
        <li class="search-bar">
          <form method="get" action="SearchPage.php">
              <input type="text" name="search" id="search" autocomplete="off" placeholder="Search">
          </form>
        </li>
    </ul>

    <br>
    <br>
    <br>
    
    <div class="choco-card-container">
      <?php

        include "connectDB.php";

        /*
        //ambil semua database coklat yang ada
        $conn = mysqli_connect("localhost", "root", "aaaaaaab", "chocofactory");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        } */

        $sql = "SELECT * FROM coklat";
        try {
          $result = $conn->query($sql);
        } catch (Exception $e) {
          echo 'Caught Exception', $e->getMessage(), '\n';
        } 

        // echo $result->num_rows;

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            echo "<a href='ChocoDetailSuperuser.php?id=" . $row["idcoklat"] . "'> " . $row["choco_name"] . "</a>";
            echo "<br>";
          }
        }

        $conn->close();
      ?>
    </div> 

</body>
</html>