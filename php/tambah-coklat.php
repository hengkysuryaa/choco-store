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
<html>
  <head>
    <title> Add Choco </title>
    <link rel="stylesheet" href="../styles/tambah-coklat.css">
  </head>

  <body>
    <div class="navbar">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a class="active" href="tambah-coklat.php">Add New Chocolate</a></li>
            <li class="logout-link"><a href="logout.php">Logout</a></li>
            <li class="search-bar">
            <form method="get" action="SearchPage.php">
                <input type="text" name="search" id="search" autocomplete="off" placeholder="Search">
            </form>
            </li>
        </ul>
      </div> <br> <br> <br>

    <div class="flex-container">
      <h3> Add New Chocolate </h3>
    </div>

    <div class="flex-container">
      <table border="0" style="width: 100%;">
            <form enctype="multipart/form-data" action="TambahCoklat.php" method="POST">
              <tr>
                <td> Name: </td>
                <td> <input type="text" name="name" size="50" autocomplete="off"> </td>
              </tr>
              <tr> 
                <td> Price: </td>
                <td> <input type="text" name="price" size="50" autocomplete="off"> </td>
              </tr>
              <tr>
                <td> Description:  </td>
                <td> <textarea style="resize:none;" rows="5" cols="52" name="desc" autocomplete="off" required></textarea> </td>
              </tr>
              <tr>
                <td> Upload Image (max 2MB): </td>
                <td> <input type="file" name="pic" id="pic"> </td>
              </tr>
              <tr>
                <td> Amount: </td>
                <td> <input type="text" name="count" autocomplete="off" size="50"> </td>
              </tr>
              <tr> 
                <td colspan="2"> <button class="btn-add" type="submit"> <b> Add Chocolate </b> </button> 
                  <button class="btn-cancel" onclick="location.href = 'dashboard.php'"> <b> Cancel </b> </button>
                </td>
              </tr>
            </form>
            
      </table>
    </div>
<!--
    <form action="../index.php" method="get">
       <button type="submit">Back</button>
    </form> -->

  </body>

</html>