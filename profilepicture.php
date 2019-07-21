<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
if(!isset($_SESSION['user_id'])) {
    header("location: login.php");
    die();
}
?>
<!DOCTYPE html>
<head>
    <title>Lima</title>
    <!-- Profilimg wird gestyled. Scrollt nicht mit dem Viewport mit.  -->
    <style>
#change {
    font-size: 15px;
    align-items: center;
    position: fixed;
    top: -5px;
    right: 80px;
    display: none;
}
#image-pp {
    position: fixed;
    top: 10px;
    right: 80px;
    display: inline-block;
    width: 50px;
    height: 50px;
    border-radius: 50%;

}
</style>
</head>
<body>
    <div class="profile-userpic">
        <?php
        //Datenbankabfrage user und img
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
                            <img id="image-pp" src="pp/'.$image.'">
                            </a>';
                } else {
                    echo "<a href='settings.php'>
                            <img id='image-pp' src='pp/profiledefault.jpeg'>
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
