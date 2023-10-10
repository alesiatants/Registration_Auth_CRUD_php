<?php
  
  // Include database file
  include 'mainfunction.php';
  $mainObj = new Main();
  // Edit customer record
  if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $main= $mainObj->displyaRecordById($editId, "users");
  }
  // Update Record in customer table
  if(isset($_POST['update'])) {
    $mainObj->updateRecord($_POST, "users");
  }  
    
?>
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br> 
<div class="container">
  <form action="edit_user.php" method="POST">
    <div class="form-group">
      <label for="nlogin">Login:</label>
      <input type="text" class="form-control" name="nlogin" value="<?php echo $main['login']; ?>" required="">
    </div>

    <div class="form-group">
      <label for="npass">Password:</label>
      <input id="psw" type="password" class="form-control" name="npass" value="<?php echo $main['pass'];?>" required="">
			<div id="message">
				
				 
  <h3>Пароль должен содержать следующее:</h3>
  <p id="letter" class="invalid"><b>Верхнем регистре</b> буквы</p>
  <p id="capital" class="invalid"><b>Заглавные (прописные)</b> буквы</p>
  <p id="number" class="invalid"><b>Числа</b></p>
  <p id="length" class="invalid">Минимум <b>8 символов</b></p>
</div>
		</div>
    <div class="form-group">
      <label for="nrole">Role:</label>
			<select name="nrole" class="form-select" aria-label="Default select example">
			<?php if($main['role_of_user']=="Оператор"){?>
			<option value="Оператор" selected>Оператор</option>
			<option value="Админ">Админ</option>
			<?php } else{?>
				<option value="Оператор">Оператор</option>
			<option value="Админ" selected>Админ</option>
			<?php }?>
</select>
      </div>
		<div class="form-group">
      <label for="nemail">Email:</label>
      <input type="email" class="form-control" name="nemail" value="<?php echo $main['email']; ?>" required="">
    </div>
		<div class="form-check">
    <input type="checkbox" class="form-check-input" name="napprove" <?php if($main['is_approve']){?> checked <?php }else{}?>>
    <label class="form-check-label" for="napprove">Is approve:</label>
  </div>

	
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $main['id']; ?>">
      <input type="submit" name="update" class="btn btn-primary" style="float:right;" value="Update">
    </div>
  </form>
</div>
<?php }else{
	echo "Доступ запрещен!!!";}?>
	<?php include("footer.php");?>