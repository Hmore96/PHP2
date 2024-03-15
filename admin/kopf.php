<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezepte-Verw.-Administrationsbereich</title>

    <style>
        body {
            margin: 0px;
            background: #ccd5ae;
            color: #fefae0;
            text-align: center;
        }
        .row {background: #d4a373};
    </style>
</head>
<body>
    <nav>
        <ul class="row">
            <li><a href="index.php">Start</li>
            <li><a href="zutaten_liste.php">Zutaten</li>
            <li><a href="logout.php">ausloggen</a> Eingeloggt als: <?php echo $_SESSION["benutzername"]?></li>
            <li></li>
        </ul>
    </nav>
