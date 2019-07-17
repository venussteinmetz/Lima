<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));

?>
    <html>
    <head>
    </head>
    <link rel="stylesheet" href="search.php">

    <body>

    </body>
    </html>

<?php
$userID =$_SESSION["user_id"];
$search =$_POST['submit-search'];

if (isset($search)) {
    echo "<table id=\"files\">
        <tr>
            <th> Name </th>
            <th> Hochgeladen</th>
            <th> Dateiart</th>
        </tr>";
    $statement = $pdo->prepare ("SELECT * FROM file WHERE owner=$userID AND filename LIKE '%$search%'");
    if ($statement->execute()){
        while ($row = $statement->fetch()) {
            $fileid = $row['file_id'];
            $filename = $row['filename'];
            $upload_date = $row['upload_date'];
            $mimetype = $row['mimetype'];


            echo
            " <tr>
                <td> $filename </td>
                <td>$upload_date</td>
                <td>$mimetype</td>
              </tr>";

        }
    }
    if (empty($search)){
        echo "Es wurde nichts eingegenben";
        exit();
    }
}
?>
