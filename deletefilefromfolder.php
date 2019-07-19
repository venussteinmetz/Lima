<?php
include 'sidebar2.php';
include "searchbar.php";
?>
    <html>
    <head>
        <style>
            #geloescht {
                position: absolute;
                left: 300px;
                top:90px;
            }
            #folderdel {
                position: relative;
                top: 50%;
                width: 173px;
                border-radius: 4px;
                background-color: lightpink;
                color: black;
            }
            #folderdel:hover {
                background-color: lightcoral;
            }

        </style>
    </head>
    <body>


<div id="geloescht">
        <?php
        session_start();
        $pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

        $file = $_GET["fileid"];
        $folderid = $_GET["folderid"];

        $statement = $pdo->prepare("DELETE FROM fileinfolders WHERE file_id = ?");
        $statement->execute(array($file));

        //Hier wird überprüft, ob nach dem Löschen einer Datei noch weitere Dateien im Ordner vorhanden sind.
        $statement2 = $pdo->prepare("SELECT * FROM fileinfolders WHERE folder_id = ?");
        $statement2->execute(array($folderid));
        $result = $statement2->rowCount();

        //Wenn keine weiteren Dateien im Ordner vorhanden sind, dann wird der file_code wieder auf 0 gesetzt. Dies bedeutet, dass der Ordner leer ist.
        if ($result == 0) {
            $status = 0;
            $stmt2 = $pdo->prepare("UPDATE folders SET file_code=:file_code WHERE folder_id=:folder_id");
            $stmt2->bindParam(':file_code', $status);
            $stmt2->bindParam(':folder_id', $folderid);
            $stmt2->execute();
        }

        echo "Datei wurde aus dem Ordner gelöscht!<br><br><a href=showfolder.php><button id='folderdel' >Zurück zu Ordner</button></a> <a href=index.php><button id='folderdel'>Zurück zur Startseite</button></a>";
        ?>
</div>
</body>
 </html>

