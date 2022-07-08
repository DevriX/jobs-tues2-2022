<?php
    
    function check_hash($log_hash, $db_hash){
        if(password_verify($log_hash, $db_hash) == true){
            return $db_hash;
        }
        return 0;
    }


    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "login"){
        if (!empty($_POST['email']) and !empty($_POST["password"])) {

            $con1 = OpenCon();
            $db_hash1 = "select users.password from users where email = '".$_POST['email']."' LIMIT 1"; 
            $result1 = mysqli_query($con1, $db_hash1);  
            $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);  
            $count1 = mysqli_num_rows($result1);  
            $db_pass = implode($row1);

            require_once('db_connection.php');
            $con = OpenCon();
            $sql = "select id from users where email = '".$_POST['email']."' and password = '".check_hash($_POST["password"], $db_pass)."' LIMIT 1";  
            $result = mysqli_query($con, $sql);  
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
            $count = mysqli_num_rows($result);  
                
            if($count == 1){
                header("Location: index.php");
            }  
            else {
                echo '<div class="alert alert-danger" style=color:red>
                Wrong email or password!
            </div>';
            }
            
        } else {
            echo '<div class="alert alert-danger" style=color:red>
                Please insert email or password!
            </div>';
        }

    }
?>