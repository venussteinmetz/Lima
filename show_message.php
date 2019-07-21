<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
       
if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}

include "sidebar2.php";
include "notifications.php";
include 'searchbar.php';
include 'profilepicture.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Lima</title>
    <style>
        #message {
            font-family: Avenir;
            position: absolute;
            left: 300px;
            top: 200px;
            min-width: 500px;
        }
        #container {
            position: absolute;
            margin-top: 210px;
            left: 280px;
        }
        #tabletable {
            margin: 10px;
            margin-top: 30px;
        }
        #tr_message {
            border-bottom: 1px solid #cbcbcb;
            text-align: center;
            width: 70px;
        }
        #th_message {
            width: 20%;
            text-align: center;
        }
        #td_message {
            width: 20%;
            text-align: center;
        }
        #buttonschreiben{
            position: absolute;
            top: 120px;
            left:300px;
        }
        #buttonschreiben {
            background-color: lightpink;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:black;
            font-family:Arial;
            font-size:12px;
            padding:9px 13px;
            text-decoration:none;
            text-shadow:0px 1px 0px lightcoral;
        }
        #buttonschreiben:hover{
            background-color:lightcoral;
            text-decoration:none;
            color: black;
        }
        .button-folder {
            background-color: lightpink;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:black;
            font-family:Avenir;
            font-size:12px;
            padding:9px 13px;
            text-shadow:0px 1px 0px lightcoral;
            margin-left: 20px;
        }
        .button-folder:hover {
            background-color:lightcoral;
            text-decoration:none;
            color: black;
        }
        .button-folder:active {
            position:relative;
            top:1px;
    </style>
</head>
<body>
<a id="buttonschreiben" href="writemessage.php">Neue Nachricht schreiben</a>
<br>
<div id="message"><h2>Meine Nachrichten:</h2></div>
<br>
<div id="container">
    <table id="tabletable">
        <tr id="tr_message">
            <th id="th_message">Nachricht von</th>
            <th id="th_message">Gesendet um</th>
            <th id="th_message">Betreff</th>
            <th id="th_message">Status</th>
            <th id="th_message">Diese Nachricht</th>
        </tr>
       
        <?php
        //Die Nachrichten werden in einer Vorschau dem Nutzer angezeigt und nach dem Datum (Neuste zuerst) geordnet. Es wird nicht der Nachrichtentext gezeigt, sondern nur der Betreff. Erst durch Klick auf den "Öffnen" Button kann der Nutzer die gesamte Nachricht lesen.  
        $statement = $pdo->prepare("SELECT * FROM message WHERE receiver = ? ORDER BY message_date DESC");
        $statement->execute(array($_SESSION['user_id']));
        while ($row = $statement->fetch()) {
            $statement2 = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
            $statement2->execute(array($row['sender']));
            while ($row2 = $statement2->fetch()) {
                $sender = $row2["firstName"] . " " . $row2["lastName"];
            }
            ?>
            <tr>
                <td id="td_message"><?php echo $sender; ?></td>
                <td id="td_message"> <?php echo $row ['message_date']; ?> </td>
                <td id="td_message"><?php echo $row['message_subject']; ?></td>
                <td id="td_message"><?php
                    if (is_null($row['message_read'])) {
                        echo 'Noch nicht gelesen';
                    } else {
                        echo "Gelesen";
                    }
                    ?> </td>
                <td id="td_message">
                    <!-- Der Nutzer kann die Nachricht löschen oder öffnen, und wird dafür auf die entsprechende Seite weitergeleitet-->
                    <a class="button-folder" href="show_message_do.php?id=<?php echo $row['message_id']; ?>">Öffnen</a>
                    <a class="button-folder" href="delete_message.php?id=<?php echo $row['message_id']; ?>">Löschen</a>
                </td>
            </tr>
            <?php
        }
        ?>
</div>
</body>
</html>
