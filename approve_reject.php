<?php
    require_once 'db_connection.php';
    
    $con = OpenCon();

    if(!empty($_POST['id'])){
        $id = $_POST['id'];  
        $status = $_POST['status'];

        $sql = "UPDATE jobs SET jobs.status = $status WHERE id = $id";
        $res = $con->query($sql);
        echo $res;
        die();
    }
?>