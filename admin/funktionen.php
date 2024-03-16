<?php
//notwenidg, um auf die $_session zur Verfügung zu haben.
session_start();

 $db = mysqli_connect("localhost", "root","","php2");
 //MySQLI mitteilen, dass unsere Befehle als utf8 kommen

 mysqli_set_charset($db, "utf8");



 function query ($sql_befehl){
   global $db;
   $result = mysqli_query($db, $sql_befehl);

   return $result;
 }

 function escape($post_var) {
    global $db;
    return mysqli_real_escape_string($db, $post_var);

 }

 function ist_eingeloggt(){
    if (empty ($_SESSION["eingeloggt"])) {
        header("LOCATION: login.php");
        exit; //damit der teil darunter nicht mehr zum Browser geschickt wird.
        
    }
 }