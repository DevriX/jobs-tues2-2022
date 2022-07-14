<?php
    require_once 'db_connection.php';
    
    $con = OpenCon();

    if(!empty($_POST['id'])){
        $id = $_POST['id'];  
        $sql = "DELETE FROM applications 
                WHERE applications.id = $id";
        $res = $con->query($sql);    
       echo $res;
       die();
    }
?>