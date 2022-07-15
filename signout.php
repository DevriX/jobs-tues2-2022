<?php
include "db_connection.php";

$cser=OpenCon() or die("connection failed:".mysqli_error());
if(isset($_COOKIE["login"])){
    $del = "DELETE FROM cookies where hash_id = '".$_COOKIE["login"]."'";
    setcookie("login","",time()-1);
    $cser->query($del);
}

header("location:index.php"); 
?>