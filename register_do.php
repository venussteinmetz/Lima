<?php
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Registrierung</title>
</head>
<body>

<?php
$statement=$pdo->prepare("INSERT INTO user (first_name, last_name, e-mail, password) VALUES (?,?)");
if(!$statement->execute(array($_POST["e-mail"], hash("sha256",$_POST["password"])))){
    echo "Datenbank-Fehler: insert";
}
else
{
    echo "Registrierung erfolgreich";
}
?>