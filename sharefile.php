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
        html {
            position: absolute;
            background-image: url("lima1.png");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .row {

            position: absolute;
            top: 25%;
            right: 35%;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 500px;
        }
        p {
            margin-top: 25px;
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
<div id="content">
    <div class="container">
        <div class="row">
            <form action="sharefile_do.php" method="post"><br><br>
                <h3> Teile deine Datei mit anderen:</h3><br>
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
                <p id="share2"> <h4> Gib hier die E-Mail-Adresse des Nutzers ein: </h4></p><br>
                <input type="text" name="user_email">

                <input class="button" type="submit" value="Freigeben" </input>

            </form>
        </div>
    </div>
</div>
</body>
</html>
