<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));
$owner = $_SESSION["user_id"];

echo "Du hast folgende Dateien freigegeben:"."<br>"."<br>";
$statement = $pdo->prepare("SELECT * FROM file WHERE owner = ?");
$statement->execute(array($owner));
while ($row = $statement->fetch()) {
    $ownedfiles = $row["filename"];
    $fileid = $row["file_id"];

    // Es werden nur die Dateien angezeigt, die der Nutzer mit anderen geteilt hat
        $status = 1;
        $statement2 = $pdo->prepare("SELECT * FROM file WHERE filename =:filename AND access_rights=:access_rights");
        $statement2->bindParam(':filename', $ownedfiles);
        $statement2->bindParam(':access_rights', $status);
        $statement2->execute();
    while ($row2 = $statement2->fetch()) {
        $sharedfiles = $row2["filename"];
        echo $sharedfiles . "<br>";


        $statement5 = $pdo->prepare("SELECT * FROM sharing WHERE file = ?");
        $statement5->execute(array($fileid));
        while ($ro = $statement5->fetch()) {
            $exists = $ro["file"];
            $nonuser = $ro["non_user"];
            if ($exists != "") {
                 ?>
                <td><?php echo $ro["non_user"];?></td>
                <td><a href="undo_externalshare.php?non_user=<?php echo $nonuser;?>&fileid=<?php echo $fileid;?>">Entfernen</a></td>
                <?php
            }
        }


        $statement0 = $pdo->prepare("SELECT * FROM access WHERE file_id = ?");
        $statement0->execute(array($fileid));
        while ($row0 = $statement0->fetch()) {
            $sharedwith = $row0["user_id"];



        ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Einstellung</th>
            </tr>
            <tr>

        <?php
            $statement3 = $pdo->prepare("SELECT * FROM user WHERE userID = ?");
            $statement3->execute(array($sharedwith));
            while ($row3 = $statement3->fetch()) {
                $usertodelete = $row3["userID"];
                ?>
                        <td><?php echo $row3["firstName"]." ".$row3["lastName"];?></td>
                        <td><a href="undo_share.php?usertodelete=<?php echo $usertodelete;?>&fileid=<?php echo $fileid;?>">Entfernen</a></td>

                </tr>
                </table>
<?php


            }
        }

    }

}

?>

