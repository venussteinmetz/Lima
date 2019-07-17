<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$user = $_SESSION["user_id"];
if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optionales Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Das neueste kompilierte und minimierte JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        // Wenn man auf die Nachrichtenbox klickt, wird die Vorschau der ungelesenen Nachrichten ausgefahren, bzw. wieder eingefahren wenn man erneut draufklickt
        $(document).ready(function(){
            $("button").click(function(){
                $(".notify").toggle();
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
            top: -5px;
            right: -10px;
            padding: 5px 10px;
            border-radius: 50%;
            background: lightcoral;
            color: white;
        }
        .notify {
            font-family: Avenir;
            display: none;
            position: absolute;
            top: 70px;
            background-color: white;
            border-width: 1px;
            border-style: solid;
            border-color: lightgrey;
            color: #cbcbcb;
            padding: 5px;
            min-width: 300px;
            min-height: 200px;
            width: auto;
            right: 10px;
            margin-right: 10px;
        }
        .hr {
            background: lightgrey;
            width:290px;
            height:0.5px;
            position: absolute;
            top: 35px;
        }
        .notification-head {
            color: black;
            text-align: center;
            font-size: 20px;
        }

        .notification-msg:hover {
            background-color: lightgrey;
        }
        .notification-link:link {
            color: black;
            text-decoration: none;
        }
        #hide {
            border-radius: 50%;
        }
    </style>
</head>
<body>
<div>
    <button id ="hide" class="notification">
        <span class="glyphicon glyphicon-bell"></span>
        <span class="badge">

            <!-- Hier wird die Anzahl der ungelesenen Nachrichten angezeigt -->
            <?php
            $statementx = $pdo->prepare("SELECT * FROM notification WHERE user_id = $user");
            $statementx->execute();
            $result = $statementx->rowCount();

            if($result > 0) {
                while ($rowx = $statementx->fetch()) {
                    $number = $rowx["number_count"];
                    echo $number;
                }
            } else {
                echo 0;

            }

            ?>
        </span>
    </button>
    <div class="notify">
        <div id="bell" class="notification-head">Benachrichtigungen</div>
        <div class="hr"></div>
        <!-- Hier werden die ungelesenen Nachrichten in einer Vorschau (nur der Betreff) angezeigt -->
        <?php
        $userID= $_SESSION["user_id"];
        $statement = $pdo->prepare("SELECT * FROM message WHERE message_read IS NULL AND receiver=$userID");
        if($statement->execute()) {
            while ($row = $statement->fetch()) {
                $message_subject=$row['message_subject'];
                $message_id = $row["message_id"]; ?>
    <div class="notification-msg">
                <a class="notification-link" href="show_message_do.php?id=<?php echo $message_id;?>">Betreff: <?php echo $message_subject;?></a><br>
    </div>
        <?php
            }
        }
        ?>
    </div>
</div>

</body>
</html>
