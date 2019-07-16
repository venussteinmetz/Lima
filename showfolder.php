<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
<html>
<head>
    <style>
        html  {
            background-image: url("Hintergrund.jpg");
            max-width: 100%;
            height: auto;
            font-family: Avenir;

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
        .button:hover {
            background-color:lightcoral;
        }
        .button:active {
            position:relative;
            top:1px;
        }
        #text {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: Arial;
        }
        h2 {
            text-decoration: underline solid;
        }

        #ordner {
            font-size: 25px;
        }

    </style>
</head>
<body>
<div id="text">
    <h2>Deine Ordner:<br></h2>
<div id="ordner">


<?php
$owner=$_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT * FROM folders WHERE owner='$owner'");
$stmt ->execute();
while ($row = $stmt->fetch()) {
    $foldername = $row["folder_name"];
    $folderid = $row["folder_id"];
    echo $foldername;
    ?>

    <a class="button" href="showfilesinfolder.php?folder_name=<?php echo $foldername;?>&folderid=<?php echo $folderid;?>">Öffnen</a>
    <a class="button" href="deletefolder.php?folder_name=<?php echo $foldername;?>&folderid=<?php echo $folderid;?>">Löschen</a><br>


<?php

}

?>
</div>
</div>
</body>
</html>
