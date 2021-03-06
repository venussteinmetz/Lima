<?php
include "searchbar.php";
include "sidebar2.php";
include "profilepicture.php";
include "notifications.php";

if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script src="js/general.js"></script>
    <!-- Im Style wird die Position und Schriftart/-größe der Meldungen, sowie die Position und Farbe der Buttons definiert --> 
    <style>
        #nofolder {
            font-family: Avenir;
            position: absolute;
            font-size: medium;
            top: 90px;
            left:300px;
        }
        #ausgabe {
            font-family: Avenir;
            font-size: medium;
            position: absolute;
            margin-top: 90px;
            margin-right: 10px;
            left:300px;
            width:50%;
        }
        #file{
            position: relative;
            top: 50%;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
            color: black;
        }
        #file:hover {
            background-color: lightcoral;
            text-decoration: none;
        }
    </style>
</head>
    <body>
<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$foldername=$_POST["foldername"];
$owner=$_SESSION["user_id"];
//Es wird überprüft, ob der Ordnername bereits existiert bei dem Nutzer, der den Ordner erstellt hat. Wenn dies der Fall ist wird eine Fehlermeldung ausgegeben.
$statement = $pdo->prepare("SELECT * FROM folders WHERE folder_name = ? AND owner = $owner");
$statement->execute(array($foldername));
while ($row = $statement->fetch()) {
    if ($row !== false) {
        echo '<div id="nofolder">Dieser Ordnername existiert bereits. Bitte wähle einen anderen Namen aus!<br><br><a href=createfolder.php><button id=\'file\'>Alles klar!</button></a> <a href=index.php><button id=\'file\'>Zurück zur Startseite</button></div>';
        die();
    }
}
        //Es wird überprüft, ob ein Ordnername eingegeben wurde, sonst wird eine Fehlermeldung angezeigt.
if ($_POST["foldername"] == "") {
    echo '<div id="nofolder">Bitte geben Sie dem Ordner einen Namen!<br><br><a href=createfolder.php><button id=\'file\'>Alles klar!</button></a> <a href=index.php><button id=\'file\'>Zurück zur Startseite</button></div>\';
        die();</div>';
    die();
}
?>
<div id="ausgabe">
    <?php
    //Beim Erstellen eines neuen Ordners, wird der file_code auf 0 gesetzt. Dies bedeutet, dass noch keine Datei in dem Ordner gespeichert ist.
    $status = 0;
    //Der Ordner wird in die Datenbank folders eingefügt und der Nutzer bekommt eine Meldung, dass der Ordner erfolgreich erstellt wurde
    $stmt = $pdo->prepare("INSERT INTO folders (folder_id, owner, folder_name, file_code) VALUES('',$owner,:foldername, :filecode)");
    $stmt ->bindParam('foldername', $foldername);
    $stmt ->bindParam('filecode', $status);
    $stmt ->execute();
    echo "Ordner wurde erfolgreich erstellt!<br><br><a href=showfolder.php><button id='file'>Zu meinen Ordnern</button></a> <a href=index.php><button id='file'>Zurück zur Startseite</button></a>"
    exit();
    ?>
    </body>
        </html>
