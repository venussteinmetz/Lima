<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {

            font-family: 'Poppins', sans-serif;
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
            font-size: 25px;
            color: grey;
            display: block;
        }

        .sidenav a:hover {
            color: black;
        }

        .hamburger-button {
            display: block;
            font-size:30px;
            cursor:pointer;
            position: absolute;
            z-index: 10;
        }




        a[data-toggle="collapse"] {
            position: relative;

        }
        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            color: black;

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
    </style>
</head>
<body>

<div id="mySidenav" class="sidenav">
    <a href="index.php">
        <img src="limatransparent.png " alt="Logobild">
    </a>

    <div class="profile-usertitle-name">
        <?php
        $statement = $pdo->prepare('SELECT * FROM user WHERE userID = ?');
        $datensatz = array($_SESSION["user_id"]);
        $statement->execute($datensatz);
        if ($row = $statement->fetch()) {

            echo "Hallo ", $row["firstName"]." ";
        }
        ?>
    </div>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Meine Dateien</a>
            <a href="#">Neuste</a>
            <a href="favorite.php">Favoriten</a>
            <a href="#">Meine Nachrichten</a>
            <a href="#">Meine Ordner</a>
            <a href="#">Logout</a>
    </ul>
</div>




<span style="font-size:30px;cursor:pointer" class="hamburger-button">&#9776;</span>
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
