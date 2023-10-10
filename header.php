<?php
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Админ панель</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Аптека</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
				<?php if(!empty($_SESSION['user'])&&($_SESSION['user']['role_of_user']=='Админ'||$_SESSION['user']['role_of_user']=='Оператор'&&$_SESSION['user']['is_approve']==true)){?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="vedomost.php">Ведомость</a>
        </li>
				<?php }?>
				<?php if(!empty($_SESSION['user'])&& $_SESSION['user']['role_of_user']=='Админ'){?>
        <li class="nav-item">
          <a class="nav-link" href="crud.php">Редактирование таблиц</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="data_users.php">Учетные записи</a>
        </li><?php }?>
				<?php if(empty($_SESSION['user'])){?>
				<li class="nav-item">
          <a class="nav-link" href="login.php">Авторизироваться</a>
        </li>
				<li class="nav-item">
          <a class="nav-link" href="add_user.php">Зарегистрироваться</a>
        </li>
				<?php } ?>
				<?php if(!empty($_SESSION['user'])){?>
				<li class="nav-item">
          <a class="nav-link" href="logout.php">Выйти</a>
        </li>
				<?php }?>
      </ul>
    </div>
  </div>
</nav>