<?php
    require_once 'db_connection.php';
    
    $con = OpenCon();
     
    if(!empty($_GET['APP_ID'])){
        $id = $_GET['APP_ID'];  
        $sql = "DELETE FROM apptications WHERE applications.id = $id";
        $res = $con->query($sql);    
        echo $res;
        die();
    }
?>