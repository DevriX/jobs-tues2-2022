<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] === "add"){
    $title = $_POST['title'];
    if(!empty($title)){
        $sql_duplicate = "SELECT * 
                          FROM categories 
                          WHERE title = '".$title."'";
        $result = mysqli_query($con, $sql_duplicate);
        $count = mysqli_num_rows($result);  
        
        if($count){
            echo '<div class="flex-container justified-vertically" style=color:red>This category already exists!</div>'; 
        }
        else {
             $sql_request = "INSERT INTO categories(title) 
                             VALUES ('".$title."')";       
            if ($con->query($sql_request) === TRUE) {
                echo '<div class="flex-container justified-vertically" style=color:#3c71fe>Category created</div>';
            }
            else{
                echo "ERROR: " . $sql_request . "<br>";
            }
        }        
    }
}
?>