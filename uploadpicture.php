<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$id = $_SESSION['user_id'];

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
            if($fileSize < 1000000000) { //die Dateigröße darf nicht größer als 1000000 sein
                $fileNameNew = $randomcode . "." . $fileActualExt;
                $fileDestination = "/home/ab247/public_html/s19_lima/pp/" . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                $imgstatusnew = 0;
                $statement3 = $pdo->prepare("UPDATE profileimg SET imgstatus=:imgstatus WHERE userid=:id");
                $statement3->bindParam(':imgstatus', $imgstatusnew );
                $statement3->bindParam(':id', $id);
                $statement3->execute();

                $statement4 = $pdo->prepare("UPDATE profileimg SET imgpath=:imgpath WHERE userid=:id");
                $statement4->bindParam(':imgpath', $fileNameNew);
                $statement4->bindParam(':id', $id);
                $statement4->execute();

                    header("Location: index.php");
                } else {
                    echo "Datei ist zu groß";
                }

} else {
        echo "Datei-Typ ist nicht erlaubt. Bitte jpg, jpeg, png oder pdf verwenden!";
    }
}

?>

