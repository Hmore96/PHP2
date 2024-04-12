<?php
include "setup.php";

use WIFI\PHP3\Klassen\Validieren;
use WIFI\PHP3\Klassen\Mysql;

//wurde das Formular abgeschickt?
//print_r($_POST);
if (! empty($_POST)){
    //Validierung
    $validieren = new Validieren();
    $validieren->ist_ausgefuellt($_POST["benutzername"], "Benutzername");
    $validieren->ist_ausgefuellt($_POST["passwort"], "Passwort");

    if (!$validieren->fehler_aufgetreten()) {
        //weiter mit einloggen
        $db  = new Mysql();
        $sql_benutzername = $db->escape($_POST["benutzername"]);
        $ergebnis = $db->query("SELECT * FROM benutzer WHERE benutzername = '{$sql_benutzername}'");
        $benutzer = $ergebnis->fetch_assoc();
        //echo "<pre>"; print_r($benutzer); echo "</pre>";
        if (empty($benutzer) || !password_verify($_POST["passwort"], $benutzer["passwort"])) {
            //fehler: Benutzer existiert nicht
            $validieren->fehler_hinzu("Benutzer oder Passwort war falsch.");
        } else {
            //Alles war OK -> Login in Session merken
            $_SESSION["eingeloggt"] = true;
            $_SESSION["benutzername"] = $benutzer["benutzername"];
            $_SESSION["benuter_id"] = $benutzer["id"];

            // Umleitung zum Admin-System
            header("Location: index.php");
            exit;

        }
            
        
    }

}

    
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginbereich zur Fahrzeug-DB</title>
</head>
<body>
    <h1>Loginbereich zur Fahrzeug-DB</h1>
    <?php
    if (!empty($validieren)) {
        echo $validieren->fehler_html();
    }
    ?>
    <form   action="login.php" method="post">
        <div>
            <label for="benutzername">Benutzername:</label>
            <input type="text" name="benutzername" id="benutzername" />
        </div>
        <div>
            <label for="passwort">Passwort:</label>
            <input type="password" name="passwort" id="passwort" />
        </div>
        <div>
            <button type="submit">Einloggen</button>
        </div>
    </form>
</body>
</html>
