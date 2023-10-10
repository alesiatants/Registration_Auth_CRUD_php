<?php
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
  // Insert Record in customer table
  if(isset($_POST['submit'])) {
    $pharmacyObj->insertData($_POST, 'purchase');
  }
?>
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br> 
<div class="container">
  <form action="add_purchase.php" method="POST">
	<div class="form-group">
	<label for="application">Application:</label>
	<select name="application" class="form-select" aria-label="Default select example">
			<?php
			$k = 1;?>
 <option selected disabled>Open this select menu</option>;
 <?php 
          $pharmacy = $pharmacyObj->show_application(); 
          foreach ($pharmacy as $ph) {
        
  echo "<option value=".$k++.">".$ph['information_app']."</option>";
	 } ?>
</select>
	</div>
<div class="form-group">
<label for="medicine">Medicine:</label>
		<select name="medicine" class="form-select" aria-label="Default select example">
			<?php
			$k = 1;?>
 <option selected disabled>Open this select menu</option>;
 <?php 
          $pharmacy = $pharmacyObj->show_medicine(); 
          foreach ($pharmacy as $ph) {
        
  echo "<option value=".$k++.">".$ph['information_med']."</option>";
	 } ?>
</select>
</div>

    <div class="form-group">
      <label for="count">Count:</label>
      <input type="text" class="form-control" name="count" placeholder="Enter manufacturer" required="">
    </div>
    
    
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
  </form>
</div>

<?php }else{
	echo "Доступ запрещен!!!";}?>
	<?php include("footer.php");?>