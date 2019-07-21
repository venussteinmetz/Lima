<!DOCTYPE html>
<head>
    <title>Lima</title>
     <!-- Das neueste kompilierte und minimierte CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- Optionales Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Searchbar ist responsive und verschwindet durch @media screen, visibility: hidden, bei max-width:900px -->
    <style>
        .search-box {
            position: absolute;
            left: 300px;
            margin-top:15px;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            width: 100%;
        }
        .search-txt {
            height: 40px;
            border-radius: 40px;
            border-color: black;
            padding: 10px;
            width: 72%;
            outline: none;
        }
        #search-btn {
            margin-top: 0;
            /*     order: 2; */
            border-radius: 50%;
        }
        @media screen and (max-width: 900px) {
            .search-box {
                visibility: hidden;
                flex-direction: row;
                width: 40%;
                min-width: 700px;
            }
            #search-btn {
                margin-top: 0;
                /*     order: 2; */
            }
            .search-txt {
                width: 72%;
            }
        }
        @media screen and (min-width: 700px) {
            .search-box {
                flex-direction: row;
                width: 40%;
            }
        }
    </style>
</head>
<body>
    <!-- Suche erfolgt über Formulareingabe. Man wird weitergeleitet zu search.php --> 
<form class="search-box" action="search.php" method="post">
    <input class="search-txt" type="text" name="submit-search" placeholder="Suche nach Datei">
    <!--Suchbutton mit Lupe --> 
    <button id="search-btn" type="submit" class="btn btn-default">
        <span class="glyphicon glyphicon-search"></span>
    </button>
</form>

</body>
</html>
