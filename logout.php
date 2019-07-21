<!DOCTYPE html>
<head>
  <title>Lima</title>
</head>
<body>
<?php
  //Löscht alle in einer Session registrierten Daten 
session_start();
session_destroy();
header("location:login.php");
?>
</body>
</html>
