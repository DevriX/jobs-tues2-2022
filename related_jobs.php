<?php
    require_once 'db_connection.php';

    function ShowRelJobs($id)
    {
        $row = ShowJob($id);

        $con = OpenCon();
        $sql = "SELECT *,DATEDIFF( CURDATE(), jobs.date_posted) AS 'Date' FROM jobs_categories JOIN jobs ON jobs_categories.job_id = jobs.id JOIN users ON jobs.user_id = users.id WHERE jobs_categories.category_id = ".$row['category_id']." AND jobs.id != ".$row['id']." Order by rand() limit 3";

        $jobs = array();
        $result = mysqli_query($con, $sql);
        while( $row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $jobs[] = $row;
        }

        return $jobs;
    }
?>