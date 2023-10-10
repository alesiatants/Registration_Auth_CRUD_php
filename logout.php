<?php
session_start();
include 'mainfunction.php';
  $mainObj = new Main();
	$mainObj->logout();
	header("Location: login.php");
	?>