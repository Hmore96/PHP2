<?php 
include "funktionen.php";
ist_eingeloggt();

$errors = array();

$erfolg = false;

include "kopf.php";
//Prüfen ob Formular abgeschickt
if (!empty($_POST)){

    $sql_titel = escape($_POST["titel"]);
    $sql_kcal_pro_100 = escape($_POST["kcal_pro_100"]);
    $sql_menge = escape($_POST["menge"]);
    $sql_einheit = escape($_POST["einheit"]);



    if ( empty($sql_titel)) {
    $errors[] = "Bitte geben Sie einen Titel an";
    }
    else {
        $result = query("SELECT * FROM zutaten WHERE titel = '{$sql_titel}'");
        //überprüfen, ob es Zutat gibt
        $row = mysqli_fetch_assoc($result);
        if($row){
            $errors[] = "Zutat gibt es bereits";
        }
    }
    if ( empty($_POST["kcal_pro_100"])){
        $errors[] = "Bitte geben Sie die Kalorien an an";
    }
    if ( empty($_POST["menge"])){
        $errors[] = "Bitte geben Sie eine Menge an";
    }
    if ( empty($_POST["einheit"])){
        $errors[] = "Bitte geben Sie eine Einheit an";
    }

    if(empty($errors)){
        query("INSERT INTO zutaten SET titel = '{$sql_titel}',
        kcal_pro_100 = '{$sql_kcal_pro_100}',
        menge = '{$sql_menge}',
        einheit = '{$sql_einheit}'
        ");

        $erfolg= true;
    }
}


?>


<body>
    <h1>Neue Zutat anlegen</h1>

    <?php 
    foreach ($errors as $index => $error){
        echo "<li>{$error}</li>";
    }
    if($erfolg){

        echo "<p>Zutat wurde erfolgreich angelegt.</br><a href='zutaten_liste.php'>Zurück zur Liste</a></p>";
    }

    ?>
    <form action="zutaten_neu.php" method="post">
    <div>
        <label for="titel">Zutat:</label><br>
        <input type="text" name="titel" id="titel">
    </div>
    <div>
        <label for="kcal_pro_100">KCal/100:</label><br>
        <input type="number" name="kcal_pro_100" id="kcal_pro_100">
    </div>
    <div>
        <label for="menge">Menge:</label><br>
        <input type="number" name="menge" id="menge">
    </div>
    <div>
        <label for="einheit">Einheit:</label><br>
        <input type="text" name="einheit" id="einheit">
    </div>
    <br>
    <div>
        <button type="submit">Zutat anlegen</button>
    </div>

    </form>
</body>

<?php

include "fuss.php";

?>
</html>