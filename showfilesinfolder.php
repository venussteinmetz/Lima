<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$owner=$_SESSION["user_id"];
$foldername = $_GET["folder_name"];
$folderid = $_GET["folder_id"];
?>

<?php
include "searchbar.php";
include "sidebar2.php";
include "notification.php";
?>
<html>
<head>
    <title>Lima</title>
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script src="js/general.js"></script>
    <style>

        #files {
            position: absolute;
            left: 300px;
            margin-top: 90px;

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
            position: absolute;
            left: 900px;
            top: 55px;
        }
        .button-add:hover {
            background-color:lightcoral;
        }
        .trash {
            height: 25px;
            width: 25px;

        }
        .downloadicon {
            height: 25px;
            width: 25px;
            margin-top: 10px;
            margin-right: 10px;
            margin-left: 10px;
        }

    </style>
</head>
<div>

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
                            <td> <a class='link-id' href='download.php?fileid=$fileid&filename=$filename'><img class=downloadicon src='download1.png'></a></td>
                            <td> <a class='link-id' href='deletefilefromfolder.php?del=$fileid'><img class=trash src='muell.png'></a></td>
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