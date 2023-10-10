<?php
  // Include database file

  include 'mainfunction.php';
  $mainObj = new Main();
  // Insert Record in customer table
  if(isset($_POST['submit'])) {
    $mainObj->insertData($_POST, 'users');
  }
?>
<?php include("header.php");?>
<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br> 
<div class="container">
  <form action="add_user.php" method="POST">
    <div class="form-group">
      <label for="login">Login:</label>
      <input type="text" class="form-control" name="login" placeholder="Enter login" required="">
    </div>
		<div class="form-group">
      <label for="password">Password:</label>
      <input id="psw" type="password" class="form-control" name="password" placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Должно содержать не менее одной цифры и одной прописной и строчной буквы, а также не менее 8 и более символов" required="">
			<div id="message">
  <h3>Пароль должен содержать следующее:</h3>
  <p id="letter" class="invalid"><b>Верхнем регистре</b> буквы</p>
  <p id="capital" class="invalid"><b>Заглавные (прописные)</b> буквы</p>
  <p id="number" class="invalid"><b>Числа</b></p>
  <p id="length" class="invalid">Минимум <b>8 символов</b></p>
</div>
		</div>

		<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>
    <div class="form-group">
      <label for="role">Role:</label>
      <select name="role" class="form-select" aria-label="Default select example">
				<option value="Оператор" selected>Оператор</option>
				<option value="Админ">Админ</option> 
			</select>
			</div>
			<?php }?>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email" required="">
    </div>
		<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>
		<div class="form-check">
    <input type="checkbox" class="form-check-input" name="approve" >
    <label class="form-check-label" for="approve">Is approve:</label>
  </div><?php }?>
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
  </form>
</div>
<?php include("footer.php");?>
