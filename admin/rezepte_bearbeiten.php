<?php 
include "funktionen.php";
ist_eingeloggt();

$errors = array();

$erfolg = false;

$sql_id = escape($_GET["id"]);

include "kopf.php";
//Prüfen ob Formular abgeschickt

print_r($_POST);


?>
<?php 
if (!empty($_POST)){

    $sql_titel = escape($_POST["titel"]);
    $sql_beschreibung = escape($_POST["beschreibung"]);
    $sql_benutzer_id = escape($_POST["benutzer_id"]);


    if (empty($sql_titel)) {
    $errors[] = "Bitte geben Sie einen Namen für das Rezept an an";
    }
    else {
        $result = query("SELECT * FROM rezepte WHERE titel = '{$sql_titel}'");
        //überprüfen, ob es Zutat gibt
        $row = mysqli_fetch_assoc($result);
        if($row){
            $errors[] = "Rezept gibt es bereits";
        }
    }
    if ( empty($_POST["beschreibung"])){
        $errors[] = "Bitte geben Sie eine Beschreibung an";
    }


    if(empty($errors)){
        query("INSERT INTO rezepte SET titel = '{$sql_titel}',
        beschreibung = '{$sql_beschreibung}',
        benutzer_id = '{$sql_benutzer_id}'
        WHERE id = '{$sql_id}'
        ");

    $neue_rezepte_id = mysqli_insert_id($db);
        foreach ($_POST["zutaten_id"] as $zutatNr) {
            if (empty($zutatNr)) continue;
    $sql_zutaten_id = escape($zutatNr);

    query("INSERT INTO zutaten_zu_rezepte SET
    zutaten_id = '{$sql_zutaten_id}',
    rezepte_id =  '{$neue_rezepte_id}'
    ");
        }





        $erfolg= true;
    }
}


?>


    <h1>Neues Rezept anlegen</h1>

    <?php 
    foreach ($errors as $index => $error){
        echo "<li>{$error}</li>";
    }
    if($erfolg){

        echo "<p>Rezept wurde erfolgreich angelegt.</br><a href='rezepte.php'>Zurück zur Liste</a></p>";
    }

    ?>
    

    <form action="rezepte_bearbeiten.php?=" method="post">
    <div>
        <label for="benutzer_id">Benutzer:</label><br>
        <select name="benutzer_id">
       <br><?php 
        $user_result = query("SELECT id,benutzername FROM benutzer ORDER BY benutzername ASC");
        while ($user = mysqli_fetch_assoc($user_result)) {
            echo "<option value='{$user["id"]}'"; 
            if (empty($_POST["benutzer_id"]) && $user["id"] == $_SESSION["benutzer_id"]) {
                echo " selected";
            } elseif (empty("benutzer_id") && $user["id"] == $_SESSION["benutzer_id"]){
                echo " selected";
            }
            echo ">{$user["benutzername"]}</option>";
        }
        ?>
        </select>


        
    </div>
    <div>
        <label for="titel">Titel:</label>
        <input type="text" name="titel" id="titel" <?php 
        if(!empty($_POST["titel"]) && !$erfolg) {
            echo htmlspecialchars($_POST["titel"]);
        }
        ?>/>
    </div>
    <div>
        <label for="beschreibung">Beschreibung:</label><br>
        <textarea name="beschreibung" id="beschreibung">
        <?php 
        if(!empty($_POST["beschreibung"]) && !$erfolg) {
            echo htmlspecialchars($_POST["beschreibung"]);
        }
        ?>
        </textarea>
    </div>

    <div class="zutatenliste">

        <?php 
        $bloecke = 1;
        $result = query("SELECT* FROM zutaten_zu_rezepte WHERE rezepte_id = '{$sql_id}' ORDER BY id ASC");
        $bloecke = mysqli_num_rows($result);
        if($bloecke < 1 ) $bloecke = 1;
                for ($i=0; $i < $bloecke; $i++) {
        ?>

                <div class="zutatenblock">

                
        <lable for="zutaten_id">Zutat:</lable>
        <select name="zutaten_id[]" id="zutaten_id">
            <option>-----Bitte Wählen------</option>
            <?php $zutaten_result = query("SELECT * FROM zutaten ORDER BY titel ASC");
            while ($zutaten = mysqli_fetch_assoc($zutaten_result)) {
                echo "<option value='{$zutaten["id"]}' ";
                echo ">{$zutaten["titel"]}</option>";
            }

                    ?>
                        </select>
                    
                </div>
        <?php } 
        ?>

    </div>

        <a class="zutat-neu" href="#" onclick="neueZutat();">aaa</a>

        <div>
        <button type="submit">Rezept anlegen</button>
        </div>

    </form>


<?php

include "fuss.php";

