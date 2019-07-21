<?php
include "sidebar2.php";
include "notifications.php";
include 'searchbar.php';
include 'profilepicture.php';
?>

<html>
<body>
<style>
    .ausgabe {
        position: absolute;
        left: 300px;
        top: 80px;
        font-size: 15px;
    }
    #backtomessage {
        position: relative;
        top: 50%;
        width: 173px;
        border-radius: 4px;
        background-color: lightpink;
        color: black;
    }
    #backtomessage:hover {
        background-color: lightcoral;
    }
</style>
</body>
</html>

<div class="ausgabe">
    <?php
    session_start();
    $pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
    $message = $_GET["id"];
    $user_id = $_SESSION['user_id'];

    $statement2 = $pdo->prepare("SELECT * FROM message WHERE message_id = ?");
    $statement2->execute(array($message));
    while($row2 = $statement2->fetch()) {
        if ($row2["message_read"] == NULL AND $row2["receiver"] == $user_id) {
            $stmt = $pdo->prepare("SELECT * FROM notification WHERE user_id = ?");
            $stmt->execute(array($user_id));
            while ($rows = $stmt->fetch()) {
                $number = $rows["number_count"];
                $numbernew = $number - 1;
                $statement3 = $pdo->prepare("UPDATE notification SET number_count=:number_count WHERE user_id=:user_id");
                $statement3->bindParam(':number_count', $numbernew);
                $statement3->bindParam(':user_id', $user);
                $statement3->execute();


            }
        }
    }
    $statement = $pdo->prepare("DELETE FROM message WHERE message_id = ?");
    $statement->execute(array($message));





        echo "Deine Nachricht wurde gelöscht!<br><br><a href=show_message.php><button id='backtomessage'>Zurück zu Nachrichten</button></a> <a href=index.php><button id='backtomessage'>Zurück zur Startseite</button></a>";
    ?>

</div>

