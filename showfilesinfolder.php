<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

$owner=$_SESSION["user_id"];
$foldername = $_GET["folder_name"];
$folderid = $_GET["folder_id"];
?>
<html>
<head>
    <title>Lima</title>
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script src="js/general.js"></script>
    <style>
        #files {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        #file-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            opacity: 50%;
        }
        html  {
            font-family: Avenir;

        }
        table {
            width: 50%;
            margin: 30px;
            border-collapse: collapse;
            text-align: left;
        }
        tr {
            border-bottom: 1px solid #cbcbcb;
        }
        th {
            border: none;
            height: 30px;
            padding: 2px;
        }
        tr:hover {
            background: #F5F5F5;
        }
        .button-add {
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
        .button-add:hover {
            background-color:lightcoral;
        }

    </style>
</head>
<body>

<div id="file-box">
    <a class='button-add' href='addfiletofolder.php?folder_name=<?php echo $foldername;?>&folder_id=<?php echo $folderid;?>'>Datei hinzufügen</a>

    <table id="files">
        <tr>
            <th> Name </th>
            <th> Hochgeladen</th>
            <th> Dateiart</th>
            <th> Runterladen</th>
            <th colspan="2">Aus Ordner Löschen</th>
        </tr>

        <?php

//Es wird zunächst überprüft ob der file_code 0 ist. Ist dies der Fall bedeutet das, dass der Ordner keine Dateien enthält und leer ist.
$statement = $pdo->prepare("SELECT * FROM folders WHERE folder_id = ?");
$statement->execute(array($folderid));
while ($row = $statement->fetch()) {
    if ($row["file_code"] == 0) {
        echo "Es sind noch keine Dateien im Ordner gespeichert";
    } else {

        //Dieser Code wird ausgeführt, wenn der Ordner nicht leer ist. Dann werden die Dateien, die im Ordner gespeichert sind ausgegeben.
        $statement2 = $pdo->prepare("SELECT * FROM fileinfolders WHERE folder_id = ?");
        $statement2->execute(array($folderid));
        while ($row2 = $statement2->fetch()) {
            $fileid = $row2["file_id"];

            $statement3 = $pdo->prepare("SELECT * FROM file WHERE file_id = ?");
            $statement3->execute(array($fileid));
            while ($row3 = $statement3->fetch()) {
                $filename = $row3["filename"];
                $upload_date = $row3["upload_date"];
                $mimetype = $row3["mimetype"];
                ?>

         <tr>
                   <td><?php echo $filename ?></td>
                   <td><?php echo$upload_date ?></td>
                   <td><?php echo$mimetype ?></td>
                   <td> <a href='files_all.php?down=$fileid'>Runterladen</a></td>
                   <td> <a href='deletefilefromfolder.php?fileid=<?php echo $fileid; ?>&folderid=<?php echo $folderid;?>'>Löschen</a></td>
                 </tr>

        <?php
            }
        }
    }
}
?>
    </table>
</div>

</body>
</html>
