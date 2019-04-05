<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sidebar</title>

    <!-- Bootstrap einbinden  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <!-- Externes Stylesheet CSS -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
<div class="wrapper">

    <!-- Sidebar Menü mit allen Links und deren Namen -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Lima </h3>
        </div>

        <!-- Sidebar Links -->
        <ul class="more">
            <li>
                <a href="#">Neu</a>
            </li>
            <li>
                <a href="#">Start</a>
            </li>
            <li>
                <!-- Links mit Dropdown Menü -->
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Dateien</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Alle Dateien</a>
                    </li>
                    <li>
                        <a href="#">Favoriten</a>
                    </li>
                    <li>
                        <a href="#">Neuste</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <button type="button" id="sidebarCollapse" class="navbar-btn">
            <!-- keine semantische Bedeutung und bewirkt nichts. Es ist dazu gedacht, um mit Hilfe von CSS formatiert zu werden -->
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

</div>

<!-- Hierbei wird die Sidebar ein- und ausgefahren wenn man auf das Hamburger-Menü klickt -->
<script>
    $(document).ready(function () {

        $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        });
    });
</script>
</body>

</html>