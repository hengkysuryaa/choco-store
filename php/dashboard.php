<?php
  require_once 'connectDB.php';

  if (!isset($_COOKIE['currentUsername'])) {
    return header('Location: login.php');
  }

  $checkTokenExpiry = include('checkTokenExpiryTime.php');
  $isTokenAvailable = $checkTokenExpiry($_COOKIE['currentUsername']);
  if (!$isTokenAvailable) {
    return header('Location: logout.php?s=0');
  }

  $checkRole = include('checkRole.php');
  $getusername = include('getusername.php');
  $username = $getusername($_COOKIE["currentUsername"]);
  $role = $checkRole($_COOKIE['currentUsername']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
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
        <li><a class="active" href="#">Home</a></li>
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
  </div> <br> <br> <br> <br> <br>

  <div class="username" style="margin-left:100px">
    <h2> Hello, <?php echo $username ?> </h2>
  </div> 

  <?php
    //ambil semua database coklat yang ada
    $sql = "SELECT * FROM coklat WHERE amount > 0 ORDER BY amountsold DESC LIMIT 10";
    try {
      $result = $conn->query($sql);
    } catch (Exception $e) {
      echo 'Caught Exception', $e->getMessage(), '\n';
    } 

    // echo $result->num_rows;
    if ($result->num_rows > 0) {
      $i = 0;
      while ($row = $result->fetch_assoc()) {
        if ($i % 4 == 0) {
          echo "<div class='choco-card-container'>";
        }

        if ($role == 'user') {
          echo "<a href='ChocoDetailUser.php?id=". $row["idcoklat"] ."'>";
        } elseif ($role == 'superuser') {
          echo "<a href='ChocoDetailSuperuser.php?id=". $row["idcoklat"] ."'>";
        }
        echo "<div class='choco-card'>";
        echo "<div class='choco-title'><b>".$row["choco_name"]."</b></div>";
        echo "<img src='".'../'.$row["imgpath"]."'>";
        echo "<div class='choco-details'><ul>";
        echo "<li class='choco-price'>".'Rp '.$row["price"]."</li>";
        echo "<li class='choco-desc'>".$row["description"]."</li>";
        echo "</ul></div>";
        echo "</div>";
        echo "</a>";
        if ($i % 4 == 3) {
          echo "</div>";
        }
        $i++;
      }
    }

    $conn->close();
  ?>
</body>
</html>