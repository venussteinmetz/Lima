<?php
//Alle Seiten die auf der Startseite zu sehen sind
include 'notifications.php';
include 'search.php';
include 'sidebar2.php';
include 'files_all.php';
include 'profilepicture.php';
//Sicherheit
if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<body>
</html>
