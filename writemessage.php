<?php

session_start();
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<style>
    .textfeld {
        position: absolute;
        top: 20%;
        left: 40%;
        width: 300px;
        height: 100px;

    }
</style>
</head>
<body>
<img src="Hintergrund.png" alt="Hintergrund" class="img-fluid" >
<div class="textfeld">
    <form action="writemessage_do.php" method="post">
        <fieldset>
            <h2>Neue Nachricht schreiben</h2>
            <label>Empfänger: <input type="text" name="receiver" /></label>
            <label>Betreff: <input type="text" name="subject" /></label>
            <label>Nachricht: <textarea name="content" cols="40" rows="10"></textarea></label>
            <input type="submit" name="formaction" value="Nachricht senden" />

        </fieldset>
    </form>
</div>

</body>
</html>
