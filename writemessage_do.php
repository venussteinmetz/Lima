<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

$sender = $_SESSION['user_id'];

if ($_POST['receiver'] == "") {
    $error = true;
    echo "Bitte geben Sie einen Empfänger."."<br>";
}
if ($_POST['subject'] == "") {
    $error = true;
    echo "Bitte geben Sie einen Betreff an."."<br>";
}
if ($_POST['content'] == "") {
    $error = true;
    echo "Bitte geben Sie eine Nachricht ein"."<br>";
}


if(!$error) {

    $statement = $pdo->prepare("SELECT * FROM user WHERE eMail = ?");
    $statement->execute(array($_POST['receiver']));
    while ($row = $statement->fetch()) {
        $receiver = $row['userID'];
    }
        if (empty($receiver)) {
            $error = true;
            echo "Der Empfänger existiert nicht";
        } else  {
            $stmt = $pdo->prepare("INSERT INTO message (message_id, sender, receiver, message_date, message_read, message_subject, content) VALUES('',:sender,:receiver, CURRENT_TIMESTAMP (), NULL , :message_subject, :content)");
            $stmt->bindParam(':sender', $sender);
            $stmt->bindParam(':receiver', $receiver);
            $stmt->bindParam(':message_subject', $_POST['subject']);
            $stmt->bindParam(':content', $_POST['content']);
            $stmt->execute();


            $stmt1 = $pdo->prepare("SELECT * FROM notification WHERE user_id = ?");
            $stmt1->execute(array($receiver));
            $result = $stmt1->rowCount();

                if ($result > 0) {
                    while ($ro = $stmt1->fetch()) {
                        $number = $ro["number_count"];
                        $numbernew = $number + 1;
                        $stmt3 = $pdo->prepare("UPDATE notification SET number_count=:number_count WHERE user_id=:user_id");
                        $stmt3->bindParam(':number_count', $numbernew);
                        $stmt3->bindParam(':user_id', $receiver);
                        $stmt3->execute();
                    }

                } else {
                    $number = 1;
                    $statement4 = $pdo->prepare("INSERT INTO notification (number_count, user_id) VALUES (?, ?)");
                    $statement4->execute(array($number, $receiver));
                }
            }

            echo "Nachricht wurde erfolgreich versendet!";

}
?>