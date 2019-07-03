<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));


$currentuser=$_SESSION["user_id"];

$statement = $pdo->prepare("SELECT * FROM access WHERE user_id = ?");
$statement->execute(array($currentuser));
while ($row = $statement->fetch()) {
    $file = $row["file_id"];

    $statement2 = $pdo->prepare("SELECT * FROM file WHERE file_id = ?");
    $statement2->execute(array($file));
    while ($row2 = $statement2->fetch()) {

        echo($row2["filename"] . "." . "$owner" . "." . $row2["filetype"]);
            echo "<a href='https://mars.iuk.hdm-stuttgart.de/~ab247/s19_lima/download.php?filename=";
            echo $row2['filename'].".".$row2['filetype'];
            echo("&fileid=");
            echo($row2['file_id']."'>");


        echo(" Freigegeben von ");
        $sql3 = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
        $sql3->execute(array($row2["owner"]));

        while ($row3 = $sql3->fetch()) {
            echo($row3["eMail"]);
        }

    }
}
            ?>