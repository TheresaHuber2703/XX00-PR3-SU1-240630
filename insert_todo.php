<?php

// Verbindungsparameter für die MySQL-Datenbank festlegen
$servername = "localhost";
$username = "root";
$password = "*Passwort*";
$dbname = "tododatabase";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formulardaten auslesen
    $bezeichnung = $_POST["bezeichnung"];
    $faelligkeit = $_POST["faelligkeit"];

    // SQL-Query zum Einfügen eines neuen To-Dos
    $sql = "INSERT INTO todo (bezeichnung, faelligkeit, status) VALUES ('$bezeichnung', '$faelligkeit',0)";
    //$sql = "INSERT INTO todo (bezeichnung, faelligkeit) VALUES ('$bezeichnung', '$faelligkeit')";


    // Überprüfen, ob das To-Do erfolgreich hinzugefügt wurde
    if ($conn->query($sql) === TRUE) {

        // Setzen einer Session-Variablen, um den Erfolg des Hinzufügens anzuzeigen
        //$_SESSION['success_message'] = "Neues To-Do erfolgreich hinzugefügt";

        // Weiterleitung zur ursprünglichen HTML-Seite
        header("Location: index.php");

        exit; // Wichtig, um sicherzustellen, dass das Skript nach der Umleitung beendet wird

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Datenbankverbindung schließen
$conn->close();



?>