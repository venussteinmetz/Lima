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
    <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optionales Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Das neueste kompilierte und minimierte JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!--Die Tabelle wird innerhalb der HTML-Seite gestylt-->
    <style>
        .container{
            overflow-y: scroll;
            font-family: Avenir;
        }
        #files_table {
            position: absolute;
            margin-top: 70px;
            margin-right: 10px;
            left:300px;
            width:50%;
            overflow-y: scroll;
        }
        #tr_files {
            border-bottom: 1px solid #cbcbcb;
            text-align: center;
        }
        #th_files {
            padding-left: 15px;
            padding-right: 15px;
            border-bottom: 1px solid #cbcbcb;
            width: 10px;
            text-align: center;
        }
        #td_files {
            padding-left: 15px;
            padding-right: 15px;
            margin-top: 10px;
            width: 30px;
            text-align: center;
        }
        .link-id:link {
            color: lightpink;
            text-decoration: none;
        }
        .link-id:visited{
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
            margin-top: 10px;
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



<div class="container">

    <!-- Tabelle: In der über eine SQL-Anfrage alle Dokumente angezeigt werden, die der Nutzer hochgeladen hat -->
    <br>
    <table id="files_table">
        <tr id="tr_files">
            <th id="th_files"> Name </th>
            <th id="th_files"> Hochgeladen</th>
            <th id="th_files"> Dateiart</th>
            <th id="th_files"> Herunterladen</th>
            <th id="th_files">Löschen</th>
            <th id="th_files"> Favorisieren </th>
        </tr>

        <!-- SQL-Anfrage: Alle Dokumente in der 'file' Datenbank die die gleiche User ID hat, wie der Nutzer der gerade Online ist.
             Die Inhalte der Datenbank werden in Variablen gespeichert und in der Tabelle ausgegeben.
         -->

        <?php
        $userID= $_SESSION["user_id"];
        $statement = $pdo->prepare("SELECT * FROM file WHERE owner = $userID ORDER BY filename ASC");
        if($statement->execute()) {
            while ($row = $statement->fetch()) {
                $fileid = $row['file_id'];
                $filename = $row['filename'];
                $upload_date = $row['upload_date'];
                $mimetype = $row['mimetype'];
                echo "<tr>
                    <td id='td_files'> $filename </td>
                    <td id='td_files'> $upload_date</td>
                    <td id='td_files'>$mimetype</td>
                    <td> <a class='link-id' href='download.php?fileid=$fileid&filename=$filename'><img class=downloadicon src='download1.png'></a></td>
                    <td> <a class='link-id' href='delete_file.php?del=$fileid'><img class=trash src='muell.png'></a></td>
                     <td><a class='link-id' href='favorite_do.php?fav=$fileid'><img class=star src='star2.png'></a></td></tr>";
            }
        }
        ?>
    </table>
</div>
</body>
</html>
