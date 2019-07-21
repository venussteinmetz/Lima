<!DOCTYPE html>
<head>
    <title>Lima</title>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
<style>
    html {
        background-image: url("Hintergrund.png");
    }
    #external_share {
        font-family: Avenir;
        position: absolute;
        top: 50%;
        right:400px;
    }
    #extern_share {
        font-family: Avenir;
        position: absolute;
        top: 50%;
        left:550px;
    }
</style>
</head>
<body>
<?php
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

$string = $_GET["code"];
$statement = $pdo->prepare("SELECT * FROM sharing WHERE random_string = ?");
$statement->execute(array($string));
                    while ($row = $statement->fetch()) {
                        $check = $row["share_id"];
                        $file = $row["file"];

                    }
                    if ($check !="") {
                        echo "<div id='extern_share'>Ihnen wurde diese Datei freigegeben:<br><br>";

                        $statement2 = $pdo->prepare("SELECT * FROM file WHERE file_id = ?");
                        $statement2->execute(array($file));
                        while ($row2 = $statement2->fetch()) {
                            echo "<a href='download.php?filename=";
                            echo $row2['filename'];
                            echo("&fileid=");
                            echo($row2['file_id']."'>");
                            echo$row2['filename'].".".$row2['filetype'];

                            echo "</a><br><br>";
                            echo "Besitzer dieser Datei ist: ";
                            $owner = $row2['owner'];
                            $statement3 = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
                            $statement3->execute(array($owner));
                            while ($row3 = $statement3->fetch()) {
                                echo $row3['firstName']." ".$row3['lastName']."<br><br></div>";
                            }
                        }

                    }
                    else{
                        echo "<div id='external_share'> Ihre Download-Freigabe ist erloschen oder der Besitzer hat Ihnen den Download verwehrt.</div>";
                    }

                    ?>
</body>
</html>
