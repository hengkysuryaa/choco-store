<!DOCTYPE html>
<html>
    <head>
        <title> Detail page </title>
        <link rel="stylesheet" href="../styles/choco-detail.css">
    </head>
    <body>
        <?php 
            $servername = "localhost";
            $username = "root";
            $password = "praktikum";
            $dbname = "willywangky";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM coklat WHERE id=1;";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);

            echo "<div class='flex-container'>";
            echo "<h3> Ferrero </h3>";
            echo "</div>";
                
            echo "<div class='flex-container'>";
            echo "<table border='0' style='height:400px; width:100%;'>";

            $url = urlencode("ferrero.jpg"); //TODO: assign dg hasil query row["urlpath"]

            echo "<tr>";
            echo "<td rowspan='5' class='picture-container' style='background-image: url($url);'> </td>";
            echo "<td> Amount sold: ".$row["amount_sold"]."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Price: ".$row["price"]."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Amount: ".$row["stock"]."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Description </td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>".$row["deskripsi"]."</td>";
            echo "</tr>";
            echo "</table>";
            echo "</div> <br>";
        ?>  
        <button class="btn-add" onclick="location.href = 'ChocoAddStockDetail.php'"> <b> Add Stock </b> </button>
    </body>
</html>