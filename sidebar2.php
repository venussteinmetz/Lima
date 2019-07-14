<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" >
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" ></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" ></script>

        <title>Startseite</title>
        <style>


            #sidebar {
                min-width: 250px;
                max-width: 250px;
                min-height: 100vh;
                /* don't forget to add all the previously mentioned styles here too */
                background-color: #F3F4F4;
                background-repeat: repeat;
                background-size: 12em 6em;
                background-position: 0 0, 8em -2em, 16em -4em;
            }
            #sidebar.active {
                margin-left: -250px;
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

            @media (max-width: 768px) {
                #sidebar {
                    margin-left: -250px;
                }
                #sidebar.active {
                    margin-left: 0;
                }
            }

            body {
                font-family: 'Poppins', sans-serif;

            }

            p {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1em;
                font-weight: 300;
                line-height: 1.7em;
                color: black;
            }

            a, a:hover, a:focus {
                color: inherit;
                text-decoration: none;
                transition: all 0.3s;
            }


            #sidebar ul p {
                color: black;
                padding: 10px;
            }

            #sidebar ul li a {
                padding: 10px;
                font-size: 1.1em;
                display: block;
                color: black;
            }
            #sidebar ul li a:hover {
                color: black;

            }


            #sidebar ul li.active > a, a[aria-expanded="true"] {
                color: black;
                background-color: #F3F4F4;
            }
            ul ul a {
                font-size: 0.9em !important;
                padding-left: 30px !important;

            }

            .profile-usertitle-name {
                font-size: 40px;
                padding-left: 70px;
                align-items: center;
                color: lightpink;
            }
            img {
                max-width: 200px;
                height: 50px;
                float: right;
                margin-right: 40px;
                margin-bottom: 20px;
                margin-top: 20px;

            }
            .button {
                background-color: darkgrey;
                border-radius:70px;
                display:inline-block;
                cursor:pointer;
                color: white;
                font-family:Arial;
                font-size:15px;
                padding:9px 13px;
                text-decoration:none;
                text-shadow:0px 1px 0px lightcoral;
                float: right;
                margin-right: 40px;
                li: hover {background-color: lightcoral};

            }


        </style>

        <script>
            $(document).ready(function () {

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });

            });

        </script>


    </head>

    <body>

        <nav id="sidebar">


            <a href="index.php">
            <img src="limatransparent.png " alt="Logobild">
            </a>

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
                 <ul class="list-unstyled components">

                     <li class="active">
                         <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Meine Dateien</a>
                         <ul class="collapse list-unstyled" id="homeSubmenu">
                             <li>
                                 <a href="#">Zuletzt hinzugefügt</a>
                             </li>
                             <li>
                                 <a href="#">Neuste</a>
                             </li>
                             <li>
                                 <a href="favorite.php">Favoriten</a>
                             </li>
                         </ul>
                     </li>
                <li>
                    <a href="#">Meine Ordner</a>
                </li>
                <li>
                    <a href="show_message.php">Meine Nachrichten</a>
                </li>


                <li>
                    <a href="logout.php">Logout</a>
                </li>


            </ul>
            <a class="button" href="upload.php">Neue Datei hochladen</a>
        </nav>

    </body>

</html>
