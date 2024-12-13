
<?php
//c:\xampp\mysql\bin\mysql -u root
//create database db2;
// use db2;
// create table users (..........);
// Set the database access information as constants:
DEFINE ('DB_HOST', "localhost");
DEFINE ('DB_USER', "root");
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_NAME', 'db2');

// Make the connection:
$dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');

?>