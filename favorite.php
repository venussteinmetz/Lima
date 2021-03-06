<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

include "sidebar2.php";
include "notifications.php";
include 'searchbar.php';
include 'profilepicture.php';
//Sicherheit
if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script src="js/general.js"></script>
    <!-- Tabelle wird gestylt
Responsiv durch Media Queries.
Style der Icons-->
    <style>
        .all_files {
            font-family: Avenir;
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
            width: 20px;
            text-align: center;
        }
        td {
            padding-left: 15px;
            padding-right: 15px;
            margin-top:10px;
            width: 30px;
            text-align: center;
        }
        tr:hover {
            background: #F5F5F5;
        }
        /*  Large Tablet */
        @media screen and (min-width: 768px) and (max-width: 1024px) {
            .all_files{
                width: 70%;
            }
        }
        /*  Small Tablet */
        @media screen and (min-width: 569px) and (max-width: 767px) {
            .all_files{
                width: 70%;
            }
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
<div class="all_files">
    <br>
    <h2> Meine Favoriten: </h2>
    <br>
    <!-- Tabellen Kopf  -->
    <table id="files">
        <tr>
            <th> Name </th>
            <th> Hochgeladen</th>
            <th> Dateiart</th>
            <th> Herunterladen</th>
            <th> Entfavorisieren</th>
        </tr>
        <?php
        //Überprüfung welche Daten welcher Nutzer favorisiert hat
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
                    <td> <a class='link-id' href='download.php?fileid=$fileid&filename=$filename'><img class=downloadicon src='download1.png'></a></td>
                    <td><a href='undofavorite.php?undofav=$fileid'><img class=star src='star1.png'></a></td></tr>
               </tr>";
            }
        }
        ?>
    </table>
</div>
</body>
</html>
