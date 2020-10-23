<?php 

    include 'configDB.php';

    $content_per_page = 3;
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $start = ($page>1) ? ($page * $content_per_page) - $content_per_page : 0;

    $sql = "SELECT * FROM coklat";
    $result = mysqli_query($conn, $sql);
    $total_row = mysqli_num_rows($result);

    $total_page = ceil($total_row/$content_per_page);

    $sql2 = "SELECT * FROM coklat LIMIT $start, $content_per_page";
    $result2 = mysqli_query($conn, $sql2);
    

    while ($row = mysqli_fetch_assoc($result2)) {

        echo "<center>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>".$row["nama"]."</td>";
        echo "<td> Price: ".$row["price"]."</td>";
        echo "</tr>";
        echo "</table>";
        echo "<br>";
        echo "</center>";

    }
?>
<br>
<center> <div>
    <?php 
    
        for($i=1; $i<=$total_page; $i++) {
            echo "<a href='?page=$i'>".$i."</a>";
        }
    ?>
</div> </center>