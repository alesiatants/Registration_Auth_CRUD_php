
<?php include("header.php");
/*if(empty($_SESSION['user'])){
	header("Location: login.php");
}*/
$count = isset($_COOKIE["count"]) ? $_COOKIE["count"] : "0";
$data = isset($_COOKIE['data'])?$_COOKIE['data']:'не было';
 
if(!isset($_SESSION['login'])&&isset($_COOKIE['login'])){
	$_SESSION['login']=$_COOKIE['login'];
}
if(!isset($_SESSION['password'])&&isset($_COOKIE['password'])){
	$_SESSION['password']=$_COOKIE['password'];
}
if(!isset($_SESSION['role_of_user'])&&isset($_COOKIE['role_of_user'])){
	$_SESSION['role_of_user']=$_COOKIE['role_of_user'];
}
if(!isset($_SESSION['is_approve'])&&isset($_COOKIE['is_approve'])){
	$_SESSION['is_approve']=$_COOKIE['is_approve'];
}?>
<?php if(!empty($_SESSION['user'])){
	echo "Количество посещений: ".$count."<br/>Время  последнего посещения:".$data;
?>
	<ul>
		<li><?= "Welcome, " . $_SESSION['user']['login'];?></li>
		<li><a href="logout.php">Выход</a></li>
</ul>
<?php }?>
<?php include("footer.php");?>