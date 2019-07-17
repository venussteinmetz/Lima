<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>
<?php
include 'searchbar.php';
include "sidebar2.php";
include "notification.php";
?>

    <html>
    <head>
        <title>Lima</title>
        <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
        <script src="js/general.js"></script>
        <style>

            .all_files {
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
        </style>
    </head>
    <body>

    <div class="all_files">
        <h2> Meine Favoriten: </h2>
        <br>

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
        </table>
    </div>
    </body>
