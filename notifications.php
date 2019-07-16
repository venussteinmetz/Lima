<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$user = $_SESSION["user_id"];
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        // Wenn man auf die Nachrichtenbox klickt, wird die Vorschau der ungelesenen Nachrichten ausgefahren, bzw. wieder eingefahren wenn man erneut draufklickt
        $(document).ready(function(){
            $("button").click(function(){
                $("p").toggle();
            });
        });
    </script>
    <style>
        .notification {
            background-color: white;
            color: black;
            text-decoration: none;
            padding: 15px 26px;
            position: absolute;
            display: inline-block;
            margin-top: 10px;
            right: 10px;
            margin-right: 10px;
            border-color: #cbcbcb;
            border-style: solid;
        }
        .notification:hover {
            background: grey;
        }
        .notification .badge {
            position: absolute;
            top: 0px;
            right: -10px;
            padding: 5px 10px;
            border-radius: 50%;
            background: lightcoral;
            color: white;
        }
        p {
            display: none;
            position: absolute;
            top: 60px;
            background-color: #FFF5EE ;
            color: #cbcbcb;
            padding: 5px;
            min-width: 100px;
            width: auto;
            right: 10px;
            margin-right: 10px;
        }
        #notifi a:link {
            color: black;
            text-decoration: inherit;
        }
        #notifi a:hover {
              background-color: lightpink;
          }
    </style>
</head>
<body>
<div id="notifi">
    <button id ="hide" class="notification">
        <span>Chats</span>
        <span class="badge">

            <!-- Hier wird die Anzahl der ungelesenen Nachrichten angezeigt -->
            <?php
            $statementx = $pdo->prepare("SELECT * FROM notification WHERE user_id = $user");
            $statementx->execute();
            $result = $statementx->rowCount();
            if($result > 0) {
                while ($row = $statementx->fetch()) {
                    $number = $row["number_count"];
                    echo $number;
                }
            } else {
                echo 0;
            }
            ?>
        </span>
    </button>

    <p>
        <!-- Hier werden die ungelesenen Nachrichten in einer Vorschau (nur der Betreff) angezeigt -->
        <?php
        $userID= $_SESSION["user_id"];
        $statement = $pdo->prepare("SELECT * FROM message WHERE message_read IS NULL AND receiver=$userID");
        if($statement->execute()) {
            while ($row = $statement->fetch()) {
                $message_subject=$row['message_subject'];
                $message_id = $row["message_id"]; ?>

                <a href="show_message_do.php?id=<?php echo $message_id;?>">Betreff: <?php echo $message_subject;?></a><br> <br>
                <?php
            }
        }
        ?>

    </p>
</div>

</body>
</html>