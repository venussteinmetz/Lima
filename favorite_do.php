<?php
include 'sidebar2.php';
include "searchbar.php";
include 'profilepicture.php';
include 'notifications.php';
?>
<html>
<head>
    <title>Lima</title>
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script src="js/general.js"></script>
    <style>
        #ausgabe {
            font-size: medium;
            position: absolute;
            margin-top: 50px;
            margin-right: 10px;
            left:300px;
            width:50%;
        }
        #favorite_do {
            position: absolute;
            top: 50px;
        }
        #favorite_button {
            color: black;
            position: absolute;
            top: 100px;
            left: 300px;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        #favorite_button:hover {
            background-color: lightcoral;
            text-decoration: none;
        }
        #index_button {
            color: black;
            position: absolute;
            top: 100px;
            left: 600x;
            width: 270px;
            border-radius: 4px;
            background-color: lightpink;

        }
        #index_button:hover {
            background-color: lightcoral;
            text-decoration: none;
        }

    </style>

</head>
<body>


<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$status=1;
$fav= $_GET["fav"];
$statement = $pdo -> prepare ('UPDATE file SET favorite=:favorite WHERE file_id =:file_id');
$statement->bindParam(':favorite', $status);
$statement->bindParam(':file_id', $fav);
if ($statement->execute()) {
?>


<div id="ausgabe">
    <?php
    echo "<div id='favorite_do'>Datei wurde erfolgreich favorisiert! </div><br><br><a href=favorite.php><button id='favorite_button'>Zu meinen Favoriten</button></a> <a href=index.php><button id='index_button'>Zurück zur Startseite</button></a>";
    }
    ?>

</div>
</body>
</html>
