<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}

include "searchbar.php";
include "sidebar2.php";
include "profilepicture.php";
include "notifications.php";
?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
    <style>
        #upload {
            position: absolute;
            top: 90px;
            left: 300px;
        }
        #up {
            position: relative;
            top: 50%;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
            color: black;
        }
        #up:hover {
            background-color: lightcoral;
            text-decoration: none;
        }

    </style>
</head>
<body>
<div id="upload">
<?php
$id = $_SESSION['user_id'];
if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}

function random_string()
{
    if (function_exists('random_bytes')) {
        $bytes = random_bytes(16);
        $str = bin2hex($bytes);
    } else if (function_exists('openssl_random_pseudo_bytes')) {
        $bytes = openssl_random_pseudo_bytes(16);
        $str = bin2hex($bytes);
    } else if (function_exists('mcrypt_create_iv')) {
        $bytes = random_bytes(16, MCRYPT_DEV_URANDOM);
        $str = bin2hex($bytes);
    } else {
        $str = md5(uniqid('geheim', true));
    }
    return $str;
}

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName=$_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];


    $fileExt = explode('.', $fileName); //Trennung zwischen Namen der File und dem Anhang nach dem Punkt
    $fileActualExt = strtolower(end($fileExt)); //Großbuchstaben werden kleingeschrieben

    $allowed = array('jpg', 'jpeg', 'png', 'pdf'); //Diese Dateitypen sind erlaubt

    $randomcode = random_string();
    if(in_array($fileActualExt, $allowed)) {  //es wird überprüft ob der hochgeladene Dateityp erlaubt ist
        if($fileSize < 25000000) { //die Dateigröße darf nicht größer als 25000000 sein
            $fileNameNew = $randomcode . "." . $fileActualExt;
            $fileDestination = "/home/ab247/public_html/s19_lima/pp/" . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);

            //Sobald ein neues Profilbild hochgeladen wird, wird in der Tabelle profileimg der Image-Status von 1 auf 0 gesetzt. Und der Image-Path wird aktualisiert.
            $imgstatusnew = 0;
            $statement3 = $pdo->prepare("UPDATE profileimg SET imgstatus=:imgstatus WHERE userid=:id");
            $statement3->bindParam(':imgstatus', $imgstatusnew );
            $statement3->bindParam(':id', $id);
            $statement3->execute();

            $statement4 = $pdo->prepare("UPDATE profileimg SET imgpath=:imgpath WHERE userid=:id");
            $statement4->bindParam(':imgpath', $fileNameNew);
            $statement4->bindParam(':id', $id);
            $statement4->execute();
            echo "Datei erfolgreich hochgeladen <br><br><a href=settings.php><button id='up'>Zurück zum Profilbild hochladen</button></a> <a href=index.php><button id='up'>Zurück zur Startseite</button></a>";

        } else {
            echo "Datei ist zu groß <br><br><a href=settings.php><button id='up'>Zurück zum Profilbild hochladen</button></a> <a href=index.php><button id='up'>Zurück zur Startseite</button></a>";
        }

    } else {
        echo "Datei-Typ ist nicht erlaubt. Bitte jpg, jpeg, png oder pdf verwenden! <br><br><a href=settings.php><button id='up'>Zurück zum Profilbild hochladen</button></a> <a href=index.php><button id='up'>Zurück zur Startseite</button></a>";
    }
}

?>
</div>
</body>
</html>
