<?php
include 'sidebar2.php';
include "searchbar.php";
include 'profilepicture.php';
include 'notifications.php';
?>
<html>
<title>Lima</title>
<head>
    <style>
        #undoshare {
            position: absolute;
            top: 80px;
            left: 300px;

        }
        #undo {
            position: relative;
            top: 50%;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
            color: black;
        }
        #undo:hover {
            background-color: lightcoral;
            text-decoration: none;
        }
    </style>
</head>
    <body>
<div id="undoshare">
<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$currentuser=$_SESSION["user_id"];
$fileid=$_GET["fileid"];
$non_user=$_GET["non_user"];
$statement = $pdo->prepare("SELECT * FROM files WHERE file_id= ?");
$statement->execute(array($fileid));
while ($row=$statement->fetch()) {
    if ($row["owner"] != $currentuser){
        exit();
    }
}
$statement2 = $pdo->prepare("SELECT share_id FROM sharing WHERE file =:file AND non_user=:non_user");
$statement2->bindParam(':file', $fileid);
$statement2->bindParam(':non_user', $non_user);
$statement2->execute();
while ($row2 = $statement2->fetch()) {
    $share_id = $row2["share_id"];
    $statement3 = $pdo->prepare("DELETE FROM sharing WHERE share_id = ?");
    $statement3->execute(array($share_id));
    echo "Die Freigabe wurde gelöscht <br><br><a href=sharedfiles.php><button id='undo'>Zurück zu geteilte Datein </button></a> <a href=index.php><button id='undo'>Zurück zur Startseite</button></a>";
    $statement4 = $pdo->prepare("SELECT * FROM access WHERE file_id = ?");
    $statement4->execute(array($fileid));
    $result = $statement4->rowCount();
    $statement5 = $pdo->prepare("SELECT * FROM sharing WHERE file_id = ?");
    $statement5->execute(array($fileid));
    $result2 = $statement5->rowCount();
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
    </body>
        </html>
