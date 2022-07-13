<?php

// if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "login"){
//     if (!empty($_POST['email']) and !empty($_POST["password"])) {

//         $con = OpenCon();
//         $db_hash = "select users.password from users where email = '".$_POST['email']."' LIMIT 1"; 
//         $result1 = mysqli_query($con, $db_hash);  
//         $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);  
//         $db_pass = $row1["password"];

//         require_once('db_connection.php');
//         $sql = "select id from users where email = '".$_POST['email']."' and password = '".check_hash($_POST["password"], $db_pass)."' LIMIT 1"; 
//         $result2 = mysqli_query($con, $sql);  
//         $row = mysqli_fetch_array($result2, MYSQLI_ASSOC);  
//         $count = mysqli_num_rows($result2);  

//         if($count == 1){
//             if($result123 == NULL){
//                 $sql_req = "INSERT INTO cookies(user_id, hash_id ) VALUES ('".$result_id."', '". $hash_id."')";
//                 if ($cser->query($sql_req) === TRUE) {
//                     setcookie("login_one_time",$hash_id,0);
//                     header("Location: index.php");
//                 }           
//             }     
//         }  
//         else{
//             echo '<div class="alert alert-danger" style=color:red>
//                 Wrong email or password!
//             </div>';
//         }
        
//     } 
//     else{
//         echo '<div class="alert alert-danger" style=color:red>
//                 Please insert email or password!
//             </div>';
//     }
// }
?>