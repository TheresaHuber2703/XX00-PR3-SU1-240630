<?php
    // Verbindung zur Datenbank herstellen
    $servername = "localhost";
    $username = "root";
    $password = "Na4p02e&!2402";
    $dbname = "tododatabase";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Überprüfen, ob die Anfrage vom POST-Formular gesendet wurde
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ID aus dem POST-Daten abrufen
        $id = $_POST["todo_delete"];

        // SQL-Update-Query ausführen, um das To-Dos zu löschen
        $sql = "DELETE FROM todo WHERE id = $id";
        $result = $conn->query($sql);

        // Überprüfen, ob die Abfrage erfolgreich war
        if ($result) {
            header("Location: index.php");
            exit;
        } else {
            echo "Fehler beim Aktualisieren des Status: " . $conn->error;
        }
    }
?>