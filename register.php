<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Lima</title>
    <link rel="stylesheet" type="text/css" href="meinstyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- Das Dokument wird gestylt.  -->
    <style>
        .all {
            position: absolute;
            top: 40%;
            left: 50%;
            width: 100px;
            height: 200px;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }
        html {
            background-image: url("Hintergrund.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        button {
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        button:hover {
            background-color: lightcoral;
        }
        .meldung {
            background-color: transparent;
            position: absolute;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            top:500px;
            width: auto;
            right: 390px;
        }
        h1 {
            align-items: center;
            font-size: 30px;
        }
    </style>
</head>
<body>
<div class="all">

    <h1 id="Überschrift">Registrierung</h1>
    <form  id="text"  action="register.php?register=1" method="post">
        <input type="text" name="firstName" maxlength="200" placeholder="Vorname"><br>
        <input type="text" name="lastName" maxlength="200" placeholder="Nachname"><br>
        <input type="text" name="eMail" maxlength="200" placeholder="E-Mail"><br>
        <input type="password" name="password" placeholder="Passwort"><br>
        <input type="password" name="confirm_password" placeholder="Passwort bestätigen"<br>
        <button type="submit" name="action">Konto erstellen</button> <a href="login.php">Login</a>

    </form>
</div>
<div class="meldung">
    <?php
    session_start();
    $pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
    require "password_hash.php";

    if(isset($_GET['register'])) {
        $error = false;
        if ($_POST['firstName'] == "") {
            $error = true;
            echo "Bitte geben Sie ihren Namen ein." . "<br>";
        }
        if ($_POST['lastName'] == "") {
            $error = true;
            echo "Bitte geben Sie ihren Nachnamen ein." . "<br>";
        }
        if (!preg_match("/[.a-z0-9_-]+@+[.a-z0-9_-]+.+[.a-z0-9_-]{2,}/i", $_POST['eMail'])) {
            $error = true;
            echo "Bitte überprüfen Sie Ihre E-Mail." . "<br>";
        }
        if ($_POST['password'] == "") {
            $error = true;
            echo "Bitte geben Sie ein Passwort an." . "<br>";
        }
        if ($_POST["password"] != $_POST["confirm_password"]) {
            $error = true;
            echo "Passwörter müssen übereinstimmen";
        }
        if (!$error) {
            require "password_hash.php";
        }
        if (!$error) {
            $email = $_POST['eMail'];
            $statement = $pdo->prepare("SELECT * FROM user WHERE eMail = :eMail");
            $result = $statement->execute(array('eMail' => $email));
            $user = $statement->fetch();
            if ($user !== false) {
                echo 'Diese E-Mail-Adresse ist bereits vergeben';
                $error = true;
            }
        }
        $statement2 = $pdo->prepare("INSERT INTO user (firstName, lastName, eMail, password) VALUES (:firstName,:lastName,:eMail,:password)");
        $statement2->bindParam(':firstName', $_POST["firstName"]);
        $statement2->bindParam(':lastName', $_POST["lastName"]);
        $statement2->bindParam(':eMail', $_POST["eMail"]);
        $statement2->bindParam(':password', $password_hash);

        if (!$error) {
            if ($statement2->execute()) {
                echo 'Registrierung erfolgreich!';
                header("location: login.php");
            } else {
                echo 'Datenbank-Fehler:';
                echo $statement2->errorInfo()[2];
                echo $statement2->queryString;
                die();
            }
        }

        $statement3 = $pdo->prepare("SELECT * FROM user WHERE eMail = ?");
        $statement3->execute(array($email));
        $result = $statement3->rowCount();

        if ($result > 0) {
            while ($row = $statement3->fetch()) {
                $userid = $row['userID'];
                $status = 1;
                $statement4 = $pdo->prepare("INSERT INTO profileimg (userid, imgstatus) VALUES (?, ?)");
                $statement4->execute(array($userid, $status));
            }
        } else {
            echo "Error";
        }
    }
    ?>
</div>
</body>
</html>
