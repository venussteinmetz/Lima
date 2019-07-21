<?php
include 'sidebar2.php';
include "searchbar.php";
include 'profilepicture.php';
include 'notifications.php';
?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="dashboard3style.css" rel="stylesheet">
    <style>
        h3 {
            position: absolute;
            right: 30%;
        }
        #shareoutput {
            position: absolute;
            top: 90px;
            left: 300px;
        }
        #sharing {
            position: relative;
            top: 50%;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
            color: black;
        }
        #sharing:hover {
            background-color: lightcoral;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div id="shareoutput">
    <?php
    session_start();
    $pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
    $user_email=$_POST["user_email"];
    $file_name=$_POST["file"];
    $statement0 = $pdo->prepare("SELECT * FROM file WHERE filename = ?");
    $statement0->execute(array($file_name));
    while ($row0 = $statement0->fetch()) {
        $file = $row0["file_id"];
    }
    function random_string() {
        if(function_exists('random_bytes')) {
            $bytes = random_bytes(16);
            $str = bin2hex($bytes);
        } else if(function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes(16);
            $str = bin2hex($bytes);
        } else if(function_exists('mcrypt_create_iv')) {
            $bytes = random_bytes(16, MCRYPT_DEV_URANDOM);
            $str = bin2hex($bytes);
        } else {
            $str = md5(uniqid('geheim', true));
        }
        return $str;
    }
    //Datenbankverbindung um den Nutzer ausfindig zu machen, für den die Datei Freigegeben werden soll
    $statement = $pdo->prepare("SELECT * FROM user WHERE eMail = ?");
    $statement->execute(array($user_email));
    while ($row = $statement->fetch()) {
        $exists = $row['eMail'];
        $newuser = $row['userID'];
    }
    //Abfrage ob der User in der Datenbank existiert
    //der neu generierte Filecode wird in die Datenbank geschreiben
    if ($exists != "") {
        $status = 1;
        $owner_id = $_SESSION["user_id"];
        $stmt1 = $pdo->prepare("UPDATE file SET access_rights=:access_rights WHERE file_id=:file_id");
        $stmt1->bindParam(':access_rights', $status);
        $stmt1->bindParam(':file_id', $file);
        $stmt1->execute();
        $statement3 = $pdo->prepare("INSERT INTO access (access_id, file_id, user_id, owner_id) VALUES('', :file_id, :user_id, :owner_id)");
        $statement3->bindParam(':file_id', $file);
        $statement3->bindParam(':user_id', $newuser);
        $statement3->bindParam(':owner_id', $owner_id );
        $statement3->execute();
        echo "Deine Datei wurde erfolgreich geteilt.<br><br><a href=sharefile.php><button id='sharing'>Zurück zum teilen</button></a> <a href=index.php><button id='sharing'>Zurück zur Startseite</button></a>";
        exit();
    }
    if ($_POST["user_email"] == "") {
        echo "Bitte gebe eine E-Mail ein. <br><br><a href=sharefile.php><button id='sharing'>Zurück zum teilen</button></a> <a href=index.php><button id='sharing'>Zurück zur Startseite</button></a>";
        die();
    }
    $findemail="@";
    $email = stripos($_POST ["user_email"], $findemail);

    if($email == false){
        echo "Bitte gebe eine richtige E-Mail ein. <br><br><a href=sharefile.php><button id='sharing'>Zurück zum teilen</button></a> <a href=index.php><button id='sharing'>Zurück zur Startseite</button></a>";
        die();
    }
    $finddot=".";
    $email = stripos($_POST ["user_email"], $finddot);

    if($email == false){
        echo "Bitte gebe eine richtige E-Mail ein. <br><br><a href=sharefile.php><button id='sharing'>Zurück zum teilen</button></a> <a href=index.php><button id='sharing'>Zurück zur Startseite</button></a>";
        die();
    }


    if (empty($exists)){
        $owner_id = $_SESSION["user_id"];
        $randomcode = random_string();
        $stmt2 = $pdo->prepare("INSERT INTO sharing (share_id, random_string, file, non_user, owner_id) VALUES('',:randomstring,:file,:useremail,:owner_id)");
        $stmt2->bindParam(':randomstring', $randomcode);
        $stmt2->bindParam(':file', $file);
        $stmt2->bindParam(':useremail', $user_email);
        $stmt2->bindParam(':owner_id', $owner_id);
        $stmt2->execute();
        $status = 1;
        $stmt4 = $pdo->prepare("UPDATE file SET access_rights=:access_rights WHERE file_id=:file_id");
        $stmt4->bindParam(':access_rights', $status);
        $stmt4->bindParam(':file_id', $file);
        $stmt4->execute();
        $absender = "From: Lima <info@lima.de>";
        $betreff = "Eine Lima-Datei wurde Ihnen freigegeben";
        $url_downloadcode = "https://mars.iuk.hdm-stuttgart.de/~ab247/s19_lima/download_sharedfiles.php?code=" . $randomcode;
        $text = "Hallo hier ist ihr Lima-Team," .
            "Ihnen wurde eine Datei auf Lima freigegeben. Klicken Sie auf den Link um sie herunterzuladen:"
            . $url_downloadcode;
        mail($user_email, $betreff, $text, $absender);
        //E-Mail versand an nicht registrierten Nutzer
        echo "Freigabe erfolgreich<br><br><a href=sharefile.php><button id='sharing'>Zurück zum teilen</button></a> <a href=index.php><button id='sharing'>Zurück zur Startseite</button></a>";
        exit();
    }
    ?>
</div>
</body>
</html>
