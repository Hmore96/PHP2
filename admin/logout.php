<?php 
session_start();

//unset($_SESSION["eingeloggt"]);

//session_unset();


//vernichtet die Session mit Cookies

session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout aus dem Rezepte-Adminbereich</title>
</head>
<body>
    <h1>Logout aus dem Rezepte-Adminbereich</h1>
    <p>Sie wurden ausgeloggt</p>
    <p><a href="login.php">Hier gehts zurück zum Loginbereich</p>

</body>
</html>