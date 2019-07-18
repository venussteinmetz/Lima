<html>
<head>
    <title>Lima</title>

</head>
<body>

<table id="files_table">
    <tr id="tr_files">
        <th> Besitzer</th>
        <th> Geteilt an:</th>
    </tr>
<?php

session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));


$userID= $_SESSION["user_id"];

$statement = $pdo->prepare("SELECT * FROM access WHERE owner = $userID");
if($statement->execute()) {
    while ($row = $statement->fetch()) {
        $ownerid = $row['owner_id'];
        $userid = $row['user_id'];
        echo "<tr>
                    <td> $ownerid </td>
                    <td> $userid</td>";
    }
}
?>
</table>
</body>
</html>
