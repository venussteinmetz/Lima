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
        #filesishared {
            position: absolute;
            margin-top: 100px;
            margin-right: 0px;
            left:300px;
            width:50%;
        }
        #sharedfiles {
            position: absolute;
            margin-top: 100px;
            margin-right: 0px;
            left:500px;
            width:50%;
        }
        #externalshare {
            position: absolute;
            margin-top: 100px;
            margin-right: 0px;
            left:300px;
            width:50%;
        }
        html {
            font-family: Avenir;
        }
    </style>
</head>

<body>

<a id="filesishared" href="filesishared.php"><button>Dateien die du geteilt hast</button></a>
<a id="sharedfiles" href="sharedfiles.php"><button>Dateien die mit mir geteilt wurden</button></a>

<br><br>
<a id="externalshare" href="externalshare.php"><button>Dateien die mit externen Nutzern geteilt wurden </button></a>



</body>
</html>
