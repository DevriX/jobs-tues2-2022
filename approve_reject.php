<?php
    require_once 'db_connection.php';

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
        if(!empty($_GET['id'])){
            $id = $_GET['id'];  
            $row = ShowJob($id);
            $con = OpenCon();

            $status = 0;
            if($row["status"] == 0) {
                $status = 1;
            } 
            $sql = "UPDATE jobs SET jobs.status = $status WHERE id = $id";
            $con->query($sql);
            header('location: dashboard.php');
        }
    }
?>