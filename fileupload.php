<?php
include 'searchbar.php';
include "sidebar2.php";
include "notification.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Datei Upload</title>
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
        #upload_button {
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        #upload_button:hover {
            background-color: lightcoral;
        }
    </style>
</head>
<body>
<div id="hochladenform">
    <h1>Datei hochladen</h1>

    <form action="uploaddo.php" method="post" enctype="multipart/form-data">
        Datei auswählen:
        <input type="file" name="uploadfile" id="uploadfile"><br>
        <button id="upload_button" type="submit" name="action">Upload</button> <a
    </form>
</div>
</body>
</html>