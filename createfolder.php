<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
<html>
<head>
<body>

<form id="createfolder" action="createfolder_do.php" method="post">
    <input type="text" name="foldername" placeholder="Ordnername">
    <button class="btn btn-primary" type="submit" value="Erstellen">Ordner erstellen</button>

</body>
</head>
</html>