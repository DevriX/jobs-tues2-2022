<?php
    $cser=mysqli_connect("localhost","root","","JOB_BOARD") or die("connection failed:".mysqli_error());
    $del1 = "DELETE FROM cookies where hash_id = '".$_COOKIE["login"]."'";
    setcookie("login","",time()-1);//for delete the cookie //destroy the cookie 
    $cser->query($del1);
    header("location:index.php"); 
?>