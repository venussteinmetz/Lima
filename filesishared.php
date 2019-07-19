<?php
include 'profilepicture.php';
include 'notification.php';
include 'sidebar2.php';
include 'searchbar.php';
include 'shared.php';
?>

<html>
<head>
    <title>My shared Files</title>
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

<body>

<a href="sharedfiles.php">
    <button id="sharedfiles"><b>Dateien, die mit mir geteilt wurden</b></button>
</a>

<br><br>
<a href="externalshare.php">
    <button id="externalshare">Dateien, die ich mit <b>externen</b> Nutzern geteilt habe</button>
</a>


</body>
</html>