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
    $statement2 = $pdo->prepare("SELECT * FROM fileinfolders WHERE file_id = ?");
    $statement2->execute(array($fileid));
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
        echo "Datei wurde in den Ordner $foldername verschoben";

        //Sobald eine Datei in einen Ordner gespeichert wurde, ändert sich der file_code auf 1. Dies dient der Überprüfung, ob der Ordner leer ist oder nicht.
        $status = 1;
        $stmt1 = $pdo->prepare("UPDATE folders SET file_code=:file_code WHERE folder_id=:folder_id");
        $stmt1->bindParam(':file_code', $status);
        $stmt1->bindParam(':folder_id', $folderid);
        $stmt1->execute();
    }



}

?>