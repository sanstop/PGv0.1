<?php
// Create connection
$link=mysqli_connect("localhost", "pg_rw", "Aug201ac", "mydb");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$dsn = 'mysql:host=localhost;dbname=mydb;charset=utf8';
$user = 'pg_rw';
$password = 'Aug201ac';

try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>