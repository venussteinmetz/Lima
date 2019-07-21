<?php
include 'profilepicture.php';
include 'notifications.php';
include 'sidebar2.php';
include 'searchbar.php';
include 'shared.php';

if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}

?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
    <!-- Styling der Dokumenten innerhalb einer Tabelle und der Buttons. 
Styling der Links durch Pseudoklassen.-->
    <style>
        #sharedfiles {
            color: black;
            position: absolute;
            top: 120px;
            left: 300px;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        #sharedfiles:hover {
            background-color: lightcoral;
            text-decoration: none;
        }
        #externalshare {
            color: black;
            position: absolute;
            top: 120px;
            left: 500px;
            width: 300px;
            border-radius: 4px;
            background-color: antiquewhite;
        }
        #externalshare:hover {
            background-color: lightgray;
            text-decoration: none;
        }
        html {
            font-family: Avenir;
        }
    </style>
</head>
<!-- Einbindung der Geteilten Dokumente und die die mit dem Nutzer geteilt wurden. -->
<body>
<a href="sharedfiles.php"><button id="sharedfiles"><b>Dateien, die mit mir geteilt wurden</b></button></a>
<br><br>
<a href="externalshare.php">
    <button id="externalshare">Dateien, die ich mit <b>externen</b> Nutzern geteilt habe</button>
</a>
</body>
</html>
