<?php 

//Konfiguration für das Projekt
const MYSQL_HOST = "localhost";
const MYSQL_USER = "root";
const MYSQL_PASSWORT = "";
const MYSQL_DATENBANK = "php3";

//Setup-Code: nur verändertn, wenn du weißt, was du tust.
session_start();

function ist_eingeloggt() {
    if ( empty($_SESSION["eingeloggt"])) {
        //benutzer nicht eingeloggt -> umleiten zu login
        header("Location: login.php");
        exit;
    }
}

spl_autoload_register(
    function (string $klasse)  {
        // Projekt-spezifisches namespace prefix
        $prefix = "WIFI\\PHP3\\";

        // Basisverzeichnis von meinem Projekt
        $basis = __DIR__ . "/";

        // Wenn die Klasse das Prefix nicht verwendet, abbrechen
        // (wir sind nicht fürs Laden von Dateien anderer Projekte verantwortlich)
        $laenge = strlen($prefix);
        if (substr($klasse, 0, $laenge) !== $prefix ) {
            return;
        } 

        // Klasse ohne Prefix.

        $klasse_ohne_prefix = substr($klasse, $laenge);

        $datei = $basis . $klasse_ohne_prefix . ".php";
        $datei = str_replace("\\", "/", $datei);

        // Wenn die Datei existiert, einbinden.
        if (file_exists($datei)) {
            include $datei;
        }

    }
);