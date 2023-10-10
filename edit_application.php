<?php
  
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
  // Edit customer record
  if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $pharmacy = $pharmacyObj->displyaRecordById($editId, "application");
  }
  // Update Record in customer table
  if(isset($_POST['update'])) {
    $pharmacyObj->updateRecord($_POST, "application");
  }  
    
?>
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br> 
<div class="container">
  <form action="edit_application.php" method="POST">
    <div class="form-group">
		<label for="ndate_created">Date created:</label>
      <input type="text" class="form-control" name="ndate_created" value="<?php echo $pharmacy['date_created']; ?>" required="">
    </div>
		<div class="form-group">
		<label for="npharmacy">Pharmacy:</label>
		<select name="npharmacy" class="form-select" aria-label="Default select example">
			<?php
			$k = 1;
          $pharm = $pharmacyObj->show_pharmacy(); 
          foreach ($pharm as $ph) {
        if ($k==$pharmacy['id_pharmacy']){
  echo "<option value=".$k++." selected>".$ph['information']."</option>";}
	else{
		echo "<option value=".$k++.">".$ph['information']."</option>";
	}
	 } ?>
</select>
		</div>
    <div class="form-group">
		<label for="ndate_completion">Date completion:</label>
      <input type="text" class="form-control" name="ndate_completion" value="<?php echo $pharmacy['date_completion']; ?>" required="">
    </div>
    
		
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $pharmacy['id']; ?>">
      <input type="submit" name="update" class="btn btn-primary" style="float:right;" value="Update">
    </div>
  </form>
</div>
<?php }else{
	echo "Доступ запрещен!!!";}?>
	<?php include("footer.php");?>