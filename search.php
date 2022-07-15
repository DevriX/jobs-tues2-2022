<?php
function search_filter($drop_down){
   $query = "";
   $filter_request = array(
      'join' => "",
      'where' => ""
   );
   if(isset($_GET['filter'])){
      $filter_request = array(
         'join' => "JOIN jobs_categories ON jobs.id = jobs_categories.job_id",
         'where'=> "AND jobs_categories.category_id IN (".implode(',', $_GET['filter']). ")"
      ); 
   }
   
   if($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["search"])){
      $query = $_GET['search']; 
      $raw_results ="SELECT jobs.id, jobs.title, DATEDIFF( CURDATE(), jobs.date_posted) 
      AS 'Date', users.phone_number, users.company_name, users.company_location, users.company_image 
      FROM jobs 
      ".$filter_request['join']."
      JOIN users 
      ON users.id = jobs.user_id  
      WHERE (jobs.title LIKE '%".$query."%')
      ".$filter_request['where']." 
      ORDER BY ".$drop_down;  
   } 
   else{
   $raw_results = "SELECT jobs.id, jobs.title, jobs.status, DATEDIFF( CURDATE(), jobs.date_posted) 
                  AS 'Date', users.phone_number, users.company_name, 
                  users.company_location, users.company_image
                  FROM jobs 
                  ".$filter_request['join']."
                  JOIN users 
                  ON users.id = jobs.user_id
                  WHERE 1 = 1 ".$filter_request['where']." 
                  AND jobs.status = 1
                  ORDER BY $drop_down";
   }     
   return $raw_results ;
}
?>