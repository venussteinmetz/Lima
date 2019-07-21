<?php
include 'searchbar.php';
include "sidebar2.php";
include "notifications.php";

if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styling: Ausgabe - mit zwei Möglichkeiten.-->
    <style>
        #undofav {
            position: absolute;
            top: 90px;
            left:300px;
        }
        #fav {
            position: relative;
            top: 50%;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
            color: black;
        }
        #fav:hover {
            background-color: lightcoral;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div id="undofav">
<?php

    /* SQL-Anfrage: Die zeile in der Datenbank in der steht ob das Dokument favorisiert ist oder nicht wird
    umgeändert und der Status auf 0 gesetzt. */
    
session_start();

$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

$undo = 0;
$fileid= $_GET["undofav"];

$statement = $pdo -> prepare ('UPDATE file SET favorite=:favorite WHERE file_id =:file_id');
$statement->bindParam(':favorite', $undo );
$statement->bindParam(':file_id', $fileid);
if ($statement->execute()) {

    echo "Die Datei ist nicht mehr unter deinen Favoriten. <br><br><a href=favorite.php><button id='fav'>Zurück zu Favoriten</button></a> <a href=index.php><button id='fav'>Zurück zur Startseite</button></a>";;
}


?>
</div>
</body>
</html>
