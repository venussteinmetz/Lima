<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
include 'profilepicture.php';
include 'notifications.php';
include 'sidebar2.php';
include 'searchbar.php';
?>
<html>
<head>
    <style>
        h2 {
            font-family: Avenir;
        }
        .sharedwithyou {
            overflow-y: scroll;
            font-family: Avenir;
            position: absolute;
            top: 270px;
            left: 300px;
            padding-bottom: 10px;
        }
        #shared_files_table {
            position: absolute;
            margin-top: 400px;
            margin-right: 10px;
            left:300px;
            width:50%;
            overflow-y: scroll;
        }
        #tr_shared_files {
            border-bottom: 1px solid #cbcbcb;
            text-align: center;
        }
        #th_shared_files {
            padding-left: 15px;
            padding-right: 15px;
            border-bottom: 1px solid #cbcbcb;
            width: 10px;
            text-align: center;
        }
        #td_shared_files {
            padding-left: 15px;
            padding-right: 15px;
            margin-top: 10px;
            width: 30px;
            text-align: center;
        }

        .link-id:link {
            color: lightpink;
            text-decoration: none;
        }
        .link-id:visited{
            color: lightpink;
        }
        .downloadicon {
            height: 25px;
            width: 25px;
        }
        #filesishared {
            color: black;
            position: absolute;
            top: 120px;
            left: 300px;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }

        #filesishared:hover {
            background-color: lightcoral;
            text-decoration: none;
        }

    </style>
</head>
<body>

<div class="sharedwithyou"><h2>Dateien, die mit mir geteilt wurden:</h2><br><br></div>

<table id="shared_files_table">
    <tr id="tr_shared_files">
        <th id="th_shared_files"> Datei </th>
        <th id="th_shared_files"> Freigegeben von </th>
        <th id="th_shared_files"> Download </th>
    </tr>




    <?php
    $currentuser=$_SESSION["user_id"];
    $statement = $pdo->prepare("SELECT * FROM access WHERE user_id = ?");
    $statement->execute(array($currentuser));
    while ($row = $statement->fetch()) {
        $file = $row["file_id"];
        $statement2 = $pdo->prepare("SELECT * FROM file WHERE file_id = ?");
        $statement2->execute(array($file));
        while ($row2 = $statement2->fetch()) {
            $filename = $row2['filename'];
            $fileid = $row2['file_id'];
            $sql3 = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
            $sql3->execute(array($row2["owner"]));
            while ($row3 = $sql3->fetch()) {
                $ownerfile = $row3["eMail"];
                echo "<tr>
                    <td id='td_shared_files'>$filename</td>
                    <td id='td_shared_files'>$ownerfile</td>
                    <td id='td_shared_files'> <a class='link-id' href='download.php?fileid=$fileid&filename=$filename'><img class=downloadicon src='download1.png'></a></td></tr>";
            }
        }
    }
    ?>

    <a href="filesishared.php"><button id="filesishared"><b>Dateien, die ich geteilt habe</b></button></a>



</table>
</body>
</html>
