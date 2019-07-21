<?php
session_start();
$directory = "/home/ab247/public_html/s19_lima/files"; //In diesem Directory befinden sich die gespeicherten Dateien
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
</head>
<body>

//Die entsprechende file-id von der Datei, die heruntergeladen werden soll, wird durch die Get-Variable übergeben.
$file=$_GET["fileid"];
$owner = $_SESSION["user_id"];
$statement = $pdo->prepare("SELECT * FROM file WHERE file_id = ?");
$statement->execute(array($file));
while ($row = $statement->fetch()) {

    $mimetype = $row["mimetype"];
    $filetype = $row["filetype"];


    if (empty($_GET["fileid"])) {
        echo " keine Datei angegeben";
        die();
    } else {
        $filename = $_GET["filename"];
    }
    // Der Filepath setzt sich aus dem Directory, dem Namen der Datei, einem Punkt, dem Besitzer der Datei und dem Dateityp zusammen.
    $filepath = $directory . "/" . $filename . "." . $owner . "." . $filetype;

//Dies ist der Download-Dialog, der dazu führt, dass die Datei heruntergeladen wird. 
    header("Content-disposition: attachment; filename=$filename");
    header("Content-type: $mimetype");
    readfile($filepath);
}

?>
</body>
</html>
