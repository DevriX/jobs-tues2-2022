<!-- <?php

// if(!empty($_POST["remember"])) {
// 	setcookie ("email",$_POST["email"],time()+ 60*60*24*365);
// 	setcookie ("password",md5($_POST["password"]),time()+ 60*60*24*365);
// 	echo "Cookies Set Successfuly";
// } else {
// 	setcookie('email', $_POST['email'], false);
// 	setcookie('password', md5($_POST['password']), false);
// 	echo "Cookies Not Set";
// }

?>

<p><a href="index.php"> Go to home Page </a> </p> -->

<?php

$cser=mysqli_connect("localhost","root","","JOB_BOARD") or die("connection failed:".mysqli_error());

if(isset($_REQUEST['submit'])){
    $a = $_REQUEST['email'];
    $b = $_REQUEST['password'];

    $res = mysqli_query($cser,"select* from users where email='$a'and password='$b'");
    $result=mysqli_fetch_array($res);

    if($result){
        if(isset($_REQUEST["remember"]) && $_REQUEST["remember"]==1){
            setcookie("login","1",time()+60);// second on page time 
        }
    }
    else{
	    setcookie("login","1");
	    header("location:index.php");	
    }  
}
else{
	header("location:login.php?err=1");
}
?>
