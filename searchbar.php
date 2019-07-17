<?php
?>
<html>
<head>
    <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optionales Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Das neueste kompilierte und minimierte JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!--Die Tabelle wird innerhalb der HTML-Seite gestylt-->
    <style>
        .search-box {
            position: absolute;
            top: 50%;
            left: 50%;
        }
        .search-txt{
            height: 40px;
            border-radius: 40px;
            border-color: black;
            width: 500px;
            padding: 10px;
        }
        #search-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

    </style>
</head>

<body>
<form class="search-box" action="search.php" method="post">
    <input class="search-txt" type="text" name="submit-search" placeholder="Suche">
    <button id="search-btn" type="submit" class="btn btn-default">
        <span class="glyphicon glyphicon-search"></span>
    </button>
</form>

</body>
</html>
