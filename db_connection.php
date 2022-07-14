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

    function ShowJob($id)
    {
        $con = OpenCon();

        echo $sql = "SELECT jobs.id, jobs.title, jobs.description, jobs.responsibilities, jobs.salary, jobs.status, DATEDIFF( CURDATE(), jobs.date_posted) 
                AS 'Date', users.phone_number, users.company_name, users.company_location, users.company_image, users.company_site, jobs_categories.category_id 
                FROM jobs 
                JOIN users 
                ON jobs.user_id = users.id 
                JOIN jobs_categories 
                ON jobs.id = jobs_categories.job_id 
                WHERE jobs.id = $id";
        $result = mysqli_query($con, $sql);  
        
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    }

    function CloseCon($con)
    {
        $con->close();
    }

    function ShowCategory()
    {
        $con = OpenCon();
        
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($con, $sql);  
        
        $jobs = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $jobs[] = $row; 
        }

        return $jobs;
    }
?>
