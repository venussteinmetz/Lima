<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

$owner = $_SESSION["user_id"];
$filename = $_GET["filename"];
$fileid = $_GET["fileid"];

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
            <form action="addfiletofolder_do.php?filename=<?php echo $filename;?>&fileid=<?php echo $fileid?>" method="post"><br><br>
                In welchen Ordner soll die Datei verschoben werden?<br>
                <select name="folder" value="">
                    <option value="">- Wähle den Ordner -
                        <?php
                        $statement = $pdo->prepare("SELECT * FROM folders WHERE owner = ?");
                        $statement->execute(array($owner));
                        while ($row = $statement->fetch()) {
                            $folder = $row["folder_name"];
                            $folder_id = $row["folder_id"];
                            echo "<option value=\"" . trim($folder) . "\">" . $folder . "\n";
                        }

                        ?>

                </select>
                <input type="submit" value="Verschieben">
            </form>
        </div>
    </div>
</div>
</body>
</html>
