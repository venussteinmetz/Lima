<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$owner = $_SESSION["user_id"];
$foldername = $_GET["folder_name"];
$folderid = $_GET["folder_id"];
?>
<?php
include 'sidebar2.php';
include "searchbar.php";
include 'profilepicture.php';
include 'notifications.php';

?>
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .row {
            position: absolute;
            left: 300px;
            top:90px;
        }
        p {
            margin-top: 25px;
        }
        #submit-share {
            padding:5px 15px;
            background:lightpink;
            border:0 none;
            cursor:pointer;
            border-radius: 5px;
        }
        #submit-share:hover {
            background-color: lightcoral;
        }
    </style>

</head>

<body>
<div id="content">
    <div class="container">
        <div class="row">
            <form action="addfiletofolder_do.php?foldername=<?php echo $foldername;?>&folder_id=<?php echo $folderid?>" method="post"><br><br>
                Welche Datei möchtest du hinzufügen?<br>
                <select  name="file" value="">
                    <option value="">- Wähle die Datei -
                        <?php
                        $statement = $pdo->prepare("SELECT * FROM file WHERE owner = ?");
                        $statement->execute(array($owner));
                        while ($row = $statement->fetch()) {
                            $file = $row["filename"];
                            $file_id = $row["file_id"];
                            echo "<option value=\"" . trim($file) . "\">" . $file . "\n";
                        }
                        ?>

                </select>
                <input id="submit-share" type="submit" value="Hinzufügen">
            </form>
        </div>
    </div>
</div>
</body>
</html>