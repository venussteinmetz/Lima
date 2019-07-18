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

echo "Datei wurde aus dem Ordner gelöscht!"
?>