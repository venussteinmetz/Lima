<?php

session_start();
?>
<?php
include 'searchbar.php';
include "sidebar2.php";
include "notification.php";
?>
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<style>
    .textfeld {
        position: absolute;
        top: 15%;
        left: 300px;
        width: 300px;
        height: 100px;

    }
    @media screen and (min-width: 768px) and (max-width: 1024px) {
        .textfeld {
            width: 70%;
        }
        @media screen and (min-width: 569px) and (max-width: 767px) {
            .textfeld{
                width: 70%;
            }
        }
        </style>
</head>
<body>
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
