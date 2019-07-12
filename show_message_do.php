

<!DOCTYPE html>
<html lang="de">
<head>

<title>Bootstrap</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <style type="text/css">
        /*nur fuer Beispiel, um Hoehe des Containers zu simulieren*/
        #textarea {

            border: 5px;
            border-style: solid;
            padding: 10px;
            width: 50%;
            margin: 10px;
        }
        .button {
            background-color: lightpink;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Arial;
            font-size:12px;
            padding:9px 13px;
            text-decoration:none;
            text-shadow:0px 1px 0px lightcoral;
        }
    </style>

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

    <table id="nachricht">
        <div class="row justify-content-between">
            <div class="col-5">
                <table class="table table-hover">
                    <tr>
                        <th>Deine Nachricht von: <?php echo $sender; ?> </th>
                        <th><?php echo $sender; ?></th>
                        <th>Gesendet um: <?php echo $row['message_date']; ?></th>
                        <th>Betreff: <?php echo $row['message_subject']; ?></th>

                    </tr>
</table>

                <div id="textarea">

                    <?php echo $row['content']; ?>




                </div>
<p>
    <a class="button" href="answer_message.php?id=<?php echo $row['message_id']; ?>">Auf diese Nachricht antworten</a>
    <?php
    $date = date('Y-m-d H:i:s');
    $statement4 = $pdo->prepare("UPDATE message SET message_read=:message_read WHERE message_id=:id");
    $statement4->bindParam(':message_read', $date);
    $statement4->bindParam(':id', $message);
    $statement4->execute();
    }
    ?>
</p>