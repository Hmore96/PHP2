<?php 

include "funktionen.php";
include "kopf.php";


?>
<main>
    <h1>
        Zutaten
    </h1>

<?php
    $result = mysqli_query($db, "SELECT * FROM zutaten ORDER BY titel ASC");

    //print_r($result);

    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
echo "<tr>";
echo "<th>Titel</th>";
echo "<th>Menge</th>";
echo "<th>KCAL/100</th>";


    echo "</tr>";
    echo "</thread>";

    echo "<tbody>";
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["titel"] . "</td>";
    echo "<td>" . $row["menge"] . "</td>";
    echo "<td>" . $row["kcal_pro_100"] . "</td>";


    echo "</tr>";

}
    echo "</tbody>";
 echo "</table>";

?>
</main>
<?php 


include "fuss.php";


?>