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
<form action="writemessage_do.php" method="post">
    <fieldset>
        <legend>Auf Nachricht antworten</legend>
        <label>Empfänger: <input type="text" name="receiver" value="<?php echo $empfaenger; ?>"</label>
        <label>Betreff: <input type="text" name="subject" value="Re: <?php echo $row['message_subject']; ?>" /></label>
        <label>Nachricht: <textarea name="content" cols="40" rows="10"></textarea></label>
        <input type="submit" name="formaction" value="Nachricht senden" />
    </fieldset>
</form>
<?php } ?>
