<?php
include 'searchbar.php';
include "sidebar2.php";
include "notification.php";
include "profilepicture.php";
if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Lima</title>
    <style>
        #hochladenform {
            position: absolute;
            left: 300px;
            top: 80px;
        }
        h1 {
            align-items: center;
            font-size: 30px;
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
<!-- Auswahlfunktion der Datei -->
<body>
<div id="hochladenform">
<h1>Datei hochladen</h1>
<form action="uploaddo.php" method="post" enctype="multipart/form-data">
    Datei auswählen:
    <input type="file" name="uploadfile" id="uploadfile"><br>
    <button id="file" type="submit" name="action">Upload</button> <a
</form>
</div>
</body>
</html>
