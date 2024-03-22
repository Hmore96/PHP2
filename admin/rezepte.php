<?php 
include "funktionen.php";
ist_eingeloggt();
include "kopf.php";
?>


<main>
<h1>Rezepte</h1>
<a href="rezepte_neu.php">Rezept hinzufügen</a>

<?php
    $result = query("SELECT rezepte.*, benutzer.benutzername FROM rezepte JOIN benutzer ON rezepte.benutzer_id = benutzer.id
     ORDER BY rezepte.titel ASC");

    //print_r($result);

    echo "<table border='1'>";

    echo "<thread>";
    echo "<tr>";
    echo "<tr>";
    echo "<th>Titel</th>";
    echo "<th>Beschreibung</th>";
    echo "<th>Benutzername</th>";
    echo "<th>Aktionen</th>";
  

    


    echo "</tr>";
    echo "</thread>";

    echo "<tbody>";
    while($row = mysqli_fetch_assoc($result)) {

    echo "<tr>";
    echo "<td>" . $row["titel"] . "</td>";
    echo "<td>" . $row["beschreibung"] . "</td>";
    echo "<td>" . $row["benutzername"] . "</td>";
    echo "<td>" .
    "<a href='rezepte_bearbeiten.php?id={$row["id"]}'>bearbeiten</a>". " " .
    "<a href='rezepte_bearbeiten.php?id={$row["id"]}'>entfernen</a>". "</td>";



    echo "</tr>";

}
    echo "</tbody>";
    echo "</table>";

?>
</main>