<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
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
<html>
<head>
    <title>Lima</title>
    <style>
        #createfolder {
            top:70px;
            left:300px;
            position: absolute;
        }
        #file {
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        #file:hover {
            background-color: lightcoral;
        }

    </style>
</head>
<body>

<form id="createfolder" action="createfolder_do.php" method="post">
    <input type="text" name="foldername" placeholder="Ordnername">
    <button id="file" type="submit">Ordner erstellen</button> <br>

</body>

</html>
