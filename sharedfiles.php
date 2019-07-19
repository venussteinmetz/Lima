<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

include 'profilepicture.php';
include 'notification.php';
include 'sidebar2.php';
include 'searchbar.php';

?>
    <html>
<head>
    <style>
        html {
            font-family: Avenir;
        }
        .sharedwithyou {
            position: absolute;
            top: 170px;
            left: 520px;
            padding-bottom: 10px;
        }
        #shared_files_table {
            position: absolute;
            margin-top: 200px;
            margin-right: 0px;
            left:300px;
            width:50%;
            height: 100px;
            overflow-y: scroll;
            font-size: 20px;

        }
        #tr_shared_files {
            border-bottom: 1px solid #cbcbcb;
            text-align: center;
        }
        #th_shared_files {
            width: 10px;
            text-align: center;
        }
        #td_shared_files {
            width: 10px;
            text-align: center;
        }
        .downloadicon {
            height: 25px;
            width: 25px;
        }
        #filesishared {
            position: absolute;
            margin-top: 100px;
            margin-right: 0px;
            left:300px;
            width:50%;
        }
        #sharedfiles {
            position: absolute;
            margin-top: 100px;
            margin-right: 0px;
            left:500px;
            width:50%;
        }
    </style>
</head>
<body>
<div class="sharedwithyou"><b>Dateien die mit dir geteilt wurden:</div>

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

    <a id="filesishared" href="filesishared.php"><button>Dateien die du geteilt hast</button></a>
    <a id="sharedfiles" href="sharedfiles.php"><button>Dateien die mit mir geteilt wurden</button></a>



</table>
</body>
    </html>
