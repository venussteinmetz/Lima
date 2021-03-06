<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lima</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Sidebar wird zum Burgerbutton, wenn man den Bildschirm verkleinert durch @media screen. Der Username wird unter 
dem Logoin der Sidebar angezeigt-->
    <style>
        body {
            font-family: Avenir;
        }

        @media screen and (max-width: 600px) {
            .sidenav {
                display: none;
            }
        }
        .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #F3F4F4;
            overflow-x: hidden;
            padding-top: 60px;
        }
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 20px;
            color: grey;
            display: block;
        }
        .sidenav a:hover {
            color: black;
            text-decoration: inherit;
        }
        .hamburger-button {
            display: block;
            font-size:30px;
            cursor:pointer;
            position: fixed;
            z-index: 10;
        }
        .profile-usertitle-name {
            font-size: 35px;
            padding-left: 30px;
            align-items: center;
            color: lightpink;
        }
        img {
            max-width: 200px;
            height: 50px;
            float: right;
            margin-right: 30px;
            margin-bottom: 40px;
        }
        #rosa_hover a:hover{
            background-color: lightpink;
        }
        #new_file {
            position: absolute;
            left: 20px;
            background-color: darkgray;
            font-size: medium;
            border-radius:70px;
            display:inline-block;
            cursor:pointer;
            color: black;
            padding:9px 13px;
            text-decoration:none;
            float: right;
            margin-right: 40px;
        }
        #new_file:hover{
            background-color: lightpink;
            text-decoration: none;
        }
        #sharefile {
            position: absolute;
            top: 600px;
            left: 20px;
            background-color: darkgray;
            font-size: medium;
            border-radius:70px;
            display:inline-block;
            cursor:pointer;
            color: black;
            padding:9px 13px;
            text-decoration:none;
            float: right;
            margin-right: 40px;
            width: 187px;
        }
        #sharefile:hover {
            background-color: lightpink;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div id="mySidenav" class="sidenav">
    <!-- hier wird unser Logo angezeigt --> 
    <a href="index.php">
        <img src="limatransparent.png " alt="Logobild">
    </a>
<!-- hier wird der Username aus der Datenbank user ermittelt und angezeigt --> 
    <div class="profile-usertitle-name">
        <?php
        $statement = $pdo->prepare('SELECT * FROM user WHERE userID = ?');
        $datensatz = array($_SESSION["user_id"]);
        $statement->execute($datensatz);
        if ($row = $statement->fetch()) {
            echo $row["firstName"]." ";
        }
        ?>
    </div>
    <!-- hier werden die wichtigsten Seiten aufgezählt und verlinkt --> 
    <div id="rosa_hover">

        <a href="index.php">Meine Dateien</a>
        <a href="recent.php">Neuste</a>
        <a href="favorite.php">Favoriten</a>
        <a href="sharedfiles.php">Freigabe</a>
        <a href="show_message.php">Nachrichten</a>
        <a href="showfolder.php">Meine Ordner</a>
        <a href="logout.php">Logout</a>
        <br>
    </div>
    
    <!-- hier kann man über Buttons eine neue Datei hochladen oder freigeben --> 
    <div id="buttons">
        <a href="fileupload.php"><button id="new_file">Neue Datei hochladen</button></a>
        <a href="sharefile.php"><button id="sharefile">Datei freigeben</button></a>
    </div>
</div>
    
<!-- Klickt man auf den Burgerbutton der Sidebar verschwindet diese (toogle)und man kann sie durch erneutes 
Drücken wieder erschienen lassen --> 
<span style="font-size:30px;cursor:pointer"  class="hamburger-button">&#9776;</span>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('.hamburger-button').click(function(){
            $('#mySidenav').toggle();
        })
    })
</script>
</body>
</html>
