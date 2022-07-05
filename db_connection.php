<?php
    function OpenCon()
    {
        $host="localhost";
        $user="neznam";
        $password="123456789";
        $dbname="JOB_BOARD";

    $con = new mysqli($host, $user, $password, $dbname) or die ('Could not connect to the database server' . mysqli_connect_error());

    return $con;
    }

    function ConnectDB($con)
    {
        $host="localhost";
        $user="neznam";
        $password="123456789";
        $dbname="JOB_BOARD";
        
        $con = mysqli_connect($host, $user, $password,$dbname);
        mysqli_select_db($con, "JOB_BOARD");

    }
 
    function CloseCon($con)
    {
        $con->close();
    }
   
?>

<!-- <?php
		include 'db_connection.php';
		$con = OpenCon();
		ConnectDB($con);
		// echo "Connected Successfully";
		CloseCon($con);
	?> -->
