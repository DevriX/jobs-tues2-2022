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

    function ShowJobs()
    {
        $con = OpenCon();

        $sql = "SELECT jobs.id, jobs.title, DATEDIFF( CURDATE(), jobs.date_posted) AS 'Date', users.phone_number, users.company_name, users.company_location, users.company_image FROM jobs JOIN users ON users.id = jobs.user_id";
        $result = mysqli_query($con, $sql);  
        
        $jobs;
        $count = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $jobs[$count] = $row;
            $count = $count + 1;
        }
git
        return $jobs;
    }
 
    function CloseCon($con)
    {
        $con->close();
    }
   
?>
