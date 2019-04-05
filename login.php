
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
        html {
            background: url(Hintergrund.png) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

        }
    </style>

</head>
<body>
<h1 style="font-family: 'PT Sans Caption'">Login</h1>
<form action="login_do.php" method="post">

    <input type="text" name="login" maxlength="100" placeholder="E-Mail"><br>
    <input type="password" name="password" placeholder="Password"> <br>
    <button style="font-family: 'PT Sans Caption'" type="submit">Anmelden</button> <br>

</form>

<a href="register.php">
    <button style="font-family: 'PT Sans Caption'" type="submit" >Registrieren</button>
</a>
</body>
</html>
