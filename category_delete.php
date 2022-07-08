<?php
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
        if(!empty($_GET['cat_id'])){
            $id = $_GET['cat_id'];  
            $sql = "DELETE FROM categories WHERE id=".$id;
            $con->query($sql);
            
        }
    }
?>