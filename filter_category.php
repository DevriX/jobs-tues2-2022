<!-- <?php
    //  if($_SERVER["REQUEST_METHOD"] == "GET"){
        
    //     if(!empty($_GET['cat_id'])){
    //         $id = $_GET['cat_id'];  
    //         //$sql = "SELECT  FROM categories WHERE id=".$id;
    //         //SELECT jobs.id, jobs.title, DATEDIFF( CURDATE(), jobs.date_posted) AS 'Date', users.phone_number, users.company_name, users.company_location, users.company_image FROM jobs JOIN users ON users.id = jobs.user_id ORDER BY jobs.date_posted DESC LIMIT $page_first_result, $limit";
    //        // $con->query($sql);
    //         $countryResult = $db_handle->runQuery("SELECT DISTINCT Country FROM tbl_user ORDER BY Country ASC");
    //     }
    // }
?> -->

<?php
    require_once 'db_connection.php';
    function search(){
       if($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["search"])){
            $query = $_GET['search']; 
        $min_length = 2;
        if(strlen($query) >= $min_length){ 
            
           // $query = htmlspecialchars($query); 
            
           // $query = mysql_real_escape_string($query);
            
          //  $raw_results = mysql_query("SELECT * FROM jobs
             $con = OpenCon();
          //   WHERE (`title` LIKE '%".$query."%') OR (`text` LIKE '%".$query."%')") or die(mysql_error());
          $raw_results ="SELECT jobs.id, jobs.title, DATEDIFF( CURDATE(), jobs.date_posted) AS 'Date', users.phone_number, users.company_name, users.company_location, users.company_image FROM jobs JOIN users ON users.id = jobs.user_id WHERE (jobs.title LIKE '%".$query."%')"; 
            return $raw_results;
       }
        
          // $raw_results = mysqli_query($con, "SELECT jobs.id, jobs.title, DATEDIFF( CURDATE(), jobs.date_posted) AS 'Date', users.phone_number, users.company_name, users.company_location, users.company_image FROM jobs JOIN users ON users.id = jobs.user_id WHERE (jobs.title LIKE '%".$query."%')");
            
           // if(mysqli_num_rows($raw_results) > 0){
             //   $jobs = array();
              //  while($results = mysqli_fetch_array($raw_results, MYSQLI_ASSOC)){
               //         $jobs[] = $results; 
               //     }
             ///       return $jobs;
            //     }
                
            // }
            // else{ 
            //     echo "No results";
            // }
        }
       
    }
   
?>