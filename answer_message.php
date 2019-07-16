<!DOCTYPE html>
<html lang="de">
<head>
    <title>Bootstrap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


    <style>
        html {
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

        div {
            position: absolute;
            top: 30%;
            left: 35%;
        }
        textarea{

            border: 5px;
            border-style: solid;
            padding: 10px;
            width: 120%;
            margin: 10px;
        }
    </style>


<body>


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
    <div>
    <form action="writemessage_do.php" method="post">
        <fieldset>
            <legend>Auf Nachricht antworten</legend>
            <label>Empfänger: <input type="text" name="receiver" value="<?php echo $empfaenger; ?>"</label>
            <label>Betreff: <input type="text" name="subject" value="Re: <?php echo $row['message_subject']; ?>" /></label> <br>
            <label>  <textarea name="content" cols="40" rows="10"></textarea></label>
            <br>
            <input type="submit" name="formaction" value="Nachricht senden" />
        </fieldset>
    </form>
<?php } ?>
    </div>

</body>