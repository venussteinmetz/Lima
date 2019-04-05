<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Lima</title>

</head>
<body background="Hintergrund.jpg">

<?php
// enctype: spezifiziert, wie eine Datei an den Server geschickt wird
?>

<form method="POST" enctype="multipart/form-data" action="upload.php">
    <input type="file" name="file">
    <input type="submit" value="Upload">
</form>

<?php
// Oben der erste Input ermöglicht es auf den Computer zuzugreifen
// displaying all uploaded files


$files = scandir("uploads");
print_r($files)

?>

</body>
</html>