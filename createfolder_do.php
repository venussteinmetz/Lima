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
            font-family: 'Poppins', sans-serif;
            font-size: medium;
            position: absolute;
            margin-top: 90px;
            margin-right: 10px;
            left:300px;
            width:50%;
        }
        #file{
            position: relative;
            top: 50%;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
            color: black;
        }
        #file:hover {
            background-color: lightcoral;
            text-decoration: none;
        }
    </style>

</head>
<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$foldername=$_POST["foldername"];
$owner=$_SESSION["user_id"];
//Es wird überprüft, ob der Ordnername bereits existiert bei dem Nutzer, der den Ordner erstellt hat. Wenn dies der Fall ist wird eine Fehlermeldung ausgegeben.
$statement = $pdo->prepare("SELECT * FROM folders WHERE folder_name = ? AND owner = $owner");
$statement->execute(array($foldername));
while ($row = $statement->fetch()) {
    if ($row !== false) {
        echo 'Dieser Ordnername existiert bereits. Bitte wähle einen anderen Namen!';
        die();
    }
}
?>
<div id="ausgabe">
<?php
//Beim Erstellen eines neuen Ordners, wird der file_code auf 0 gesetzt. Dies bedeutet, dass noch keine Datei in dem Ordner gespeichert ist.
$status = 0;
$stmt = $pdo->prepare("INSERT INTO folders (folder_id, owner, folder_name, file_code) VALUES('',$owner,:foldername, :filecode)");
$stmt ->bindParam('foldername', $foldername);
$stmt ->bindParam('filecode', $status);
$stmt ->execute();
echo "Ordner wurde erstellt!<br><br><a href=showfolder.php><button id='file'>Zu meinen Ordnern</button></a> <a href=index.php><button id='file'>Zurück zur Startseite</button></a>";
exit();
?>
