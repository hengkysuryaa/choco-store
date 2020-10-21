<!DOCTYPE html>
<html>
    <head>
        <title> Detail page </title>
        <link rel="stylesheet" href="../styles/choco-detail.css">
        <script src="../scripts/choco-detail.js"> </script>
    </head>
    <body>
        <div class="flex-container">
            <h3> Buy Chocolate </h3>
        </div>
        
        <div class="flex-container">
            <table border="0" style="height:650px; width:100%;">
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

                    $url = urlencode("ferrero.jpg"); //TODO: assign dg hasil query row["urlpath"]

                    echo "<tr>";
                    echo "<td rowspan='7' class='picture-container' style='background-image: url($url);'> </td>";
                    echo "<td>".$row["nama"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Amount sold: ".$row["amount_sold"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Price: ".$row["price"]."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Amount remaining: ".$row["stock"]."</td>";
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
                        <p> Amount to Buy: </p>
                        <form action="buyprocess.php" method="POST"> 
                            <input class="plus-minus-button" type="button" onclick="minusButtonBuy()" value="-">
                            <input type="number" id="quantity" name="quantity" value="1" style="text-align: center;" readonly required>
                            <input class="plus-minus-button" type="button" onclick="plusButtonBuy()" value="+"> <br>
                            <p> Total price: </p>
                            <p id="totalprice" style="font-weight: bold;"> Rp 10000 </p>
                            <p> Address: </p>
                            <textarea style="resize:none;" rows="5" cols="100" name="alamat" placeholder="Insert your address" required></textarea> <br>
                            <button class="btn-add" type="submit"> <b> Buy </b> </button>
                        </form>
                        <button class="btn-cancel" type="submit" onclick="location.href = 'ChocoDetailUser.php'"> <b> Cancel </b> </button>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>