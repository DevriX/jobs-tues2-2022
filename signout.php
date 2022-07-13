<?php
    include "db_connection.php";

    $cser=OpenCon() or die("connection failed:".mysqli_error());

    if(isset($_COOKIE["login_one_time"]) ){ 
        $del1 = "DELETE FROM cookies where hash_id = '".$_COOKIE["login_one time"]."'";
        setcookie("login_one_time","",time()-1); 
        $cser->query($del1);
    }
    if(isset($_COOKIE["login"])){
        $del1 = "DELETE FROM cookies where hash_id = '".$_COOKIE["login"]."'";
        setcookie("login","",time()-1);
        $cser->query($del1);
    }

    header("location:index.php"); 
?>