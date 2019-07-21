<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
  
if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}

include 'searchbar.php';
include "sidebar2.php";
include "notifications.php";
include "profilepicture.php";
?>


<!DOCTYPE html>
<html>
<head>
    <title>Lima</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        #writemessage_button {
            color: black;
            border-radius: 4px;
            background-color: lightpink;
            position: absolute;
            top: 350px;
            left: 270px;
        }
        #index_button {
            color: black;
            border-radius: 4px;
            background-color: lightpink;
            position: absolute;
            top: 350px;
            left: 450px;
        }
        #index_button:hover {
            background-color: lightcoral;
        }
        #writemessage_button:hover {
            background-color: lightcoral;
        }
        #writemessage {
            position: absolute;
            top: 200px;
            left: 270px;
        }
        #nouser_button {
            position: absolute;
            top: 50px;
            left: 10px;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
            color: black;
        }
        #nouser_button:hover {
            background-color: lightcoral;
            text-decoration:none;
        }
    </style>

<body>
<div id="writemessage">
    <?php
    $sender = $_SESSION['user_id'];
    
    //Es wird überprüft, ob alle Felder ausgefüllt wurden.
    if ($_POST['receiver'] == "") {
        $error = true;
        echo "Bitte geben Sie einen Empfänger ein.<br><br>";
    }
    if ($_POST['subject'] == "") {
        $error = true;
        echo "Bitte geben Sie einen Betreff an.<br><br>";
    }
    if ($_POST['content'] == "") {
        $error = true;
        echo "Bitte geben Sie eine Nachricht ein.<br><br>";
    };
    "<br><br> <a href=index.php><button>Zurück zur Startseite</button></a>";
    if(!$error) {
        //Es wird überprüft ob der Nutzer auch existiert.
        $statement = $pdo->prepare("SELECT * FROM user WHERE eMail = ?");
        $statement->execute(array($_POST['receiver']));
        while ($row = $statement->fetch()) {
            $receiver = $row['userID'];
        }
        
        //Fehlermeldung, wenn der Nutzer nicht existiert.
        if (empty($receiver)) {
            $error = true;
            echo "Der Empfänger existiert nicht.
            <br><br>
            <br><br> <a href=writemessage.php><button id='nouser_button'>Neue Nachricht schreiben</button></a>";
            die();
        } else  {
            //Wenn der Nutzer existiert, wird ein neuer Eintrag in die Tabelle message erstellt. 
            $stmt = $pdo->prepare("INSERT INTO message (message_id, sender, receiver, message_date, message_read, message_subject, content) VALUES('',:sender,:receiver, CURRENT_TIMESTAMP (), NULL , :message_subject, :content)");
            $stmt->bindParam(':sender', $sender);
            $stmt->bindParam(':receiver', $receiver);
            $stmt->bindParam(':message_subject', $_POST['subject']);
            $stmt->bindParam(':content', $_POST['content']);
            $stmt->execute();
            echo "Nachricht wurde erfolgreich versendet!";
            
            //Es wir überprüft, ob der Nutzer schon einen Eintrag in der Tabelle notification hat
            $stmt1 = $pdo->prepare("SELECT * FROM notification WHERE user_id = ?");
            $stmt1->execute(array($receiver));
            $result = $stmt1->rowCount();
            
            //Wenn er einen Eintrag hat, wird die aktuelle Zahl bei number_count um 1 erhöht.
            if ($result > 0) {
                while ($ro = $stmt1->fetch()) {
                    $number = $ro["number_count"];
                    $numbernew = $number + 1;
                    $stmt3 = $pdo->prepare("UPDATE notification SET number_count=:number_count WHERE user_id=:user_id");
                    $stmt3->bindParam(':number_count', $numbernew);
                    $stmt3->bindParam(':user_id', $receiver);
                    $stmt3->execute();
                }
                //Wenn noch kein Eintrag für den Nutzer existiert, wird ein ein neuer Eintrag erstellt.
            } else {
                $number = 1;
                $statement4 = $pdo->prepare("INSERT INTO notification (number_count, user_id) VALUES (?, ?)");
                $statement4->execute(array($number, $receiver));
            }
        }
    }
    ?>

</div>
<br><br> <a href=index.php><button id="index_button">Zurück zur Startseite</button></a>
<br><br> <a href=writemessage.php><button id="writemessage_button">Neue Nachricht schreiben</button></a>

</body>
</html>
