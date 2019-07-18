<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

$folderid= $_GET["folderid"];


$statement = $pdo->prepare( "DELETE FROM folders WHERE folder_id=:folderid");
$statement ->bindParam('folderid', $folderid);
$statement->execute();
echo "Ordner wurde gelöscht";

?>