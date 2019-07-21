<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

include 'profilepicture.php';
include 'notifications.php';
include 'sidebar2.php';
include 'searchbar.php';
?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
    <style>
        .shared{
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
            left: 300px;
            width: 50%;
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
        #sharedfiles {
            color: black;
            position: absolute;
            top: 120px;
            left: 300px;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        #sharedfiles:hover {
            background-color: lightcoral;
            text-decoration: none;
        }
        #internalshare {
            color: black;
            position: absolute;
            top: 120px;
            left: 500px;
            width: 300px;
            border-radius: 4px;
            background-color: antiquewhite;
        }
        #internalshare:hover {
            background-color: lightgray;
            text-decoration: none;
        }
        #back {
            width: 25px;
            height: 25px;
            margin-top: 15px;
            right: 50px;
        }
    </style>
</head>
<body>
<div><h2 class="shared">Dateien, die ich mit <b>externen</b> Nutzern geteilt habe:</h2></div>
<table id="shared_files_table">
    <tr id="tr_shared_files">
        <th id="th_shared_files">  Datei </th>
        <th id="th_shared_files"> Freigegeben an</th>
        <th id="th_shared_files"> Freigabe entziehen</th>
    </tr>

    <?php
    $currentuser = $_SESSION["user_id"];
    $statement = $pdo->prepare("SELECT * FROM sharing WHERE owner_id = $currentuser");
    $statement->execute();
    while ($row = $statement->fetch()) {
        $nonuser = $row['non_user'];
        $fileid = $row['file'];
        $statement1 = $pdo->prepare("SELECT * FROM file WHERE file_id = $fileid");
        $statement1->execute();
        while ($row1 = $statement1->fetch()) {
            $filename = $row1['filename'];
            echo "<tr id='tr_shared_files'>
<td id='td_shared_files'>$filename</td>
<td id='td_shared_files'>$nonuser</td>
<td id='td_shared_files'><a href='undo_externalshare.php?non_user=$nonuser&fileid=$fileid'><img id=back src='rückgängig.png'></a></td>
</tr>";
        }
    }
    ?>
</table>
<a href="sharedfiles.php">
    <button id="sharedfiles">Dateien, die mit mir geteilt wurden</button>
</a>
<br><br>
<a href="filesishared.php"><button id="internalshare">Dateien, die ich mit <b>internen</b> Nutzern geteilt habe</button></a>
</body>
</html>
