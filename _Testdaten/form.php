<?php
include "funktionen.php";
include "kopf.php";
$erfolg = false;
$errors[] = array();
$sql_flugangst = false;

//Prüfen ob das Formular abgeschicht wurde
if (!empty($_POST)){



    $sql_vorname = escape($_POST["vorname"]);
    $sql_nachname = escape($_POST["nachname"]);
    $sql_birthday = escape($_POST["birthday"]);

    if(isset($_POST["flugangst"])){
        $sql_flugangst = true;
    } 
    //$sql_flugangst = escape($_POST["flugangst"]);

    query("INSERT INTO passagiere SET
    Vorname = '{$sql_vorname}',
    Nachname = '{$sql_nachname}',
    Geburtsdatum = '{$sql_birthday}',
    Flugangst = '{$sql_flugangst}'
"
);
    $erfolg = true;
}

    //Erfolgsmeldung
    if ( $erfolg) {
        echo "<p>Passagier wurde erfolgreich angelegt.</p>";
    }


    ?>


<form action="form.php" method="post">
    <div>
        <label for="vorname">Vorname:</label>
        <input type="text" name="vorname" id="vorname" >
    </div>
    <div>
        <label for="nachname">Nachname:</label>
        <input type="text" name="nachname" id="nachname" >
    </div>
    <div>
        <label for="birthday">Geburtsdatum:</label>
        <input type="date" name="birthday" id="birthday" >
    </div>
    <div>
        <label for="flugangst">Flugangst? Wenn dies zutrifft bitte anklicken:</label>
        <input type="checkbox" name="flugangst" id="flugangst">
    </div>
    <div>
        <button type="submit">Passagier anlegen</button>
    </div>

    </form>