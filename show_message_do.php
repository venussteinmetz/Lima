<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$user = $_SESSION["user_id"];
$message = $_GET["id"];
?>
<table id="nachricht">
    <?php
    $statement = $pdo->prepare("SELECT * FROM message WHERE message_id = ?");
    $statement->execute(array($message));
    while ($row = $statement->fetch()) {
        if ($row["message_read"] == NULL AND $row["receiver"] == $user) {

            $stmt = $pdo->prepare("SELECT * FROM notification WHERE user_id = ?");
            $stmt->execute(array($user));
            while ($rows = $stmt->fetch()) {

                $number = $rows["number_count"];
                $numbernew = $number - 1;
                $statement5 = $pdo->prepare("UPDATE notification SET number_count=:number_count WHERE user_id=:user_id");
                $statement5->bindParam(':number_count', $numbernew);
                $statement5->bindParam(':user_id', $user);
                $statement5->execute();

        }

    $statement2 = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
    $statement2->execute(array($row['sender']));
    while ($row2 = $statement2->fetch()) {
        $sender = $row2["firstName"] . " " . $row2["lastName"];
    }

    $statement3 = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
    $statement3->execute(array($row['receiver']));
    while ($row3 = $statement3->fetch()) {
        $empfaenger = $row3["firstName"] . " " . $row3["lastName"];
    }

    }


    ?>
    <caption>Nachricht von: <?php echo $sender; ?></caption>
    <tr>
        <th>Sender: </th>
        <td><?php echo $sender; ?></td>
    </tr>
    <tr>
        <th>Empfänger: </th>
        <td><?php echo $empfaenger; ?></td>
    </tr>
    <tr>
        <th>Gesendet: </th>
        <td><?php echo $row['message_date']; ?></td>
    </tr>
    <tr>
        <th>Betreff: </th>
        <td><?php echo $row['message_subject']; ?>
    </tr>
    <tr>
        <th>Nachricht: </th>
        <td><?php echo $row['content']; ?></td>
    </tr>
</table>
<p>
    <a href="answer_message.php?id=<?php echo $row['message_id']; ?>">Auf diese Nachricht antworten</a>
    <?php
    $date = date('Y-m-d H:i:s');
    $statement4 = $pdo->prepare("UPDATE message SET message_read=:message_read WHERE message_id=:id");
    $statement4->bindParam(':message_read', $date);
    $statement4->bindParam(':id', $message);
    $statement4->execute();

    }

    ?>
</p>
