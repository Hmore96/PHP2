<?php 
include "kopf.php";
include "funktionen.php";



$sql_id = escape($_GET["id"]);
$sql_flugangst = false;


if (!empty($_POST)){



    $sql_vorname = escape($_POST["vorname"]);
    $sql_nachname = escape($_POST["nachname"]);
    $sql_birthday = escape($_POST["birthday"]);

    if(isset($_POST["flugangst"])){
        $sql_flugangst = true;
    } 
    //$sql_flugangst = escape($_POST["flugangst"]);

    query("UPDATE passagiere SET
    Vorname = '{$sql_vorname}',
    Nachname = '{$sql_nachname}',
    Geburtsdatum = '{$sql_birthday}',
    Flugangst = '{$sql_flugangst}'
    WHERE id = '{$sql_id}'
"
);

}

$result = query("SELECT * FROM passagiere WHERE id = '{$sql_id}'");
    $row = mysqli_fetch_assoc($result);

?>
   <form action="passagiere_bearbeiten.php?id=<?php echo $row["id"]?>" method="post">
    <div>
        <label for="vorname">Vorname:</label>
        <input type="text" name="vorname" id="vorname" value="">
    </div>
    <div>
        <label for="nachname">Nachname:</label>
        <input type="text" name="nachname" id="sql_nachname" value="" >
    </div>
    <div>
        <label for="birthday">Geburtsdatum:</label>
        <input type="date" name="birthday" id="sql_birthday" value="">
    </div>
    <div>
        <label for="flugangst">Flugangst? Wenn dies zutrifft bitte anklicken:</label>
        <input type="checkbox" name="flugangst" id="flugangst">
    </div>
    <div>
        <button type="submit">Passagier anlegen</button>
    </div>

    </form>