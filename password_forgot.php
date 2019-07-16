<html>
<head>
    <style>
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
            font-family: 'Poppins', sans-serif;
        }
        .all {
            position: absolute;
            top: 50%;
            left: 55%;
            width: 400px;
            height: 200px;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }
        button {
            height: 25px;
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        button:hover {
            background-color: lightcoral;
        }
        input {
            width: 173px;
            height: 30px;
        }

    </style>

</head>
<body>

</body>

<div class="all">
<?php
$pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset' => 'utf8'));
function random_string() {
    if(function_exists('random_bytes')) {
        $bytes = random_bytes(16);
        $str = bin2hex($bytes);
    } else if(function_exists('openssl_random_pseudo_bytes')) {
        $bytes = openssl_random_pseudo_bytes(16);
        $str = bin2hex($bytes);
    } else if(function_exists('mcrypt_create_iv')) {
        $bytes = random_bytes(16, MCRYPT_DEV_URANDOM);
        $str = bin2hex($bytes);
    } else {
        //Bitte euer_geheim_string durch einen zufälligen String mit >12 Zeichen austauschen
        $str = md5(uniqid('geheim', true));
    }
    return $str;
}
$showForm = true;
if(isset($_GET['send']) ) {
    if(!isset($_POST['email']) || empty($_POST['email'])) {
        $error = "<b>Bitte eine E-Mail-Adresse eintragen</b>";
    } else {
        $statement = $pdo->prepare("SELECT * FROM user WHERE eMail = ?");
        $result = $statement->execute(array($_POST['email']));
        $user = $statement->fetch();
        if($user == false) {
            $error = "<b>Kein Benutzer gefunden</b>";
        } else {
            //Überprüfe, ob der User schon einen Passwortcode hat oder ob dieser abgelaufen ist
            $passwortcode = random_string();
            $date = date("Y-m-d H:i:s");
            $stmt2 = $pdo->prepare("UPDATE user SET passwortcode=:passwortcode, passwortcode_time =:passwortcode_time WHERE userID=:userID");
            $stmt2->bindParam(':passwortcode', $passwortcode);
            $stmt2->bindParam(':passwortcode_time', $date);
            $stmt2->bindParam(':userID', $user["userID"]);
            $stmt2->execute();
            $empfaenger = $user['eMail'];
            $betreff = "Neues Passwort für deinen Account auf Lima";
            $from = "From: Lima <sophia19steinhauer@gmail.com>";
            $url_passwortcode = "https://mars.iuk.hdm-stuttgart.de/~ab247/s19_lima/reset_password.php?userid=".$user['userID']."&code=".$passwortcode; //Setzt hier eure richtige Domain ein
            $text = 'Hallo '.$user['firstName'].',
für deinen Account auf Lima wurde nach einem neuen Passwort gefragt. Um ein neues Passwort zu vergeben, rufe innerhalb der nächsten 24 Stunden die folgende Website auf:
'.$url_passwortcode.'
Sollte dir dein Passwort wieder eingefallen sein oder hast du dies nicht angefordert, so bitte ignoriere diese E-Mail.
Viele Grüße,
dein Lima-Team';
            mail($empfaenger, $betreff, $text, $from);
            echo "Ein Link um dein Passwort zurückzusetzen wurde an deine E-Mail-Adresse gesendet.";
            $showForm = false;
        }
    }
}
if($showForm):
    ?>

    <h1>Passwort vergessen</h1>
    Gib hier deine E-Mail-Adresse ein, um ein neues Passwort anzufordern.<br><br>

    <?php
    if(isset($error) && !empty($error)) {
        echo $error;
    }
    ?>

    <form action="?send=1" method="post">

        <input type="email" name="email"  placeholder="E-Mail"><br>
        <button  type="submit">Neues Passwort</button>
        <a href="login.php">Login</a>
    </form>
</div>
<?php
endif; //Endif von if($showForm)
?>
</html>

