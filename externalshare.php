<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
<?php
include 'profilepicture.php';
include 'notification.php';
include 'sidebar2.php';
include 'searchbar.php';
?>
    <html>
    <head>
        <title>Lima</title>
        <style>
            #back {
                height: 25px;
                width: 25px;
                margin-top: 10px;
                margin-right: 10px;
                margin-left: 10px;
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
            .shared{
                position: absolute;
                top: 170px;
                left: 520px;
                padding-bottom: 10px;
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
            #externalshare {
                position: absolute;
                margin-top: 100px;
                margin-right: 0px;
                left:300px;
                width:50%;
            }
        </style>
    </head>
<body>

<div class="shared">Dateien die du geteilt hast:</div>

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
<td id='td_shared_files'><a href='undo_externalshare.php?non_user=$nonuser&fileid=$fileid'><img id=back src='rückgängig.jpg'></a></td>
</tr>";

    }
}

?>
</table>

<a id="filesishared" href="filesishared.php"><button>Dateien die du geteilt hast</button></a>
<a id="sharedfiles" href="sharedfiles.php"><button>Dateien die mit mir geteilt wurden</button></a>
<br><br>

<a id="externalshare" href="externalshare.php"><button>Dateien die mit externen Nutzern geteilt wurden </button></a>

</body>
    </html>