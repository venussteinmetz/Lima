
<html>
<head>
    <title>Lima</title>
    <body>

<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

?>
<table id="notifications">

<?php
$userID= $_SESSION["user_id"];
$statement = $pdo->prepare("SELECT * FROM message WHERE message_read IS NULL AND receiver=$userID");
if($statement->execute()) {
    while ($row = $statement->fetch()) {
        $content=$row['content'];
        $message_date=$row['message_date'];
        $message_subject=$row['message_subject'];

        echo "<tr>
                    <td> $content</td>
                    <td>$message_date</td>
                    <td>$message_subject</td>
                </tr> ";
        ?>
<?php
    }
}

?>


</body>
</html>
