<?php
require 'config.php';

    function OpenCon()
    {
        $host=DB_HOST;
        $user=DB_USER;
        $password=DB_PASS;
        $dbname=DB_NAME;

    $con = new mysqli($host, $user, $password, $dbname) or die ('Could not connect to the database server' . mysqli_connect_error());
    mysqli_select_db($con, $dbname);
    
    return $con;
    }
 
    function CloseCon($con)
    {
        $con->close();
    }
   
?>
