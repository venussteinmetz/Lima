<?php
include "searchbar.php";
include "sidebar2.php";
include "profilepicture.php";
include "notifications.php";

if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lima</title>
    <style>
        #file {
            position: relative;
            top: 50%;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        #file:hover {
            background-color: lightcoral;
            text-decoration: none;
        }
        #delete {
            position: absolute;
            top: 80px;
            left: 300px;
            color: black;
        }
    </style>
</head>
<body>
<div id="delete">
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

// Löschen der Datei aus der Datenbank
$statement2 = $pdo->prepare("DELETE FROM file WHERE file_id = ?");
$statement2->execute(array($fileid));
//Löschen der Datei von dem Server
if (empty($filename))
{
    echo " keine Datei angegeben <br><br><a href=index.php><button id='file'>Zu meinen Datein</button></a> <a href=index.php><button id='file'>Zurück zur Startseite</button></a>";
    die();
}
else {
    echo "Die Datei wurde gelöscht <br><br><a href=index.php><button id='file'>Zu meinen Datein</button></a> <a href=index.php><button id='file'>Zurück zur Startseite</button></a>";
    unlink($directory . "/" . $filename . "." . $owner . "." . $filetype);
}
}
?>
</div>
</body>
</html>
