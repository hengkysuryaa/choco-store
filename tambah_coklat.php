<?php

  $nama_coklat = $_POST["name"];
  $jumlah_coklat = $_POST["count"];
  $deskripsi_coklat = $_POST["desc"];
  $harga_coklat = $_POST["price"];
  $ok = 1;

  //handle image for the added chocolate

  $target_dir = "assets/uploads/";
  $target_path = $target_dir . basename($_FILES["pic"]["name"]);

  if ($_FILES["pic"]["size"] > 2000000) {
    //echo "File is too large";
    $ok = 0;
  }

  $file_extension = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));
  $allowable_extension = array("jpg", "png", "jpeg");
  if (!in_array($file_extension, $allowable_extension)) {
    $ok = 0;
  }

  if ($ok == 1) {
    if(move_uploaded_file($_FILES["pic"]["tmp_name"], $target_path) == 1) {
      //echo "upload gambar berhasil";
    } else {
      //echo "gagal";
    }
  }

  //insert to database
  $conn = mysqli_connect("localhost", "root", "aaaaaaab", "willy_wangky");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO coklat(choco_name, price, imgpath, amount, amountsold, description) VALUES ('" . $nama_coklat . "', " . $harga_coklat . ", '" . $target_path . "', " . $jumlah_coklat . ", 0, '" . $deskripsi_coklat . "')";

  try {
    $conn->query($sql);
    echo "Coklat berhasil ditambahkan.";
  } catch (Exception $e) {
    //echo 'Caught exception: ',  $e->getMessage(), '\n';
    //echo "Coklat gagal ditambahkan.";
  }

  $conn->close();

  header("Location: {$_SERVER['HTTP_REFERER']}");
  exit;
?>