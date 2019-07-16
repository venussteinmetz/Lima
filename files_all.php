<?php
session_start();

$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>

<html>
<head>
    <title>Lima</title>
    <meta name="viewport" content="width=device-width">
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script src="js/general.js"></script>
    <!--Die Tabelle wird innerhalb der HTML-Seite gestylt-->
    <style>
        #files {
            position: absolute;
            margin-top: 50px;
            margin-right: 10px;
            left:300px;
            width:50%;
        }


        tr {
            border-bottom: 1px solid #cbcbcb;
            text-align: center;


        }
        th {
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


        a:link {
            color: lightpink;
            text-decoration: none;
        }
        a:visited{
            color: lightpink;
        }
        /*  Large Tablet */
        @media screen and (min-width: 768px) and (max-width: 1024px) {
            .container{
                width: 70%;
            }
        }
        /*  Small Tablet */
        @media screen and (min-width: 569px) and (max-width: 767px) {
            .container{
                width: 70%;
            }

        }
    </style>
</head>
<body>



<div class="container">

    <!-- Tabelle: In der über eine SQL-Anfrage alle Dokumente angezeigt werden, die der Nutzer hochgeladen hat -->

    <table id="files">
        <tr>
            <th> Name </th>
            <th> Hochgeladen</th>
            <th> Dateiart</th>
            <th> Runterladen</th>
            <th>Löschen</th>
            <th> Favorisieren </th>
        </tr>

        <!-- SQL-Anfrage: Alle Dokumente in der 'file' Datenbank die die gleiche User ID hat, wie der Nutzer der gerade Online ist.
             Die Inhalte der Datenbank werden in Variablen gespeichert und in der Tabelle ausgegeben.
         -->

        <?php


        $userID= $_SESSION["user_id"];
        $statement = $pdo->prepare("SELECT * FROM file WHERE owner = $userID");
        if($statement->execute()) {
            while ($row = $statement->fetch()) {
                $fileid=$row['file_id'];
                $filename=$row['filename'];
                $upload_date=$row['upload_date'];
                $mimetype=$row['mimetype'];


                echo  "<tr>
                    <td> $filename </td>
                    <td>$upload_date</td>
                    <td>$mimetype</td>
                    <td> <a href='download_do.php?down=$fileid'>&#8595;</a></td>
                    <td> <a href='files_all.php?del=$fileid'>&#128465;</a></td>
                    <td> <a href='favorite_do.php?fav=$fileid'>&#128149;</a></td>
                </tr>";
            }
        }
        ?>
    </table>
</div>
</body>
</html>