<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        // Wenn man auf die Nachrichtenbox klickt, wird die Vorschau der ungelesenen Nachrichten ausgefahren, bzw. wieder eingefahren wenn man erneut draufklickt
        $(document).ready(function(){
            $("#profile").click(function(){
                $("#change").toggle();
            });
        });
    </script>
    <style>
body {
    font-family: "Avenir";
}


.profile-userpic img{
    position: absolute;
    top: -5px;
    right: 80px;
    display: inline-block;
    width: 50px;
    height: 50px;
    border-radius: 50%;

}
#change {
    font-size: 15px;
    align-items: center;
    position: absolute;
    top: -5px;
    right: 80px;
    display: none;
}

</style>
</head>
<body>


    <div class="profile-userpic">
        <?php
        $statement = $pdo->prepare('SELECT * FROM user WHERE userID = ?');
        $datensatz = array($_SESSION["user_id"]);
        $statement->execute($datensatz);
        if ($row = $statement->fetch()) {
            $id = $_SESSION["user_id"];
            $imgstatement = $pdo->prepare('SELECT * FROM profileimg WHERE userid = ?');
            $imgdatensatz = array($_SESSION["user_id"]);
            $imgstatement->execute($imgdatensatz);
            while ($imgrow = $imgstatement->fetch()) {
                $image = $imgrow["imgpath"];
                echo "<div>";
                if($imgrow["imgstatus"] == 0) {
                    echo '<a href="settings.php">
                            <img src="pp/'.$image.'">
                            </a>';
                } else {
                    echo "<a href='settings.php'>
                            <img id=profile src='pp/profiledefault.jpeg'>
                            </a>";

                }
                echo "</div>";
            }
        }
        ?>
    </div>
  <a id="change" href="settings.php">Profilbild ändern</a>
</body>
</html>


