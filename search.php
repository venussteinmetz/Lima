<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
<?php
include "sidebar2.php";
include 'notification.php';
include 'searchbar.php';
?>
    <html>
    <head>
        <style>
            h1 {
                font-family: Avenir ;
            }
            #ergebnis {
                position: absolute;
                margin-top: 70px;
                margin-right: 10px;
                left:300px;
                width:50%;
            }
            tr {
                border-bottom: 1px solid #cbcbcb;
                text-align: center;
            }
            th {
                padding-left: 15px;
                padding-right: 15px;
                border-bottom: 1px solid #cbcbcb;
                width: 10px;
                text-align: center;
            }
            td {
                padding-left: 15px;
                padding-right: 15px;
                width: 30px;
                text-align: center;
            }
            tr:hover {
                background: #F5F5F5;
            }
            .trash {
                height: 25px;
                width: 25px;
                margin-top: 10px;
                margin-right: 10px;
                margin-left: 10px;
            }
            .star {
                height: 25px;
                width: 25px;
                margin-top:10px;
                margin-right: 10px;
                margin-left: 10px;
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

    <body>

<div id="ergebnis">

<?php
$userID =$_SESSION["user_id"];
$search =$_POST['submit-search'];
if (isset($search)) {
    echo "<table id=\"files\">
        <tr>
            <th> Name </th>
            <th> Hochgeladen</th>
            <th> Dateiart</th>
            <th id=\"th_files\"> Runterladen</th>
            <th id=\"th_files\">Löschen</th>
            <th id=\"th_files\"> Favorisieren </th>
        </tr>";
    $statement = $pdo->prepare ("SELECT * FROM file WHERE owner=$userID AND filename LIKE '%$search%'");
    if ($statement->execute()){
        while ($row = $statement->fetch()) {
            $fileid = $row['file_id'];
            $filename = $row['filename'];
            $upload_date = $row['upload_date'];
            $mimetype = $row['mimetype'];
            echo
            "<tr>
                <td> $filename </td>
                <td>$upload_date</td>
                <td>$mimetype</td>
                <td> <a class='link-id' href='download.php?fileid=$fileid&filename=$filename'><img class=downloadicon src='download1.png'></a></td>
                <td> <a class='link-id' href='delete_file.php?del=$fileid'><img class=trash src='muell.png'></a></td>
                <td><a class='link-id' href='favorite_do.php?fav=$fileid'><img class=star src='star2.png'></a></td></tr>
              </tr>";
        }
    }
    if (empty($search)){
        echo "<h1>Es wurde nichts eingegeben... </h1><br> <h2>Deine Dateien: </h2>";}
        else {
            echo " <br><h1>Suchergebnisse:</h1><br>";
        }
    exit();
};

?>
    </div>
    </body>
