
<?php
session_start();
include 'sidebar2.php';
include 'searchbar.php';
include 'notifications.php';
include 'profilepicture.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bild Upload</title>
    <style>

        #heading-pp {
            position: absolute;
            top: 160px;
            left: 600px;
        }

        html  {
            font-family: Avenir;

        }
        #button-pp {
            position: absolute;
            background-color: lightpink;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Avenir;
            font-size:12px;
            padding:9px 13px;
            text-decoration:none;
            text-shadow:0px 1px 0px lightcoral;
            left: 120px;
            top:30px;

        }
        #button-pp:hover {
            background-color: lightcoral;
        }
#settings-pp {
  position: relative;
    top:200px;
    left:600px;



}

    </style>
</head>
<body>
<div id="heading-pp" ><b>Lade dein neues Profilbild hoch</b></div>
<div id="settings-pp">
<form id="uploadpictureform" action="uploadpicture.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="uploadfile"><br>
    <button id="button-pp" type="submit" value="Bild hochladen" name="submit">Bild hochladen</button>
</form>
</div>


</body>
</html>