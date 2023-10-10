<?php
session_start();
$enter_site=false;
if(!empty($_SESSION['user'])){
	header("Location: index.php");
}
/*setcookie('login','',time()-1);
setcookie('password','',time()-1);*/
$errors =[];
include 'mainfunction.php';
//include 'captcha.php';
$mainObj = new Main();

//if ($_SESSION ['captcha'] && $_POST ['captcha']  && $_SESSION['captcha'] == $_POST ['captcha']){
	if(!empty(!empty($_POST['login']) && !empty($_POST['password']))){
		//echo $_SESSION ['captcha']==$_POST ['captcha'] ;
		
		
		$enter_site=$mainObj->login($_POST['login'],md5($_POST['password']),$_POST['remember']=="on");
	if($enter_site){
		header("Location: index.php");
			die;
	}else{
		$errors[]="Неверный логин или пароль";
	}/*}
else{
	echo $_SESSION ['captcha']==$_POST ['captcha'] ;
	$errors[]="Неверно введена капча";}*/
		
		
}
/*if(!empty($_POST['captcha'])&&$_SESSION['captcha'] == md5($_POST['captcha'])){
	echo "-------";
	echo $_SESSION['captcha'] == md5($_POST['captcha']);*/
	/*if(!empty(!empty($_POST['login']) && !empty($_POST['password']))){
		
		$enter_site=$mainObj->login($_POST['login'],md5($_POST['password']),$_POST['remember']=="on", md5(($_POST['captcha'])));
	if($enter_site){
		header("Location: index.php");
			die;
	}else{
		$errors[]="Неверный логин или пароль";
	}
	}//}
	else{
		$errors[]="Неверно введениа капча";
	}*/
	
	?>
<?php include("header.php");?>
	<ul>
	<?php
foreach($errors as $error):?>
<li><?=$error?></li>
<?php endforeach;?>
</ul>
	<form method="POST">
		<label for="login">Login</label>
<input id = "login" type="text" name="login">
<label for="password">Password</label>
<input id="password" type="password" name="password">
<input type="checkbox" name="remember"> Запомнить меня
<button type="submit">Вход</button>
	</form>
	<?php include("footer.php");?>