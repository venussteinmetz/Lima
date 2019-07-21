<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}

include 'sidebar2.php';
include "searchbar.php";
include 'profilepicture.php';
include 'notifications.php';
?>

<!DOCTYPE html>
<head>
<style>
    #textfeld {
        position: absolute;
        top: 80px;
        left: 300px;
    }
    #longmail {
        width: 400px;
    }
    #write_button {
        width: 173px;
        border-radius: 4px;
        background-color: lightpink;
    }
    #write_button:hover {
        background-color: lightcoral;
        text-decoration: none;
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
                <button id="write_button" type="submit">Nachricht senden</button> <br>
            </div>
        </fieldset>
    </form>
</div>
</body>
</html>
