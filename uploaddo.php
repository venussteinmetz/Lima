<?php
session_start();
$pdo=new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de; dbname=u-ab247', 'ab247', 'eezaS8ye3t', array('charset'=>'utf8'));



    $namearray = explode(".", $_FILES["uploadfile"]["name"]);
    $fileName = $_FILES["uploadfile"]["name"];
    $mimetype=$_FILES["uploadfile"]["type"];
    $fileSize=$_FILES["uploadfile"]["size"];
    $filePath= "mars.iuk.hdm-stuttgart.de/home/ab247/public_html/s19_lima/files"."$fileName";
    $owner=$_SESSION['user_id'];
    $favorite = "0";
    $only_name = $namearray[0];


            $statement = $pdo->prepare("SELECT * FROM file WHERE filename = $only_name AND owner = $owner");
            $statement->execute();
            $file = $statement->fetch();
            if ($file !== false) {
                echo 'Dieser Dateiname existiert bereits';
                die();
        }

if (isset($namearray[2])){
    echo ("Ungültiger Dateiname, bitte keine Punkte im Dateiname.");
    die();
}

if($_FILES["uploadfile"]["name"]=="")
{
    echo "Fehler Dateiname.";
    die();
}


if ($_FILES["uploadfile"]["size"] > 25000000) {
    echo"Datei zu groß.";
    die();
}
if(!$error) {
    if ($namearray[1] == "jpg" OR $namearray[1] == "png" OR $namearray[1] == "PNG" OR $namearray[1] == "JPG" OR $namearray[1] == "jpeg" OR $namearray[1] == "gif" OR $namearray[1] == "pdf" OR $namearray[1] == "gif" OR $namearray[1] == "pdf" OR $namearray[1] == "PDF" OR $namearray[1] == "docx" OR $namearray[1] == "DOCX" OR $namearray[1] == "doc" OR $namearray[1] == "DOC" OR $namearray[1] == "php" OR $namearray[1] == "PHP" OR $namearray[1] == "html" OR $namearray[1] == "HTML" OR $namearray[1] == "css" OR $namearray[1] == "CSS" OR $namearray[1] == "xlsx" OR $namearray[1] == "XLSX" OR $namearray[1] == "xls" OR $namearray[1] == "XLS" OR $namearray[1] == "ppt" OR $namearray[1] == "PPT" OR $namearray[1] == "pptx" OR $namearray[1] == "PPTX" OR $namearray[1] == "txt" OR $namearray[1] == "TXT" OR $namearray[1] == "mp3" OR $namearray[1] == "MP3") {
    } else {
        echo "Dateiart nicht zugelassen.";
        die();
    }
}

    $status = 0;
    $stmt = $pdo->prepare("INSERT INTO file (file_id, filename, filetype, filesize, owner, upload_date, access_rights, filepath, mimetype, favorite) VALUES('',:filename,:filetype,:filesize,$owner,CURRENT_TIMESTAMP (),:access_rights ,:filepath,:mimetype,0)");
    $stmt->bindParam('filename', $namearray[0]);
    $stmt->bindParam('filetype', $namearray[1]);
    $stmt->bindParam('filesize', $fileSize);
    $stmt->bindParam('access_rights', $status);
    $stmt->bindParam('filepath', $filePath);
    $stmt->bindParam('mimetype', $mimetype);
    if ($stmt->execute()) {
        echo "Dateiname: " . $_FILES["uploadfile"]["name"] . "<br>";
        echo "Upload erfolgreich";
    }


if (!move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "/home/ab247/public_html/s19_lima/files/".$namearray[0].".".$owner.".".$namearray[1])) {
    echo "Datei nicht hochgeladen";
    die();
}

?>
