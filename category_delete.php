<?php
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
        if(!empty($_GET['id'])){
            $id = $_GET['id'];  
            $sql = "DELETE FROM categories WHERE id=".$id;
            $con->query($sql);
            
        }
    }
?>