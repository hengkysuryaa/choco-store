<!DOCTYPE html>
<html>
  <head>
    <title> Willy Wangky </title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>

    <a href="./pages/tambah-coklat.html"> Tambah Coklat </a><br>
    <a href="./php/lihattransaksi.php"> Lihat Transaksi </a><br>
    <a href="./pages/register.html"> Daftar </a><br>
    <a href="./pages/login.html"> Login </a><br>
    <a href="./php/SearchPage.php"> Search Coklat </a>

          <div class="choco-card-container">
          <?php

            // require_once()
            //ambil semua database coklat yang ada
            $conn = mysqli_connect("localhost", "root", "aaaaaaab", "chocofactory");
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT * FROM coklat";
            try {
              $result = $conn->query($sql);
            } catch (Exception $e) {
              echo 'Caught Exception', $e->getMessage(), '\n';
            } 

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<div class='choco-card'>";
                echo "<div class='choco-title'>".$row["choco_name"]."</div>";
                echo "<img src='".$row["imgpath"]."'>";
                echo "<div class='choco-details'><ul>";
                echo "<li>".$row["price"]."</li>";
                echo "<li>".$row["amount"]."</li>";
                echo "<li>".$row["amountsold"]."</li>";
                echo "<li>".$row["description"]."</li>";
                echo "</ul></div>";
                echo "</div>";
              }
            }
          ?>
        </div> 

  </body>

</html>