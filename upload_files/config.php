<?php
    //define the database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'inklokappdb');
 
    //attempt to connect to database
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
    //check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>