<?php
include "funktionen.php";


include "kopf.php";

echo "<h1>Passagier entfernen</h1>";
$sql_id = escape($_GET["id"]);

query("DELETE FROM passagiere WHERE id = '{$sql_id}'");
echo "<p>Passagier wurde erfolgreich entfernt.<br>
<a href='passagiere.php'>Zurück zur Passagier-Liste</a>
</p>";

