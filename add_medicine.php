<?php
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
  // Insert Record in customer table
  if(isset($_POST['submit'])) {
    $pharmacyObj->insertData($_POST, 'medicine');
  }
?>
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br> 
<div class="container">
  <form action="add_medicine.php" method="POST">
    <div class="form-group">
      <label for="name_medicine">Name medicine:</label>
      <input type="text" class="form-control" name="name_medicine" placeholder="Enter name_medicine" required="">
    </div>
		<div class="form-group">
      <label for="form">Form:</label>
      <input type="text" class="form-control" name="form" placeholder="Enter form" required="">
    </div>
    <div class="form-group">
      <label for="manufacturer">Manufacturer:</label>
      <input type="text" class="form-control" name="manufacturer" placeholder="Enter manufacturer" required="">
    </div>
    
    <div class="form-group">
      <label for="cost">Cost:</label>
      <input type="text" class="form-control" name="cost" placeholder="Enter cost" required="">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
  </form>
</div>
<?php }else{
	echo "Доступ запрещен!!!";}?>
	<?php include("footer.php");?>
