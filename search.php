<?php

   function search($drop_down){
      $query = ""; 
      if($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["search"])){
         $query = $_GET['search']; 
        
   }     
   $raw_results ="SELECT jobs.id, jobs.title, DATEDIFF( CURDATE(), jobs.date_posted) 
                  AS 'Date', users.phone_number, users.company_name, users.company_location, users.company_image 
                  FROM jobs 
                  JOIN users 
                  ON users.id = jobs.user_id 
                  WHERE (jobs.title LIKE '%".$query."%') 
                  ORDER BY ".$drop_down;  
      return $raw_results ;
   }
      

?>