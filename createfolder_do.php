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

//Beim Erstellen eines neuen Ordners, wird der file_code auf 0 gesetzt. Dies bedeutet, dass noch keine Datei in dem Ordner gespeichert ist.
$status = 0;
$stmt = $pdo->prepare("INSERT INTO folders (folder_id, owner, folder_name, file_code) VALUES('',$owner,:foldername, :filecode)");
$stmt ->bindParam('foldername', $foldername);
$stmt ->bindParam('filecode', $status);
$stmt ->execute();

echo "Ordner wurde erstellt.";
exit();
?>