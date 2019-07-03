<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Datei Upload</title>
</head>
<body>
<form action="uploaddo.php" method="post" enctype="multipart/form-data">
    Datei auswählen:
    <input type="file" name="uploadfile" id="uploadfile"><br>
    <input type="submit" value="Datei hochladen" name="submit">
</form>
</body>
</html>

