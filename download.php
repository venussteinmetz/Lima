<?php
session_start();
$directory = "/home/ab247/public_html/s19_lima/files";
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

$file=$_GET["fileid"];
$owner = $_SESSION["user_id"];
$statement = $pdo->prepare("SELECT * FROM file WHERE file_id = ?");
$statement->execute(array($file));
while ($row = $statement->fetch()) {

    $mimetype=$row["mimetype"];
    $filetype = $row["filetype"];
}


if (empty($_GET["fileid"]))
{
    echo " keine Datei angegeben";
    die();
}
else
{
    $filename = $_GET["filename"];
}
$filepath = $directory."/".$filename.".".$owner.".".$filetype;


header("Content-disposition: attachment; filename=$filename");
header("Content-type: $mimetype");
readfile($filepath);

?>

