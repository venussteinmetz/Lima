<!DOCTYPE html>
<head>
    <title>Lima</title>
</head>
<body>
<?php
$pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset' => 'utf8'));

session_start();

if(!isset($_GET['userid'])) {
    die("Leider wurde beim Aufruf dieser Website kein Code zum Zurücksetzen deines Passworts übermittelt");
}

$userid = $_GET['userid'];
$code = $_GET['code'];



$statement = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
$statement->execute(array($userid));
$user = $statement->fetch();




//Überprüfe dass ein Nutzer gefunden wurde und dieser auch ein Code hat
if($user === null || $user['passwortcode'] === null) {
    die("Es wurde kein passender Benutzer gefunden");
}

if($user['passwortcode_time'] === null || strtotime($user['passwortcode_time']) < (time()-24*3600) ) {
    die("Dein Code ist leider abgelaufen");
}


//Überprüfung des Codes
if($code != $user['passwortcode']) {
    die("Der übergebene Code war ungültig. Stell sicher, dass du den genauen Link in der URL aufgerufen hast.");
}



if(isset($_GET['send'])) {
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if($passwort != $passwort2) {
        echo "Bitte identische Passwörter eingeben";
    } else { //Speichern des neuen Passworts
        $passworthash = password_hash($passwort, PASSWORD_BCRYPT);
        $stmt2 = $pdo->prepare("UPDATE user SET password =:password, passwortcode = NULL, passwortcode_time = NULL WHERE userID = :userID");
        $stmt2->bindParam(':password', $passworthash);
        $stmt2->bindParam(':userID', $userid);
        $stmt2->execute();
        echo "Dein Passwort wurde erfolgreich geändert";
        header("Location: login.php");
        }
    }

?>

<h1>Neues Passwort vergeben</h1>
<form action="?send=1&userid=<?php echo $userid; ?>&code=
<?php echo $code; ?>" method="post">
    Bitte gib ein neues Passwort ein:<br>
    <input type="password" name="passwort"><br><br>

    Passwort erneut eingeben:<br>
    <input type="password" name="passwort2"><br><br>

    <input type="submit" value="Passwort speichern">
</form>
</body>
</html>
