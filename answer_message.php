<?php
include 'sidebar2.php';
include "searchbar.php";
include 'profilepicture.php';
include 'notifications.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Lima</title>

    <style>
        #answermessage  {
            position: absolute;
            left: 300px;
            top:80px;
        }
        #sendmessage {

            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        #sendmessage:hover {
            background-color: lightcoral;
        }
    </style>





    <?php
    session_start();
    $pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
    $message = $_GET["id"];
    $statement = $pdo->prepare("SELECT * FROM message WHERE message_id = ?");
    $statement->execute(array($message));
    while ($row = $statement->fetch()) {
    $statement2 = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
    $statement2->execute(array($row['sender']));
    while ($row2 = $statement2->fetch()) {
        $empfaenger = $row2["eMail"];
    }
    ?>
<body>
<div id="answermessage">
    <form action="writemessage_do.php" method="post">
        <fieldset>
            <legend>Auf Nachricht antworten</legend>
            <label>Empfänger: <input type="text" name="receiver" value="<?php echo $empfaenger; ?>"</label>
            <label>Betreff: <input type="text" name="subject" value="Re: <?php echo $row['message_subject']; ?>" /></label> <br>
            <label>  <textarea name="content" cols="80" rows="20"></textarea></label>
            <br>
            <button id="sendmessage" type="submit">Nachricht senden</button> <br>
        </fieldset>
    </form>
    <?php } ?>
</div>

</body>
</html>