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

    function ShowJobs()
    {
        $con = OpenCon();

        $sql = "SELECT jobs.id, jobs.title, DATEDIFF( CURDATE(), jobs.date_posted) AS 'Date', users.phone_number, users.company_name, users.company_location, users.company_image FROM jobs JOIN users ON users.id = jobs.user_id";
        $result = mysqli_query($con, $sql);  
        
        $jobs = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $jobs[] = $row;
        }
        return $jobs;
    }
 
    function CloseCon($con)
    {
        $con->close();
    }
    function ShowCategory(){
        $con = OpenCon();
        
        $sql = "SELECT title FROM categories";
        $result = mysqli_query($con, $sql);  
        
        $jobs = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $jobs[] = $row; 
        }

        return $jobs;
    }
   
?>
