<?php 

include "kopf.php";
include "funktionen.php";

?>

<h1>Passagierliste</h1>

<?php

    $result = query("SELECT * FROM passagiere ORDER BY Nachname ASC");

echo "<table border='1'>";

    echo "<thread>";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Vorname</th>";
            echo "<th>Nachname</th>";
            echo "<th>Geburtsdatum</th>";
            echo "<th>Flugangst</th>";

        echo "</tr>";   
    echo "</thread>";
    echo "<tbody>";
    //überprüfen, ob die ankunft größer als die aktuelle Zeit ist, um die Zeit die flüge zu filtern die noch aktiv sind  
       while ($row = mysqli_fetch_assoc($result)) {
       
      echo "<div class='row font-weight-bold border-bottom text-center'>";
      echo "<td class='col-3'>". $row["id"] ."</td>";
      echo "<td>". $row["Vorname"] ."</td>";
      echo "<td class='col-3'>". $row["Nachname"] ."</td>";
      echo "<td class='col-2'>". $row["Geburtsdatum"] ."</td>";
      echo "<td class='col-2'>". $row["Flugangst"] ."</td>";
      echo "<td>" .
      "<a href='passagiere_bearbeiten.php?id={$row["id"]}'>bearbeiten</a>". " " .
      "<a href='passagiere_entfernen.php?id={$row["id"]}'>entfernen</a>". "</td>";
     
      echo "</div>";
      echo "</tr>";
         }
    echo "</tbody>";
echo "</table>";

