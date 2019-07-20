<?php
include 'searchbar.php';
include "sidebar2.php";
include "notifications.php";
include "profilepicture.php";
?>
<!DOCTYPE html>
<html lang="de">
<head>

    <title>Bootstrap</title>
    <style type="text/css">
        #message {
            position: absolute;
            left: 300px;
            top:80px;
        }
        #your_message {
            position: absolute;
            left: 300px;
            top:80px;
            margin-top: 10px;
        }
        #textarea {
            position: absolute;
            left: 300px;
            top:120px;
            border: 1px;
            border-style: solid;
            padding: 10px;
            width: 400px;
            margin-top: 30px;
        }
        #answer_button {
            outline: none;
            position: absolute;
            top: 85px;
            left: 460px;
            background-color: lightpink;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:black;
            font-family: Avenir;
            font-size:12px;
            padding:9px 13px;
            text-decoration:none;
            text-shadow:0px 1px 0px lightcoral;
        }
        #answer_button:hover {
            background-color: lightcoral;
        }
        #answer_button:link {
            color: black;
        }
    </style>
</head>


<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$user = $_SESSION["user_id"];
$message = $_GET["id"];
?>
<body>

<br>
<div id="your_message">Deine Nachricht: </div>
<br>
<table id="message">
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
            $sender= $row2["firstName"] . " " . $row2["lastName"];
        }
        $statement3 = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
        $statement3->execute(array($row['receiver']));
        while ($row3 = $statement3->fetch()) {
            $empfaenger = $row3["firstName"] . " " . $row3["lastName"];
        }
    }
    ?>




    <div id="textarea">


        <?php echo $row['content']; ?>


        <?php } ?>
    </div>


    <p>
        <a id="answer_button" href="answer_message.php?id=<?php echo $message; ?>">Auf diese Nachricht antworten</a>
        <?php
        $date = date('Y-m-d H:i:s');
        $statement4 = $pdo->prepare("UPDATE message SET message_read=:message_read WHERE message_id=:id");
        $statement4->bindParam(':message_read', $date);
        $statement4->bindParam(':id', $message);
        $statement4->execute();
        ?>
    </p>

</table>
</body>
</html>