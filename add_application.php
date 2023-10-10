<?php
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
  // Insert Record in customer table
  if(isset($_POST['submit'])) {
    $pharmacyObj->insertData($_POST, 'application');
  }
?>
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br> 
<div class="container">
  <form action="add_application.php" method="POST">
    <div class="form-group">
      <label for="date_created">Date created:</label>
      <input type="date" class="form-control" name="date_created" placeholder="Enter name_medicine" required="">
    </div>
		<div class="form-group">
		<label for="pharmacy">Pharmacy:</label>
		<select name="pharmacy" class="form-select" aria-label="Default select example">
			<?php
			$k = 1;?>
 <option selected disabled>Open this select menu</option>;
 <?php 
          $pharmacy = $pharmacyObj->show_pharmacy(); 
          foreach ($pharmacy as $ph) {
        
  echo "<option value=".$k++.">".$ph['information']."</option>";
	 } ?>
</select>
		</div>

    <div class="form-group">
      <label for="date_completion">Date completion:</label>
      <input type="date" class="form-control" name="date_completion" placeholder="Enter manufacturer" required="">
    </div>
    
    
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
  </form>
</div>
<?php }else{
	echo "Доступ запрещен!!!";}?>
	<?php include("footer.php");?>