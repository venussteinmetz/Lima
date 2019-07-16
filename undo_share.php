<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

$usertodelete=$_GET["usertodelete"];
$fileid=$_GET["fileid"];


$statement2 = $pdo->prepare("SELECT access_id FROM access WHERE file_id =:file_id AND user_id=:user_id");
$statement2->bindParam(':file_id', $fileid);
$statement2->bindParam(':user_id', $usertodelete);
$statement2->execute();
while ($row2 = $statement2->fetch()) {
    $accessid = $row2["access_id"];

    $statement = $pdo->prepare("DELETE FROM access WHERE access_id = ?");
    $statement->execute(array($accessid));
    echo "Die Freigabe wurde gelöscht";

    $statement3 = $pdo->prepare("SELECT * FROM access WHERE file_id = ?");
    $statement3->execute(array($fileid));
    $result = $statement3->rowCount();

    $statement4 = $pdo->prepare("SELECT * FROM sharing WHERE file_id = ?");
    $statement4->execute(array($fileid));
    $result2 = $statement4->rowCount();

    //Wenn in beiden Tabellen die File_id nichtmehr existiert, wird der Access-Status wieder auf 0 zurückgesetzt
    if ($result == 0 AND $result2 == 0) {
        $status = 0;
        $stmt2 = $pdo->prepare("UPDATE file SET access_rights=:access_rights WHERE file_id=:file_id");
        $stmt2->bindParam(':access_rights', $status);
        $stmt2->bindParam(':file_id', $fileid);
        $stmt2->execute();
    }
}



?>