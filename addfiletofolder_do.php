<?php
include "searchbar.php";
include "sidebar2.php";
?>
<html>
<head>
    <title>Lima</title>
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script src="js/general.js"></script>
    <style>
        #ausgabe {
            font-family: Avenir;
            font-size: medium;
            position: absolute;
            margin-top: 90px;
            margin-right: 10px;
            left:300px;
            width:50%;
        }
        #folder {
            color: black;
            position: absolute;
            margin-top: 200px;
            left:300px;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        #folder:hover {
            background-color: lightcoral;
        }
        #index {
            color: black;
            position: absolute;
            margin-top: 180px;
            left:500px;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        #index:hover {
            background-color: lightcoral;
    </style>
<body>
<a href=showfolder.php><button id="folder">Zu meinen Ordnern</button></a> <br>
<a href=index.php><button id="index">Zurück zur Startseite</button></a>
<div id="ausgabe">
    <?php
    session_start();
    $pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
    $owner = $_SESSION["user_id"];
    $foldername = $_GET["foldername"];
    $folderid = $_GET["folder_id"];
    $filename = $_POST["file"];
    $statement = $pdo->prepare("SELECT * FROM file WHERE filename = ?");
    $statement->execute(array($filename));
    while ($row = $statement->fetch()) {
        $fileid = $row["file_id"];
        // Es wird überprüft, ob die Datei bereits in dem Ordner ist. Wenn dies der Fall ist, wird eine Fehlermeldung ausgegeben.
        $statement2 = $pdo->prepare("SELECT * FROM fileinfolders WHERE file_id = ? AND folder_id=?");
        $statement2->execute(array($fileid, $folderid));
        while ($row2 = $statement2->fetch()) {
            if ($row2 !== false) {
                echo 'Diese Datei befindet sich bereits in dem Ordner';
                die();
            }
        }
        $stmt = $pdo->prepare("INSERT INTO fileinfolders (fileinfolders_id, file_id, folder_id, owner) VALUES('',:file_id,:folder_id, :owner)");
        $stmt->bindParam(':file_id', $fileid);
        $stmt->bindParam(':folder_id', $folderid);
        $stmt->bindParam(':owner', $owner);
        if ($stmt->execute()){
            echo "Datei wurde in den Ordner $foldername verschoben" ;
            die();
            //Sobald eine Datei in einen Ordner gespeichert wurde, ändert sich der file_code auf 1. Dies dient der Überprüfung, ob der Ordner leer ist oder nicht.
            $status = 1;
            $stmt1 = $pdo->prepare("UPDATE folders SET file_code=:file_code WHERE folder_id=:folder_id");
            $stmt1->bindParam(':file_code', $status);
            $stmt1->bindParam(':folder_id', $folderid);
            $stmt1->execute();
        }
    }
    ?>
</div>


</body>
</html>
