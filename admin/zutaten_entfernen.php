<?php 

include "funktionen.php";
ist_eingeloggt();

include "kopf.php";

echo "<h1>Zutat entfernen</h1>";
$sql_id = escape($_GET["id"]);

if (! empty($_GET["doit"])){
    query("DELETE FROM zutaten WHERE id = '{$sql_id}'");
    echo "<p>Zutat wurde erfolgreich entfernt.</br><a href='zutaten_liste.php'>Zurück zur Liste</a></p>";
}
else {

    $result = query("SELECT * FROM zutaten WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);
    $result2 = query("SELECT * FROM zutaten_zu_rezepte WHERE zutaten_id = '{$sql_id}'");
    $ist_mit_rezepte_verknüft = mysqli_fetch_assoc($result2);

if ( empty($row)) {
    echo "<p>Zutat exisitert nicht (mehr)</p>". "<br>" .
   "<a href='zutaten_liste.php'>Zurück zur Liste</a></p>";
}

//prüfen ob in Rezept vorkommt
else if ($ist_mit_rezepte_verknüft) {
    echo "<p>Die Zutat <strong>" . htmlspecialchars($row["titel"]) ."</strong>wird noch in einem Rezept verwendet und kann daher nicht verwendet werden</p>";
     echo "<a href='zutaten_liste.php'>Zurück zur Liste</a></p>";
}


else {
    echo "<p>
        Sind Sie sicher dass Sie die zutat <strong>" . htmlspecialchars($row["titel"]). "</strong> entfernen möchten? 
    </p>";
    echo "<p>" . 
    "<a href='zutaten_liste.php'>Nein, abbrechen.<a/><br>
    <a href='zutaten_entfernen.php?id={$row['id']}&amp;doit=1'>Ja, sicher.<a/>"
    . "</p>";
}

}


include "fuss.php";