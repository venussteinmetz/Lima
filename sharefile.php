<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="dashboard3style.css" rel="stylesheet">

<style>
    .row {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 500px;
    }
    p {
        margin-top: 25px;
    }


</style>

</head>

<body>
<div id="content">
    <div class="container">
        <div class="row">
            <form action="sharefile_do.php" method="post"><br><br>
                Teile deine Datei mit anderen:<br>
                <select name="file" value="">
                    <option value="">- Wähle die Datei zur Freigabe -
                        <?php

                        $owner = $_SESSION["user_id"];
                        $statement = $pdo->prepare("SELECT * FROM file WHERE owner = ?");
                        $statement->execute(array($owner));
                        while ($row = $statement->fetch()) {
                            $file = $row["filename"];
                            $file_id = $row["file_id"];
                            echo "<option value=\"" . trim($file) . "\">" . $file . "\n";
                        }

                            ?>

                </select>
                <p id="share2">Gib hier die E-Mail-Adresse des Nutzers ein:</p><br>
                <input type="text" name="user_email">

                <input type="submit" value="Freigeben">
            </form>
        </div>
    </div>
</div>
</body>
</html>