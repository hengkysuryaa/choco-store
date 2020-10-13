<!DOCTYPE html>
<html>
  <head>
    <title> Willy Wangky </title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>

    <div class="choco-card-container">
      <?php

        //ambil semua database coklat yang ada
        $conn = mysqli_connect("localhost", "root", "aaaaaaab", "willy_wangky");
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

    <a href="tambah_coklat.html"> Tambah Coklat </a><br>
    <a href="lihat_transaksi.php"> Lihat Transaksi </a><br>
  </body>

</html>