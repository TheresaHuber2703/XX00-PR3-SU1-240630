<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do-Tool</title>
    <!-- Theresa Huber, 1133167,XX00-PR3-SU1-240630, Abgabedatum 13.02.2024 -->
</head>
<body>
    <h1>To-Do-Tool</h1>
    
    <!-- Formular zum Hinzufügen von To-Dos -->
    <form action="insert_todo.php" method="POST">
        <input type="text" name="bezeichnung" placeholder="Bezeichnung" required>
        <input type="date" name="faelligkeit" required>
        <button type="submit">Speichern</button>
    </form>

    <h2>To-Do-Liste</h2>
        
    <ul id="todo-list">
    <!-- Hier werden die To-Dos dynamisch eingefügt -->
        
        <?php
            
            // Verbindungsparameter für die MySQL-Datenbank festlegen
            $servername = "localhost";
            $username = "root";
            $password = "*Passwort*";
            $dbname = "tododatabase";
            
            // Verbindung zur Datenbank herstellen und in der Variable `$conn` speichern
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Verbindung überprüfen
            // Falls ein Fehler auftritt, wird das Skript mit einer Fehlermeldung beendet
            if ($conn->connect_error) {
                die("Verbindung fehlgeschlagen: " . $conn->connect_error);
            }
                           
            // SQL-Abfrage zum Abrufen aller Daten aus der Tabelle
            $sql = "SELECT id, bezeichnung, faelligkeit, status FROM todo";
            // Die Abfrage wird mit der Methode `query()`auf der Verbindungsinstanz `$conn`ausgeführt
            // und das Ergebnis wird in der Variable `$result`gespeichert
            $result = $conn->query($sql);
            
            // Tabelle erstellen und Daten ausgeben
            // Wenn keine Ergebnisse gefunden werden, wird eine entsprechende Meldugn ausgegeben.
            if ($result->num_rows > 0) { //Prüfung: Anzahl zurückgegebener Zeilen > 0

                echo "<table><tr><th>Bezeichnung</th><th>Fälligkeit</th><th>Status</th></tr>";
                // Daten aus jeder Zeile ausgeben
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    if ($row["status"] == 0) {
                        echo "<td>" . $row["bezeichnung"] . "</td>";
                        echo "<td>" . $row["faelligkeit"] . "</td>";
                        echo "<td>
                                <form action='change_status.php' method='POST'>
                                    <input type='checkbox' name='todo_status' value='".$row['id']."' onchange='this.form.submit()'".($row['status'] == 1 ? ' checked' : '').">
                                </form>
                            </td>";
                    }
                    else{
                        echo "<td><s>" . $row["bezeichnung"] . "</s></td>";
                        echo "<td><s>" . $row["faelligkeit"] . "</s></td>";
                        echo "<td>
                                <input type='checkbox' name='permanent_checkbox' value='1' checked disabled>
                            </td>";
                        echo "<td>
                            <form action='delete_todo.php' method='POST'>
                                <button type='submit' name='todo_delete' value='".$row['id']."'>Löschen</button>
                            </form>
                        </td>";
                    }
                    echo "</tr>";
                }
                // Hier wird das Ende der HTML-Tabelle ausgegeben, um die Tabelle abzuschließen
                echo "</table>";
            } else {
                echo "0 Ergebnisse gefunden";
            }

            // Verbindung schließen
            $conn->close();
            
        ?>

    </ul>
</body>
</html>