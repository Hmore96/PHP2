<?php 
    require "admin/funktionen.php";
    header("Content-Type: application/json");

    function fehler($message) {
        header("HTTP/1:1 404 not found");
        echo json_encode(array(
            "status" => 0,  //status gibt man meist mit, da man sich nicht in HTTP Code analysieren muss, dann erkennt man gleich amStatus ob es funktioniert hat
            "error" => $message
        ));
    }
    //GET-Parameter aus der request-uri

    $request_uri_ohne_get = explode("?", $_SERVER["REQUEST_URI"])[0];


    $teile = explode("/api/", $request_uri_ohne_get, 2 );
    $parameter = explode("/", $teile[1]);

    $api_version = ltrim(array_shift($parameter), "vV"); //kleines und großen V auf der LINKEN SEITE entfernen


    if(empty($api_version)) {
        fehler("Bitte geben Sie eine API-Version an.");

    }

    //leere Einträge aus Parameter-Array entfernen
     foreach ($parameter as $k => $v) {
        if (empty($v)) {
            unset($parameter[$k]);
        } else {
            $parameter[$k] = mb_strtolower($v);

        }
     }

      //Indizes neu zuordnen, falls mit doppelten Schrägstrichen aufgerufen wird.

      $parameter = array_values($parameter);

      if(empty($parameter)) {
        fehler("Nach der Version wurde keine Methode übergeben. Prüfen Sie Ihren Aufruf");
      }

     
        //ab hier spezifikationen je nach Anwendungsbedarf
        if($parameter[0] == "zutaten"){
            //Liste aller zutaten liefern zb
            $ausgabe = array(
                "status" => 1,
                "result" => array()
            );

            $result = query("SELECT* FROM zutaten Order by id ASC");
            while($row = mysqli_fetch_assoc($result)){
                $ausgabe["result"][] = $row;
            }

            echo json_encode($ausgabe);//Umwandlung eines Arrays in JSON
            exit;
        } elseif($parameter[0] == "rezepte") {
            
            if(!empty($parameter[1])){
                //ID wurde angegeben
                $ausgabe = array(
                    "status" => 1,
                    "result" => array()
    
                );

                $sql_rezepte_id = escape($parameter[1]);
                $result = query("SELECT* FROM rezepte WHERE id = '{$sql_rezepte_id}'");
                $rezept = mysqli_fetch_assoc($result);
                if(!$rezept){
                    fehler("Mit dieser ID wurde kein Rezept gefunden");
                }
                $ausgabe["result"] = $rezept;

                $result = query("SELECT id, benutzername, email FROM benutzer WHERE id = '{$rezept["benutzer_id"]}'");
                $ausgabe["benutzer"] = mysqli_fetch_assoc($result);

                $result = query("SELECT zutaten.* FROM zutaten_zu_rezepte JOIN zutaten 
                ON zutaten_zu_rezepte.zutaten_id = zutaten.id
                WHERE zutaten_zu_rezepte.rezepte_id = '{$sql_rezepte_id}'
                ORDER BY zutaten_zu_rezepte.id");
                
                

                $ausgabe["zutaten"] = array();
                while($zutat = mysqli_fetch_assoc($result)){
                    $ausgabe["zutaten"][] = $zutat;
                }
                
                echo json_encode($ausgabe);//Umwandlung eines Arrays in JSON
                exit;

            }


            $ausgabe = array(
                "status" => 1,
                "result" => array()

            );

            /*$result = query("SELECT* FROM zutaten Order by id ASC");
            while($row = mysqli_fetch_assoc($result)){
                $ausgabe["result"][] = $row;
            }*/

            echo json_encode($ausgabe);//Umwandlung eines Arrays in JSON
            exit;
        } else {
            fehler("Die Method '{$parameter[0]}' existiert nicht");
        }
      ?>

      