<?php
require_once "db_connection.php";


$cser=OpenCon() or die("connection failed:".mysqli_error());

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "login" && !empty($_POST['email']) && !empty($_POST["password"])){

    $res2 = mysqli_query($cser,"select* from users where email='".$_REQUEST['email']."'");
    $db_pass=mysqli_fetch_array($res2);

    if (!password_verify($_REQUEST['password'], $db_pass['password'])){
        echo "Wrong password";
        header("Location: login.php");
        echo '<div class="alert alert-danger" style=color:red>
                Wrong email or password!
            </div>';
        return;
        
    }

    $user_id = intval($db_pass['id']);
    $hash_id = MD5(uniqid());

    if(isset($_POST["remember"])){
        $end_date = date('Y-m-d', strtotime("today". ' + 1 month')); 
        var_dump($end_date)  ;
        //die();
    }
    else{
        $end_date = date(0);
    }
    $sql_request = "INSERT INTO cookies(user_id, hash_id , end_date) VALUES ('".$user_id."', '". $hash_id."', '".$end_date."')";
    $cser->query($sql_request);
    setcookie("login",$hash_id,strtotime($end_date));
    header("Location: index.php");
}
else{
    echo '<div class="alert alert-danger" style=color:red>
            Please insert email or password!
        </div>';
}
?>