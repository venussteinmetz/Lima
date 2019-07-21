<!DOCTYPE html>
<head>
  <title>Lima</title>
</head>
<body>
<?php
session_start();
session_destroy();
header("location:login.php");
?>
</body>
</html>
