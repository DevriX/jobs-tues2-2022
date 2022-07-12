<?php

    function search(){
       if($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["search"])){
            $query = $_GET['search']; 
            $min_length = 2;
         if(strlen($query) >= $min_length){ 
         
            $raw_results ="SELECT jobs.id, jobs.title, DATEDIFF( CURDATE(), jobs.date_posted) AS 'Date', users.phone_number, users.company_name, users.company_location, users.company_image FROM jobs JOIN users ON users.id = jobs.user_id WHERE (jobs.title LIKE '%".$query."%') ORDER BY jobs.date_posted DESC"; 
               return $raw_results;
         } else {
            return false;
         }
        
        }
       
    }
   
?>