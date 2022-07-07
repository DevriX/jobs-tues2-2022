<?php
    $insert_category = array(

		"title"   => '',

		);

		$inserts_error = array();

	
		if($_SERVER["REQUEST_METHOD"] == "POST"){

			if(empty($_POST["title"])){
				$inserts_error["title_err"] = "Category name field required.";
			}
			else{
				$insert_category["title"] = $_POST["title"];
			}

			if(empty($inserts_error)){
				$sql_request = "INSERT INTO categories(title) VALUES ('".$insert_category['title']."')";
                
				if ($con->query($sql_request) === TRUE) {
					echo '<div class="success" style=color:#3c71fe>Category created</div>';
				} else {
					echo "ERROR: " . $sql_request . "<br>";
				}
			}
		}
?>