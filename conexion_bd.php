<?php

$host='localhost';
$dbname='getNumber';
$username='root';
$password='';

// MySQL/MariaDB
$dbh = new PDO('mysql:host=' . $host . ';dbname=' .$dbname, $username, $password);

?>