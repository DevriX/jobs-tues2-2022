<?php
function filter(){
    if(isset($_GET['filter_id'])){
            $id = $_GET['filter_id'];  
            $sql = "SELECT jobs.id, jobs.title, DATEDIFF( CURDATE(), jobs.date_posted) 
            AS 'Date', users.phone_number, users.company_name, users.company_location, users.company_image 
            FROM jobs_categories 
            JOIN jobs 
            ON jobs_categories.job_id = jobs.id 
            JOIN users 
            ON jobs.user_id = users.id 
            WHERE jobs_categories.category_id = ".$id;
        return $sql;       
    } 
} 
?>