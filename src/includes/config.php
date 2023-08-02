<?php 
// DB credentials.
define('DB_HOST','db');
define('DB_USER','admin');
define('DB_PASS','1');
define('DB_NAME','library');
define('DB_PORT', 3306);

// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>

