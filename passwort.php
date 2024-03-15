<?php 

    $db_passwort = "81dc9bdb52d04dc20036dbd8313ed055";
    $passwort = "haus";
    $salt = "köakkakak123";

    if ($db_passwort == md5($passwort)) {
        echo "Passwort ist korrekt";
    echo "</br>";
    
    }

    echo $passwort;
    echo "</br>";
    echo md5($passwort);
    echo "</br>";
    echo md5($passwort.$salt);

    echo "</br>";
   $pw_hash =  password_hash($passwort, PASSWORD_DEFAULT);
   echo $pw_hash;
   echo "</br>";



   if (password_verify($passwort, $pw_hash)) {
        echo "Passwort korrekt!";
    } else {
        echo "Passwort stimmt nicht überein";
    }

    

    