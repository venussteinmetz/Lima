<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
include 'sidebar2.php';
include "searchbar.php";
?>
<html>
        <head>
                 <title>Lima</title>
        <style>
        html  {
            font-family: Avenir;
        }
        .button-folder {
            background-color: lightpink;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Avenir;
            font-size:12px;
            padding:9px 13px;
            text-decoration:none;
            text-shadow:0px 1px 0px lightcoral;
            margin-left: 20px;
        }
        .button-folder:hover {
            background-color:lightcoral;
            color: black;
        }
        .button-folder:active {
            position:relative;
            top:1px;
        }
        #text {
            position: absolute;
            margin-top: 80px;
            left: 300px;
            font-family: Avenir;
        }
        #folder {
            font-size: 20px;
        }
        .button-create {
            background-color: grey;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Avenir;
            font-size:12px;
            padding:9px 13px;
            text-decoration:none;
            position: relative;
            left: 300px;
            top: 55px;
        }
        .button-create:hover {
            background-color:lightcoral;
            color: black;
        }

        @media screen and (min-width: 768px) and (max-width: 1024px) {
            #text{
                width: 70%;
            }
        }
        /*  Small Tablet */
        @media screen and (min-width: 569px) and (max-width: 767px) {
            #text{
                width: 70%;
            }
        }
    </style>
</head>
<body>
<div id="text">
    <a class='button-create' href='createfolder.php'>Neuen Ordner erstellen</a>

    <h2>Deine Ordner:<br></h2>
    <div id="folder">
        <table id="folder-table">
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>

            <?php
            $owner=$_SESSION["user_id"];
            $stmt = $pdo->prepare("SELECT * FROM folders WHERE owner='$owner'");
            $stmt ->execute();
            while ($row = $stmt->fetch()) {
                $foldername = $row["folder_name"];
                $folderid = $row["folder_id"];
                echo "<tr>
          <td>$foldername</td>
          
          <td><a class='button-folder' href='showfilesinfolder.php?folder_name=$foldername&folder_id=$folderid'>Öffnen</a></td>
          <td><a class='button-folder' href='deletefolder.php?folder_name=$foldername&folder_id=$folderid'>Löschen</a><br></td>";
            }
            ?>
    </div>
</div>
</body>
</html>
