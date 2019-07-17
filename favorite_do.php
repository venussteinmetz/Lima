<?php
include "sidebar2.php";
?>
<html>
<head>
    <title>Lima</title>
    <script src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script src="js/general.js"></script>
    <style>
        #ausgabe {
            font-family: 'Poppins', sans-serif;
            font-size: medium;
            position: absolute;
            margin-top: 50px;
            margin-right: 10px;
            left:300px;
            width:50%;
        }
        button {
            position: relative;
            top: 50%;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        button:hover {
            background-color: lightcoral;
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
    echo "Datei wurde erfolgreich favorisiert! <br><br><a href=favorite.php><button>Zu meinen Favoriten</button></a> <a href=index.php><button>Zurück zur Startseite</button></a>";
    }
    ?>

</div>
</body>
</html>
