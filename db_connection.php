<?php
require 'config.php';

    function OpenCon()
    {
        $host=DB_HOST;
        $user=DB_USER;
        $password=DB_PASS;
        $dbname=DB_NAME;

    $con = new mysqli($host, $user, $password, $dbname) or die ('Could not connect to the database server' . mysqli_connect_error());

    return $con;
    }

    function ConnectDB($con)
    {
        $host=DB_HOST;
        $user=DB_USER;
        $password=DB_PASS;
        $dbname=DB_NAME;
        
        $con = mysqli_connect($host, $user, $password,$dbname) or die ('Failed connection to database' . mysqli_connect_error());
        mysqli_select_db($con, $dbname);

    }
 
    function CloseCon($con)
    {
        $con->close();
    }
   
?>

<?php
		// include 'db_connection.php';
		// $con = OpenCon();
		// ConnectDB($con);
		// // echo "Connected Successfully";
		// CloseCon($con);
	?>