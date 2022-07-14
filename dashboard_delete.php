<?php
    require_once 'db_connection.php';
    
    $con = OpenCon();
     
    if(!empty($_POST['id'])){
        $id = $_POST['id'];  
        $sql_job = "DELETE FROM jobs WHERE jobs.id = $id";
        $sql_categories = "DELETE FROM  jobs_categories WHERE  jobs_categories.job_id = $id";
        $sql_submissions = "DELETE FROM  applications WHERE  applications.job_id = $id";
        $res = $con->query($sql_job);
        $res1 = $con->query($sql_categories);      
        $res2 = $con->query($sql_submissions);  
        echo $res;
        die();
    }
?>