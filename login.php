<!doctype html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <meta charset="utf-8">
    <title>Lima</title>
    <!-- Hier wird der Style definiert.
Zuerst wird das gesamte html-tag gestylt mit einem Bild. 
Der Hauptteil ist das Html-Formular. 
Unter Angaben wird die Position bestimmt die, die PHP Satements ausgeben. -->
    <style>
        html {
            background-image: url("lima1.png");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .hauptteil {
            position: absolute;
            top: 60%;
            left: 50%;
            width: 100px;
            height: 200px;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }
        button {
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        button:hover {
            background-color: lightcoral;
        }
     
        .angaben {
            background-color: transparent;
            position: absolute; 
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            top:480px;
            width: auto;
            right: 420px;
        }
        .registrieren {
            width: 500px;
        }
    </style>
</head>

<body>
<div class="angaben">
    <?php
    session_start();
    $user = $_SESSION['user_id'];
    $pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
    require "password_hash.php";
    $error= false;

//Überprüfung was passiert wenn nichts eingegben ist. 
    if(isset($_GET['login'])) {

        if (empty($_POST['password'])) {
            $error = true;
            echo "Bitte geben Sie ein Passwort an." . "<br>";
        }
        if (empty($_POST['eMail'])) {
            $error = true;
            echo "Bitte geben Sie eine E-Mail an.";
        }
        
        if (!$error) {
            $statement = $pdo->prepare('SELECT * FROM user WHERE eMail = ?');
            $datensatz = array($_POST["eMail"]);
            $statement->execute($datensatz);
            while ($row = $statement->fetch()) {
                $pass = $row ["password"];
                $user = $row ["userID"];
            }
         //Überprüft ob Passwort und Hash zusammenpassen
            $x = password_verify($_POST["password"], $pass);
            if ($x == true) {
                $_SESSION ["user_id"] = $user;
                header("location: index.php");
            } else {
                echo "Passwort falsch";
            }
        }
    }
    ?>
</div>
    <!-- HTML-Formular für das Login -->
    <div class="hauptteil">
        <form action="login.php?login=1" method="post">
            <input type="text" name="eMail" maxlength="100" placeholder="E-Mail"><br>
            <input type="password" name="password" placeholder="Passwort"> <br>
            <button  type="submit">Anmelden</button> <br>
        </form>
        <!-- Verlinkung durch Buttons auf Registriern und Passwort vergessen -->
        <div class="registrieren">
            <a href="password_forgot.php">Passwort vergessen?<br></a>
            <a href="register.php">Registrieren</a>
        </div>
    </div>
    </div>
    </body>
</html>
