<?php 
include "funktionen.php";
    //print_r($_POST);
    if(! empty($_POST)){
        //validierung
        if(empty($_POST["benutzername"]) || empty($_POST["passwort"])) {
            $error = "Benutzername oder Passwort ist falsch.";
        } else {
            //Benutzername und passwort werden erfolgreich übergeben
            // -> in der Datenbank nachsehen ob Benutzer existiert

                //diese Funktion bewahrt vor sqlinjection 
        $sql_benutzername =  mysqli_real_escape_string($db, $_POST["benutzername"]);

             $result = query("SELECT * FROM benutzer WHERE benutzername = '{$sql_benutzername}'");
             //print_r($result);
//Datzensatz mit Passwort abgleichen
            $row = mysqli_fetch_assoc($result);
             //print_r($result);

             if ($row) {
                //Benutzer existiert -> PW prüfen
                //echo "<br>";
                //echo $row['passwort'];

                if(password_verify($_POST["passwort"],  $row["passwort"])) {
                    //echo "ist eingeloggt";

                    $_SESSION["eingeloggt"] = true;
                    $_SESSION["benutzername"] = $row["benutzername"];
                    $_SESSION["benutzer_id"] = $row["id"];

                    //Anzahl Logins in der DB speichern
                   query("UPDATE benutzer SET anzahl_logins = anzahl_logins + 1,
                    letzter_login = NOW()
                     WHERE id = {$row["id"]}");





                    //Umleitung von Admin-System 
                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Benutzername oder Passwort sind falsch";
                }
             } else {
                $error = "Benutzername oder Passwort sind falsch";
            }


        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Loginbereich zur Rezepteverwaltung</h1>

    <?php 
    if (!empty($error)){
        echo "<p>".  $error . "</p>";
    }
    ?>
    <form action="login.php" method="post">
    <div>
        <label for="benutzername">Benutzername:</label>
        <input type="text" name="benutzername" id="benutzername">
    </div>
    <div>
        <label for="passwort">Passwort:</label>
        <input type="password" name="passwort" id="passwort">
    </div>
    <div>
        <button type="submit">Einloggen</button>
    </div>

    </form>
</body>
</html>