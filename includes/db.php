<?php
//$servername = "localhost";
//$username = "sqluser";      
//$password = "sqlpass"; 
//$dbname = "NOTES";       

require_once('config/setenv.php');
require_once('config/config.php');


try {


    $conn = mysqli_connect(servername, username, password, dbname);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }
} catch (Exception $e) {
    echo "Connection failed " . $e->getMessage();
}
    //echo "Connection successful" . "\n";
