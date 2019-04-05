
<?php
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
    <!doctype html>
    <html lang="de">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
    </head>
    <body>

    <?php

    if (!isset($_POST["login"]) or
    !isset($_POST["passwort"])) {

    echo "Formular-Fehler";
    die();
    }

    $statement=$pdo->prepare("SELECT * FROM nutzer WHERE login=? AND passwort=?");
    $datensatz=array($_POST["login"],hash("sha256", $_POST["passwort"]));
    $statement->execute($datensatz);

    if ($row=$statement->fetch()) {
    echo "user ok";
    echo "<br>";
    echo $row["login"];
    $_SESSION["login"]=$row["login"];
    } else {
    echo "user falsch";
    }
    header("Location: index.php");
    ?>


    </body>
</html>