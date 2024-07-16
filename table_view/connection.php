<?php

// Define constants for the database connection

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "*");
define("DBNAME", "clientc"); //DBNAME to be changed here for each new client

// Create a DSN (Data Source Name) connection string
$dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;

try {
    // Create a PDO instance and connect to the database
    $db = new PDO($dsn, DBUSER, DBPASS);
    $db1 = new PDO($dsn, DBUSER, DBPASS);

    // Set character encoding to UTF-8
    $db->exec("SET NAMES utf8");

    // Set PDO error mode to exception for proper error handling
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set the default fetch mode to associative array
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // In case of a connection error, display the error message
    echo $e->getMessage();
}

// Now, the variable $db contains a connection to the database

?>