<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["fname"]);
session_destroy();
header("Location:index.php");
?>