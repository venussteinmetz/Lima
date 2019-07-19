<?php

session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
<html>
<head>
    <title>Lima</title>
    <style>
        html {
            font-family: Avenir;
        }
        .youshared {
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
        .back {
            height: 25px;
            width: 25px;
        }
    </style>
</head>
<body>

<div class="youshared">Dateien die du geteilt hast:</div>

<table id="shared_files_table">
    <tr id="tr_shared_files">
        <th id="th_shared_files">  Datei </th>
        <th id="th_shared_files"> Freigegeben an</th>
        <th id="th_shared_files"> Freigabe entziehen</th>
    </tr>

    <?php
$currentuser = $_SESSION["user_id"];

$statement = $pdo->prepare("SELECT * FROM access WHERE owner_id = $currentuser");
$statement->execute();
    while ($row = $statement->fetch()) {
        $shareduser = $row['user_id'];
        $fileid = $row['file_id'];

        $statement2 = $pdo->prepare("SELECT * FROM file WHERE file_id = $fileid");
        $statement2->execute();
    while($row2 = $statement2->fetch()) {
        $filename = $row2['filename'];

        $statement3 = $pdo->prepare("SELECT * FROM user WHERE userID = $shareduser");
        $statement3->execute();
        while($row3 = $statement3->fetch()) {
            $sharedmail = $row3['eMail'];

            echo "<tr id='tr_shared_files'>
                    <td id='td_shared_files'>$filename</td>
                    <td id='td_shared_files'>$sharedmail</td>
                    <td id='td_shared_files'><a href='undo_share.php?usertodelete=$shareduser&fileid=$fileid' ><img class=back src='rückgängig.jpg'></a></td></tr></td>
                  </tr>
                 ";
        }
    }
}
?>
</table>

</body>
</html>
