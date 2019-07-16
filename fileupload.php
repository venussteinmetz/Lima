<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Datei Upload</title>
    <style>
        .all {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100px;
            height: 200px;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }
        html {
            background-image: url("Hintergrund.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        h1 {
            align-items: center;
            font-size: 30px;

        }
        button {
            width: 173px;
            border-radius: 4px;
            background-color: lightpink;
        }
        button:hover {
            background-color: lightcoral;
        }
    </style>
</head>
<body>
<div class="all">
<h1>Datei hochladen</h1>
<form action="uploaddo.php" method="post" enctype="multipart/form-data">
    Datei auswählen:
    <input type="file" name="uploadfile" id="uploadfile"><br>
    <button type="submit" name="action">Upload</button> <a
</form>
</div>
</body>
</html>
