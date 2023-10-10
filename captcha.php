<?php

// Подключаем генератор текста
include("random.php");
// Можно указать любое другое время

function set_captcha(){
	$captcha = generate_code();

// Используем сессию (если нужно - раскомментируйте строчки тут и в go.php)
// session_start();
// $_SESSION['captcha']=$captcha;
// session_destroy();

// Вносим в куки хэш капчи. Куки будет жить 120 секунд.
//$cookie = md5($captcha);
//$cookietime = time()+150;
session_start();
$_SESSION["captcha"]=$captcha; 
//setcookie("captcha", $cookie, $cookietime);
	return $captcha;
}
?>