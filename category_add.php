<?php
		if($_SERVER["REQUEST_METHOD"] == "POST"){
            $title = $_POST['title'];
            if(!empty($title)){
                $sql_request = "INSERT INTO categories(title) VALUES ('".$title."')";
                    
                if ($con->query($sql_request) === TRUE) {
                    echo '<div class="success" style=color:#3c71fe>Category created</div>';
                } else {
                    echo "ERROR: " . $sql_request . "<br>";
                }
            }
            
		}
?>