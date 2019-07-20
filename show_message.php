<?php
session_start()
?>
<?php
include 'searchbar.php';
include "sidebar2.php";
include "notifications.php";
?>

    <!DOCTYPE html>
    <html lang="de">
<head>
    <title>Nachrichten</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>



    <style>
        h2{
            font-family: Avenir;
            position: absolute;
            left: 300px;
            top: 200px;
        }
        .container {
            position: absolute;
            margin-top: 210px;
            left: 280px;
        }
        .table table {
            margin: 10px;
        }
        tr {
            border-bottom: 1px solid #cbcbcb;
            text-align: center;
            width: 70px;
        }
        th {
            width: 20%;
            text-align: center;
        }
        td {
            width: 20%;
            text-align: center;
        }
        #buttonschreiben{
            position: absolute;
            top: 120px;
            left:300px;
        }
        #buttonschreiben {
            background-color: lightpink;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:black;
            font-family:Arial;
            font-size:12px;
            padding:9px 13px;
            text-decoration:none;
            text-shadow:0px 1px 0px lightcoral;
        }
        .button-folder {
            background-color: lightpink;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:black;
            font-family:Avenir;
            font-size:12px;
            padding:9px 13px;
            text-shadow:0px 1px 0px lightcoral;
            margin-left: 20px;
        }
        .button-folder:hover {
            background-color:lightcoral;
            text-decoration:none;
            color: black;
        }
        .button-folder:active {
            position:relative;
            top:1px;
        @media screen and (min-width: 768px) and (max-width: 1024px) {
            .container {
                width: 70%;
            }
            @media screen and (min-width: 569px) and (max-width: 767px) {
                .container{
                    width: 70%;
                }
            }
    </style>
</head>
<body>
<a id="buttonschreiben" href="writemessage.php">Neue Nachricht schreiben:</a>
<br>
<h2>Meine Nachrichten:</h2>
<br>
<div class="container">
    <table id="tabletable">
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
        $statement = $pdo->prepare("SELECT * FROM message WHERE receiver = ? ORDER BY message_date DESC");
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
                    <a class="button-folder" href="show_message_do.php?id=<?php echo $row['message_id']; ?>">Öffnen</a>
                    <a class="button-folder" href="delete_message.php?id=<?php echo $row['message_id']; ?>">Löschen</a>

                </td>
            </tr>
            <?php
        }
        ?>
</div>
</body>
    </html><?php
