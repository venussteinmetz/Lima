<!-- Fortsetzen der vorhandenen Session.
Verbindung wird zur Datenbank aufgebaut. 
Einbindung der Sidbar, der Notifications, der Searbar und des Profilbildes.-->
<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

include "sidebar2.php";
include "notifications.php";
include 'searchbar.php';
include 'profilepicture.php';

if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}

?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
    <!-- Styling des Containers um die Tabelle und der Tabelle und ihrer Bestandteile.
    Styling der Links durch Pseudoklassen. 
    Responsiveness durch Media Queries.
    Styling der icons in der Tabelle.-->
    <style>
        .container{
            font-family: Avenir;
            position: absolute;
            margin-top: 70px;
            margin-right: 10px;
            left:300px;
            min-width: 500px;
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
<!-- Innerhalb eines Containers ist eine Tabelle die, die hochgeladenen Dateien anzeigt. -->
<div class="container">
    <br>
    <h2> Meine neusten Dateien: </h2>
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
        <!-- SQL-Anfrage: Mit der Anfrage, werden alle Dokumente angefragt, die dem Nutzer gehören. 
        Diese werden so ausgegeben, dass das neuste oben steht und das nur die letzten 5 angezeigt werden. -->
        <?php
        $userID= $_SESSION["user_id"];
        $statement = $pdo->prepare("SELECT * FROM file WHERE owner = $userID ORDER BY upload_date DESC limit 5");
        if($statement->execute()) {
            while ($row = $statement->fetch()) {
                $fileid=$row['file_id'];
                $filename=$row['filename'];
                $upload_date=$row['upload_date'];
                $mimetype=$row['mimetype'];
                /* Die Funktionen Runterladen, Favorisieren und Löschen, werden eingebunden und die gebrauchen 
                Informationen über den URL übergeben. */
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
