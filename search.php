<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
<?php
include "sidebar2.php"
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
                border-bottom: 1px solid #cbcbcb;
                width: 10px;
                text-align: center;
            }
            td {
                width: 30px;
                text-align: center;
            }
            tr:hover {
                background: #F5F5F5;
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
        </tr>";
    $statement = $pdo->prepare ("SELECT * FROM file WHERE owner=$userID AND filename LIKE '%$search%'");
    if ($statement->execute()){
        while ($row = $statement->fetch()) {
            $fileid = $row['file_id'];
            $filename = $row['filename'];
            $upload_date = $row['upload_date'];
            $mimetype = $row['mimetype'];
            echo
            " <tr>
                <td> $filename </td>
                <td>$upload_date</td>
                <td>$mimetype</td>
              </tr>";
        }
    }
    if (empty($search)){
        echo "<h1>Es wurde nichts eingegeben... </h1><br> <h2>Deine Dateien: </h2>";
        exit();
    }
}
?>
    </div>
    </body>
