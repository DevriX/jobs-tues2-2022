<?php
    if (isset($_POST['email']) or isset($_POST['password'])) {

        require_once('db_connection.php');
        $con = OpenCon();
        $sql = "select id from users where email = '".$_POST['email']."' and password = '".$_POST['password']."'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
            
        if($count == 1){
            header("Location: http://local.job-board.com/index.php");
        }  
        else {
            echo '<div class="alert alert-danger" style=color:red>
            Wrong email or password!
        </div>';
        }
         
    }

    
?>