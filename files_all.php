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
        #file-box {
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
        .button {
            background-color: lightpink;
            border-radius:42px;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family:Arial;
            font-size:12px;
            padding:9px 13px;
            text-decoration:none;
            text-shadow:0px 1px 0px lightcoral;
        }

    </style>
</head>
<body>

<div id="file-box">

    <table id="files">
        <tr>
            <th> Name </th>
            <th> Hochgeladen</th>
            <th> Dateiart</th>
            <th> Download</th>
            <th> Ordner </th>
            <th> Löschen </th>
            <th> Favorisieren </th>
        </tr>

        <?php
        $userID= $_SESSION["user_id"];
        $statement = $pdo->prepare("SELECT * FROM file WHERE owner = $userID");
        if($statement->execute()) {
            while ($row = $statement->fetch()) {
                $fileid=$row['file_id'];
                $filename=$row['filename'];
                $upload_date=$row['upload_date'];
                $mimetype=$row['mimetype'];

?>
                 <tr>
                   <td><?php echo $filename ?></td>
                   <td><?php echo$upload_date ?></td>
                   <td><?php echo$mimetype ?></td>
                   <td> <a class="button" href='download.php?fileid=<?php echo$fileid; ?>&filename=<?php echo $filename;?>'>Download</a></td>
                   <td> <a class="button" href='addfiletofolder.php?filename=<?php echo $filename;?>&fileid=<?php echo $fileid;?>'>Verschieben</a></td>
                   <td> <a class="button" href='delete_file.php?filename=<?php echo $filename;?>&fileid=<?php echo $fileid;?>'>Löschen</a></td>
                   <td> <a class="button" href='favorite_do.php?fav=<?php echo $fileid;?>'>Favorisieren</a></td>
                 </tr>
        <?php
            }
        }
        ?>
    </table>
</div>

</body>
</html>



