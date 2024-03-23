<?php
include "funktionen.php";
include "kopf.php";
?>
    <h1>Alle Flüge</h1>


    <?php 
        //Zeit wird in Variabel gespeichert um sie zu vergleichen unten in if
        $time = date("Y-m-d H:i:s");
        $result = query("SELECT * FROM fluege ORDER BY abflug ASC");
    ?>

  <?php

echo "<table border='1'>";

    echo "<thread>";
        echo "<tr>";
            echo "<th>Flugnummer</th>";
            echo "<th>Departure</th>";
            echo "<th>Arrives</th>";
            echo "<th>Departure Airport</th>";
            echo "<th>Arrival Airport</th>";
        echo "</tr>";   
    echo "</thread>";
    echo "<tbody>";
    //überprüfen, ob die ankunft größer als die aktuelle Zeit ist, um die Zeit die flüge zu filtern die noch aktiv sind  
       while ($row = mysqli_fetch_assoc($result)) {
        if ($row["ankunft"] >= $time) {
      echo "<div class='row font-weight-bold border-bottom text-center'>";
      echo "<td class='col-3'>". $row["flugnr"] ."</td>";
      echo "<td>". $row["abflug"] ."</td>";
      echo "<td class='col-3'>". $row["ankunft"] ."</td>";
      echo "<td class='col-2'>". $row["start_flgh"] ."</td>";
      echo "<td class='col-2'>". $row["ziel_flgh"] ."</td>";
      echo "</div>";
      echo "</tr>";
        } }
    echo "</tbody>";
echo "</table>";
    


  ?>

<?php
include "fuss.php";
?>
