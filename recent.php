<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
<?php
include "sidebar2.php";
include "notifications.php";
include 'searchbar.php';
?>

<html>
<head>
    <title>Lima</title>
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script src="js/general.js"></script>

    <style>
        .container{
            font-family: Avenir;
            position: absolute;
            margin-top: 70px;
            margin-right: 10px;
            left:300px;
            width:50%;
        }
        #tr_files {
            border-bottom: 1px solid #cbcbcb;
            text-align: center;
        }
        #th_files {
            padding-left: 15px;
            padding-right: 15px;
            border-bottom: 1px solid #cbcbcb;
            width: 20px;
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
    <br>
    <h2> Meine neusten Dateien: </h2>
    <br>

    <table id="files_table">
        <tr id="tr_files">
            <th id="th_files"> Name </th>
            <th id="th_files"> Hochgeladen</th>
            <th id="th_files"> Dateiart</th>
            <th id="th_files"> Runterladen</th>
            <th id="th_files">Löschen</th>
            <th id="th_files"> Favorisieren </th>
        </tr>

        <?php
        $userID= $_SESSION["user_id"];
        $statement = $pdo->prepare("SELECT * FROM file WHERE owner = $userID ORDER BY upload_date DESC limit 5");
        if($statement->execute()) {
            while ($row = $statement->fetch()) {
                $fileid=$row['file_id'];
                $filename=$row['filename'];
                $upload_date=$row['upload_date'];
                $mimetype=$row['mimetype'];
                echo  "<tr>
                    <td id='td_files'> $filename </td>
                    <td id='td_files'>$upload_date</td>
                    <td id='td_files'>$mimetype</td>
                    <td> <a class='link-id' href='download.php?fileid=$fileid&filename=$filename'><img class=downloadicon src='download1.png'></a></td>
                    <td> <a class='link-id' href='delete_file.php?del=$fileid'><img class=trash src='muell.png'></a></td>
                    <td><a class='link-id' href='favorite_do.php?fav=$fileid'><img class=star src='star2.png'></a></td></tr>
                </tr>";
            }
        }
        ?>
    </table>
</div>

</body>
</html>
