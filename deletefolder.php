<?php
include 'sidebar2.php';
include "searchbar.php";
include "notification.php";
include "profilpicture.php";
if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<html>
<head>
    <title>Lima</title>
    <style>
        #geloescht {
            position: absolute;
            left: 300px;
            top:90px;
        }
       #file {
            position: relative;
            top: 50%;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
           color: black;
        }
        #file:hover {
            background-color: lightcoral;
            text-decoration: none;
        }

    </style>
</head>
<body>
<div id="geloescht">
    <?php
    //Ordner wird aus der Datenbank gelöscht
    session_start();
    $pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
    $folderid= $_GET["folder_id"];
    $statement = $pdo->prepare( "DELETE FROM folders WHERE folder_id=:folderid");
    $statement ->bindParam('folderid', $folderid);
    $statement->execute();
    echo "Ordner wurde gelöscht!<br><br><a href=showfolder.php><button id='file'>Zurück zu Ordner</button></a> <a href=index.php><button id='file'>Zurück zur Startseite</button></a>";
    ?>
</div>
</body>
</html>
