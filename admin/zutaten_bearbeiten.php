<?php 
include "funktionen.php";
ist_eingeloggt();

$erfolg = false;

$sql_id = escape($_GET["id"]);

if(!empty($_POST)) {
    $sql_titel = escape($_POST["titel"]);
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);
    $sql_menge = escape($_POST["menge"]);
    $sql_einheit = escape($_POST["einheit"]);

    if ( empty($sql_titel)) {
        $errors[] = "Bitte geben Sie einen Titel an";
        }
    else {
        //Überprüfen ob die Zutat bereits existiert
        $result = query("SELECT * FROM zutaten WHERE titel = '{$sql_titel}' AND id!= {$sql_id}");
        //überprüfen, ob es Zutat gibt
        $row = mysqli_fetch_assoc($result);
        if($row){
            $errors[] = "Zutat gibt es bereits";
        }
    }
    if(empty($errors)){
        query("UPDATE zutaten SET titel = '{$sql_titel}',
        kcal_pro_100 = '{$sql_kcal_pro_100}',
        menge = '{$sql_menge}',
        einheit = '{$sql_einheit}'
        WHERE id = '{$sql_id}'
        ");

        $erfolg = true;
    }


    //validierung der Felder
    
}



$result = query("SELECT * FROM zutaten WHERE id = '{$sql_id}'");
$row = mysqli_fetch_assoc($result);

include "kopf.php";

if($erfolg){

    echo "<p>Zutat wurde erfolgreich bearbeitet.</br><a href='zutaten_liste.php'>Zurück zur Liste</a></p>";
}

?>

<h1>Neue Zutat anlegen</h1>
<?php
if(!empty($errors)){
   foreach ($errors as $index => $error){
        echo "<li>{$error}</li>";
    }
}

if ($erfolg == true){
    echo "Zutat erfolgreich geändert";
}

    ?>



<form action="zutaten_bearbeiten.php?id=<?php echo $row["id"] ?>" method="post">
<div>
    <label for="titel">Zutat:</label><br>
    <input type="text" name="titel" id="titel" value="<?php  if(!$erfolg && !empty($_POST["titel"]))  {
        echo htmlspecialchars($_POST["titel"]);
    }
        else {
         echo htmlspecialchars($row["titel"]);
    }
    
    ?>"/>
    
</div>
<div>
    <label for="kcal_pro_100">KCal/100:</label><br>
    <input type="number" name="kcal_pro_100" id="kcal_pro_100" value="<?php  if(!$erfolg && !empty($_POST["kcal_pro_100"]))  {
        echo htmlspecialchars($_POST["kcal_pro_100"]);
    }
        else {
         echo htmlspecialchars($row["kcal_pro_100"]);
    }
    
    ?>"/>
</div>
<div>
    <label for="menge">Menge:</label><br>
    <input type="number" name="menge" id="menge" value="<?php  if(!$erfolg && !empty($_POST["menge"]))  {
        echo htmlspecialchars($_POST["menge"]);
    }
        else {
         echo htmlspecialchars($row["menge"]);
    }
    
    ?>">
</div>
<div>
    <label for="einheit">Einheit:</label><br>
    <input type="text" name="einheit" id="einheit" value="<?php  if(!$erfolg && !empty($_POST["einheit"]))  {
        echo htmlspecialchars($_POST["einheit"]);
    }
        else {
         echo htmlspecialchars($row["einheit"]);
    }
    
    ?>">
</div>
<br>
<div>
    <button type="submit">Zutat speichern</button>
</div>

</form>