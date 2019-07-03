<?php
session_start()
?>

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
        .row {
            margin-top:1em;
            margin-bottom:1em;
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
</head>
<body>

<table id="nachricht">
<div class="row justify-content-between">
    <div class="col-5">
        <table class="table table-hover">
            <tr>
                <th>Nachricht von</th>
                <th>Gesendet um</th>
                <th>Betreff</th>
                <th>Status</th>
                <th>Diese Nachricht</th>
            </tr>
<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>


    <?php
    $statement = $pdo->prepare("SELECT * FROM message WHERE receiver = ?");
    $statement->execute(array($_SESSION['user_id']));
    while ($row = $statement->fetch()) {
        $statement2 = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
        $statement2->execute(array($row['sender']));
        while ($row2 = $statement2->fetch()) {
            $sender = $row2["firstName"] . " " . $row2["lastName"];
        }

        ?>

        <tr>
            <td><?php echo $sender; ?></td>
            <td> <?php echo $row ['message_date']; ?> </td>
            <td><?php echo $row['message_subject']; ?></td>
            <td><?php
                if (is_null($row['message_read'])) {
                    echo 'Noch nicht gelesen';
                } else {
                    echo "Gelesen";
                }


                ?> </td>

            <td>

                <a class="button" href="delete_message.php?id=<?php echo $row['message_id']; ?>">Löschen</a>
                <a class="button" href="show_message_do.php?id=<?php echo $row['message_id']; ?>">Öffnen</a>

            </td>

        </tr>
        <?php
    }
 ?>
            </table>
        </div>
    </div>
</body>
</html>


