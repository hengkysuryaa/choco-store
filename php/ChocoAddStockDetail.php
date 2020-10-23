<!DOCTYPE html>
<html>
    <head>
        <title> Detail page </title>
        <link rel="stylesheet" href="../styles/choco-detail.css">
        <script src="../scripts/choco-detail.js"> </script>
    </head>
    <body>
        <div class="flex-container">
            <h3> Add Stock </h3>
        </div>
        
        <div class="flex-container">
            <table border="0" style="height:500px; width:100%;">
                <?php 

                    include 'connectDB.php';

                    $id = $_GET["id"];

                    $sql = "SELECT * FROM coklat WHERE idcoklat=$id;";
                    $result = mysqli_query($conn, $sql);

                    $row = mysqli_fetch_assoc($result);

                    $fullpath = "../" . $row["imgpath"];

                    $url = urlencode("ferrero.jpg"); //TODO: assign dg hasil query row["urlpath"]

                    echo "<tr>";
                    echo "<td rowspan='7' class='picture-container'> <img src='". $fullpath ."' style='height:10cm; width:10cm'> </td>";
                    echo "<td>".$row["choco_name"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Amount sold: ".$row["amountsold"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Price: ".$row["price"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Amount remaining: ".$row["amount"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Description </td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>".$row["deskripsi"]."</td>";
                    echo "</tr>";
                ?>  
                <tr>
                    <td style="height: 150px;"> 
                        <p> Amount to add: </p>
                        <form action="addstockprocess.php?id=<?php echo $id ?>" method="POST"> 
                            <input class="plus-minus-button" type="button" onclick="minusButton()" value="-">
                            <input type="number" id="quantity" name="quantity" value="1" style="text-align: center;" readonly required>
                            <input class="plus-minus-button" type="button" onclick="plusButton()" value="+">  <br> <br>             
                            <button class="btn-add" type="submit"> <b> Add </b> </button>
                        </form>
                        <button class="btn-cancel" type="submit" onclick="location.href = 'ChocoDetailSuperuser.php?id=<?php echo $id; ?>'"> <b> Cancel </b> </button>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>