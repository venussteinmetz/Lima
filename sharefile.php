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
    .row-share {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 500px;
    }
    #share2 {
        margin-top: 25px;
        font-size: 20px;
        text-align: center;
    }
    .files-share {
        width: 300px;
        height: 40px;
        padding-left: 10px;
        color: grey;
        font-family: 'Open Sans', sans-serif;
        font-size: 16px;
        box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.3);
        border-radius: 3px;
        outline: none;
    }
    .share-text{
        font-size: 20px;
        padding-bottom: 10px;
    }
    .field-share {
        width: 200px;
        border-radius: 4px;

    }
    .submit-share {
        padding:5px 15px;
        background:lightpink;
        border:0 none;
        cursor:pointer;
        border-radius: 5px;
    }
    .submit-share:hover {
    background-color: lightcoral;
    }

</style>

</head>

<body>
<div id="content">
    <div class="container">
        <div class="row-share">
            <form action="sharefile_do.php" method="post">
                <div class="share-text"> Teile deine Datei mit anderen:<br></div>
                <select class="files-share "name="file" value="">
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
                <p id="share2">Gib hier die E-Mail-Adresse des Nutzers ein:</p>
                <input class="field-share" type="text" name="user_email" placeholder="E-Mail">
                <input class="submit-share" type="submit" value="Datei freigeben">
            </form>
        </div>
    </div>
</div>
</body>
</html>