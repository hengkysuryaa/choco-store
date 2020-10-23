<!DOCTYPE html>
<html>
    <head>
        <title> Detail page </title>
        <link rel="stylesheet" href="../styles/choco-detail.css">
    </head>
    <body>
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

            $url = urlencode("ferrero.jpg"); //TODO: assign dg hasil query row["urlpath"]

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
        <button class="btn-add" onclick="location.href = 'ChocoAddStockDetail.php?id=<?php echo $id; ?>'"> <b> Add Stock </b> </button>
    </body>
</html>