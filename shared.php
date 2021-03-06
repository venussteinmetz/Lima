<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<html>
<head>
    <title>Lima</title>
    <style>
        html {
            font-family: Avenir;
        }
        .youshared {
            overflow-y: scroll;
            font-family: Avenir;
            position: absolute;
            top: 170px;
            left: 300px;
            padding-bottom: 10px;
            min-width: 1000px;
        }
        #shared_files_table {
            position: absolute;
            margin-top: 250px;
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
        .back {
            height: 25px;
            width: 25px;
            margin-top: 15px;
            right: 50px;
        }
    </style>
</head>
<body>

<div><h2 class="youshared">Dateien, die ich mit <b>internen</b> Nutzern geteilt habe:</h2></div>

<table id="shared_files_table">
    <tr id="tr_shared_files">
        <th id="th_shared_files">  Datei </th>
        <th id="th_shared_files"> Freigegeben an</th>
        <th id="th_shared_files"> Freigabe entziehen</th>
    </tr>

    <?php
    //Es werden die Dateien angezeigt, die von dem Nutzer mit internen Nutzern (also Personen, die einen Account bei Lima haben) geteilt wurden
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
                    <td id='td_shared_files'><a href='undo_share.php?usertodelete=$shareduser&fileid=$fileid' ><img class=back src='1.png'></a></td></tr></td>
                  </tr>
                 ";//Bei Klick auf das Icon, kann der Nutzer das Teilen rückgängig machen. Undo_share.php wird ausgeführt.
            }
        }
    }
    ?>
</table>

</body>
</html>
