<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

html {
    font-family: 'Poppins', sans-serif;
    font-size: large;
    position: absolute;
    background-image: url("Hintergrund.png");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    }
button {
    position: center;
    width: 173px;
    border-radius: 4px;
    background-color: lightpink;
}
button:hover {
    background-color: lightcoral;
}

        </style>

<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$sender = $_SESSION['user_id'];
if ($_POST['receiver'] == "") {
    $error = true;
    echo "Bitte geben Sie einen Empfänger ein."."<br><br><a href=writemessage.php><button>Alles klar!</button></a> <a href=index.php><button>Abbrechen</button></a>";
}
if ($_POST['subject'] == "") {
    $error = true;
    echo "Bitte geben Sie einen Betreff an."."<br><br><a href=writemessage.php><button>Alles klar!</button></a> <a href=index.php><button>Abbrechen</button></a>";
}
if ($_POST['content'] == "") {
    $error = true;
    echo "Bitte geben Sie eine Nachricht ein"."<br><br><a href=writemessage.php><button>Alles klar!</button></a> <a href=index.php><button>Abbrechen</button></a>";
}
if(!$error) {
    $statement = $pdo->prepare("SELECT * FROM user WHERE eMail = ?");
    $statement->execute(array($_POST['receiver']));
    while ($row = $statement->fetch()) {
        $receiver = $row['userID'];
    }
    if (empty($receiver)) {
        $error = true;
        echo "Der Empfänger existiert nicht <br><br> <a href=index.php><button>Zurück zur Startseite</button></a>";
    } else  {
        $stmt = $pdo->prepare("INSERT INTO message (message_id, sender, receiver, message_date, message_read, message_subject, content) VALUES('',:sender,:receiver, CURRENT_TIMESTAMP (), NULL , :message_subject, :content)");
        $stmt->bindParam(':sender', $sender);
        $stmt->bindParam(':receiver', $receiver);
        $stmt->bindParam(':message_subject', $_POST['subject']);
        $stmt->bindParam(':content', $_POST['content']);
        $stmt->execute();
        echo "Nachricht wurde erfolgreich versendet! <br><br> <a href=index.php><button>Zurück zur Startseite</button></a>";
    }
}
?>
