<?php
    $title = '';

		if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!empty($title)){
                $insert_category["title"] = $_POST["title"];
                $sql_request = "INSERT INTO categories(title) VALUES ('".$title."')";
                    
                if ($con->query($sql_request) === TRUE) {
                    echo '<div class="success" style=color:#3c71fe>Category created</div>';
                } else {
                    echo "ERROR: " . $sql_request . "<br>";
                }
            }
            
		}
?>