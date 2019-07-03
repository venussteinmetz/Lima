<?php
session_start();

$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

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
            #all_files{
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                opacity: 50%;
            }
            html  {
                background-image: url("Hintergrund.jpg");
                max-width: 100%;
                height: auto;
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

        </style>
    </head>
    <body>

    <div id="all_files">

        <table id="files">
            <tr>
                <th> Name </th>
                <th> Hochgeladen</th>
                <th> Dateiart</th>
            </tr>

<?php

$userID= $_SESSION["user_id"];
$status= 1;

$statement = $pdo -> prepare ("SELECT * FROM file WHERE owner = $userID AND favorite = $status");
if($statement->execute()) {
    while ($row = $statement->fetch()) {
        $fileid=$row['file_id'];
        $filename=$row['filename'];
        $upload_date=$row['upload_date'];
        $mimetype=$row['mimetype'];
        $favorite=$row['favorite'];


        echo  "<tr>
                    <td> $filename </td>
                    <td>$upload_date</td>
                    <td>$mimetype</td>
               </tr>";
    }
}

?>