<!--
Database connection.
-->

<?php
    //define the database credentials
define('DB_SERVER', 'remotemysql.com');
define('DB_USERNAME', 'Fexz7WTpQa');
define('DB_PASSWORD', 'IREHEvij1U');
define('DB_NAME', 'Fexz7WTpQa');
 
    //attempt to connect to database
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
    //check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>