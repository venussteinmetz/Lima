<?php
session_start();
?>
<?php
include 'searchbar.php';
include "sidebar2.php";
include "notification.php";
?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<style>
    #textfeld {
        position: absolute;
        top: 80px;
        left: 300px;

    }
    #longmail {
        width: 400px;


    }

    button {
        width: 173px;
        border-radius: 4px;
        background-color: lightpink;
    }
    button:hover {
        background-color: lightcoral;
    }
    @media screen and (min-width: 768px) and (max-width: 1024px) {
        #textfeld {
            width: 70%;
        }
        @media screen and (min-width: 569px) and (max-width: 767px) {
            #textfeld{
                width: 70%;
            }
        }
</style>
</head>
<body>
<div id="textfeld">
    <form action="writemessage_do.php" method="post">
        <fieldset>
            <h2>Neue Nachricht schreiben</h2>
            <div id="messageschreiben">
            <label>Empfänger: <input id="longmail" type="text" name="receiver"  /></label> <br>
            <label>Betreff: <input id="longmail" type="text" name="subject" </label> <br>
            <label>Nachricht: <br> <textarea name="content" cols="80" rows="20"></textarea></label> <br>

                <button  type="submit">Nachricht senden</button> <br>
            </div>
        </fieldset>
    </form>
</div>
</body>
</html>
