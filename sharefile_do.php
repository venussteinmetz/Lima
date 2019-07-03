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
    $stmt1 = $pdo->prepare("UPDATE file SET access_rights=:access_rights WHERE file_id=:file_id");
    $stmt1->bindParam(':access_rights', $status);
    $stmt1->bindParam(':file_id', $file);
    $stmt1->execute();

    $statement3 = $pdo->prepare("INSERT INTO access (access_id, file_id, user_id) VALUES('', :file_id, :user_id)");
    $statement3->bindParam(':file_id', $file);
    $statement3->bindParam(':user_id', $newuser);
    $statement3->execute();
    echo "Erfolg";
    exit();
}

        if (empty($exists)){
        $randomcode = random_string();
        $stmt2 = $pdo->prepare("INSERT INTO sharing (share_id, random_string, file, non_user) VALUES('',:randomstring,:file,:useremail)");
        $stmt2->bindParam(':randomstring', $randomcode);
        $stmt2->bindParam(':file', $file);
        $stmt2->bindParam(':useremail', $user_email);
        $stmt2->execute();

            $status = 1;
            $stmt4 = $pdo->prepare("UPDATE file SET access_rights=:access_rights WHERE file_id=:file_id");
            $stmt4->bindParam(':access_rights', $status);
            $stmt4->bindParam(':file_id', $file);
            $stmt4->execute();

        $absender = "From: Lima <info@lima.de>";
        $betreff = "Eine Lima-Datei wurde Ihnen freigegeben";
        $url_downloadcode = "https://mars.iuk.hdm-stuttgart.de/~ab247/s19_lima/download_sharedfiles.php?code=" . $randomcode;
        $text = "Hallo," .
            "Ihnen wurde eine Datei auf Lima freigegeben. Klicken Sie auf den Link um sie herunterzuladen:"
            . $url_downloadcode;
        mail($user_email, $betreff, $text, $absender);
        //E-Mail versand an nicht registrierten Nutzer
        echo "Freigabe erfolgreich";
        exit();

    }

?>
