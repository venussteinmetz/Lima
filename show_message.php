<?php
session_start()
?>
<?php
include "sidebar2.php";
include "notification.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Nachrichten</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>



    <style>
        .container {
           position: absolute;
            margin-top: 70px;
            left:300px;

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
        <div class="container">
            <table id="table table">
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


    </div>
</body>
</html>


