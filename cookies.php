<?php

function check_hash($log_hash, $db_hash){
    if(password_verify($log_hash, $db_hash) == true){
        return $db_hash;
    }
    return 0;
}

?>

 <?php


$cser=mysqli_connect("localhost","root","","JOB_BOARD") or die("connection failed:".mysqli_error());
if(isset($_REQUEST['submit'])){
        $a = $_REQUEST['email'];
        $b = $_REQUEST['password'];
        $res2 = mysqli_query($cser,"select password from users where email='$a'");
        $db_pass=mysqli_fetch_array($res2);
        $c = check_hash($b, $db_pass["password"]);

        $res = mysqli_query($cser,"select* from users where email='$a'and password='$c'");
        $result=mysqli_fetch_array($res);

        $result_id = intval($result['id']);
        $hash_id = MD5($result_id);
        
        $date = ("today");
        $end_date = date('Y-m-d', strtotime($date. ' + 1 month'));

       

        $res123 = mysqli_query($cser,"select * from cookies where user_id = '".$result_id."'");
        $result123=mysqli_fetch_array($res123);

        if($result_id == 0){
            echo "Invalid email or password!";
            
        }
        if($result123 != NULL){
             header("location:index.php"); 
         }
        else{
            $sql_request = "INSERT INTO cookies(user_id, hash_id , end_date) VALUES ('".$result_id."', '". $hash_id."', '".$end_date."')";
    
            if ($cser->query($sql_request) === TRUE) {
                setcookie("login",$hash_id,strtotime($end_date));// second on page time
                header("location:index.php"); 
            } else {
                echo "ERROR: " . $sql_request . "<br>";
            }
        }




}











?>
