<?php
session_start();
$directory = "/home/ab247/public_html/s19_lima/files";
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$fileid=$_GET["del"];
$owner=$_SESSION["user_id"];
$statement = $pdo->prepare("SELECT * FROM file WHERE file_id = ?");
$statement->execute(array($fileid));
while ($row = $statement->fetch()) {
    $mimetype=$row["mimetype"];
    $filetype = $row["filetype"];
    $filename = $row["filename"];
}
// Löschen der Datei aus der Datenbank
$statement2 = $pdo->prepare("DELETE FROM file WHERE file_id = ?");
$statement2->execute(array($fileid));
//Löschen der Datei von dem Server
if (empty($filename))
{
    echo " keine Datei angegeben";
    die();
}
else
{
    echo "Die Datei wurde gelöscht";
    unlink($directory."/".$filename.".".$owner.".".$filetype);
    header("location:index.php");
}