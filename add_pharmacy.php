<?php
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
  // Insert Record in customer table
  if(isset($_POST['submit'])) {
    $pharmacyObj->insertData($_POST, "pharmacy");
  }
?>
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br> 
<div class="container">
  <form action="add.php" method="POST">
    <div class="form-group">
      <label for="name_pharmacy">Name pharmacy:</label>
      <input type="text" class="form-control" name="name_pharmacy" placeholder="Enter name_pharmacy" required="">
    </div>
    <div class="form-group">
      <label for="city">City:</label>
      <input type="text" class="form-control" name="city" placeholder="Enter city" required="">
    </div>
    <div class="form-group">
      <label for="street">Street:</label>
      <input type="text" class="form-control" name="street" placeholder="Enter street" required="">
    </div>
    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" class="form-control" name="phone" placeholder="Enter phone" required="">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
  </form>
</div>
<?php }else{
	echo "Доступ запрещен!!!";}?>
	<?php include("footer.php");?>
