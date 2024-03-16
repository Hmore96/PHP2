<?php 

include "funktionen.php";
ist_eingeloggt();
include "kopf.php";


?>
    <h1>Zutaten</h1>
    <a href="zutaten_neu.php">Zutat hinzufügen</a>
<?php

?>

<main>

<?php
    $result = query("SELECT * FROM zutaten ORDER BY titel ASC");

    //print_r($result);

    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
    echo "<tr>";
    echo "<th>Titel</th>";
    echo "<th>Menge</th>";
    echo "<th>Einheit</th>";
    echo "<th>KCAL/100</th>";


    echo "</tr>";
    echo "</thread>";

    echo "<tbody>";
    while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["titel"] . "</td>";
    echo "<td>" . $row["menge"] . "</td>";
    echo "<td>" . $row["einheit"] . "</td>";
    echo "<td>" . $row["kcal_pro_100"] . "</td>";
    echo "<td>" .
    "<a href='zutaten_bearbeiten.php?id={$row["id"]}'>bearbeiten</a>". " " .
    "<a href='zutaten_entfernen.php?id={$row["id"]}'>entfernen</a>". "</td>";



    echo "</tr>";

}
    echo "</tbody>";
    echo "</table>";

?>
</main>
<?php 


include "fuss.php";


?>