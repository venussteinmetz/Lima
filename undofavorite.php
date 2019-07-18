<?php

session_start();

$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

$undo = 0;
$fileid= $_GET["undofav"];

$statement = $pdo -> prepare ('UPDATE file SET favorite=:favorite WHERE file_id =:file_id');
$statement->bindParam(':favorite', $undo );
$statement->bindParam(':file_id', $fileid);
if ($statement->execute()) {

    echo "Die Datei ist nicht mehr unter deinen Favoriten :( ";
    }


    ?>
