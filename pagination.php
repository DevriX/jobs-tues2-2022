<?php
if (!isset ($_GET['page']) ) {  
    $page = 1;  	
} 
else{  
    $page = $_GET['page'];
}

$page_first_result = ($page-1) * LIMIT;
function pagination($page, $page_total){
    if(isset($page_total) && $page_total > 1){
        for ($i = 1; $i <= $page_total; $i++) {
            $_GET['page'] = $i;
            $current = "";
            if($i == $page){
                $current = "current";
            }
?>
        <a class='page-numbers <?php echo $current ?>'
        href="<?php echo $_SERVER["PHP_SELF"]."?".http_build_query($_GET);?>">
        <?php
        echo $i;
        ?></a>
<?php
        }
    }
}
?>

    
