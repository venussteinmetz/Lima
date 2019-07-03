<html>
<head>
    <title>Lima</title>
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script src="js/general.js"></script>
    <style>
        #ausgabe {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

        html  {
            background-image: url("Hintergrund.jpg");
            max-width: 100%;
            height: auto;
            font-family: Avenir;
        }

    </style>

</head>
        <body>



<?php
session_start();

$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

$status=1;
$fav= $_GET["fav"];

$statement = $pdo -> prepare ('UPDATE file SET favorite=:favorite WHERE file_id =:file_id');
$statement->bindParam(':favorite', $status);
$statement->bindParam(':file_id', $fav);
if ($statement->execute()) {
?>


    <div id="ausgabe">
    <?php
    echo "Datei wurde erfolgreich farvorisiert";
}


    ?>

</div>
</body>
</html>









