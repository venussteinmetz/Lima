
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bild Upload</title>
    <style>
        form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 50%;
        }
        div {
            position: absolute;
            top: 320px;
            left: 700px;
            transform: translate(-50%, -50%);
            opacity: 50%;
        }

        html  {
            background-image: url("Hintergrund.jpg");
            max-width: 100%;
            height: auto;
            font-family: Avenir;

        }
        button {
            position: absolute;
            background-color: lightpink;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Arial;
            font-size:12px;
            padding:9px 13px;
            text-decoration:none;
            text-shadow:0px 1px 0px lightcoral;
            right: 35px;
        }
        button:hover {
            background-color: lightcoral;
        }


    </style>
</head>
<body>
<div id="1" ><b>Lade dein neues Profilbild hoch</b></div>
<form action="uploadpicture.php" method="post" enctype="multipart/form-data">
    Bild auswählen:
    <input type="file" name="file" id="uploadfile"><br>
    <button type="submit" value="Bild hochladen" name="submit">Bild hochladen</button>
</form>


</body>
</html>