<?php
  
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
  // Edit customer record
  if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $pharmacy = $pharmacyObj->displyaRecordById($editId, "purchase");
  }
  // Update Record in customer table
  if(isset($_POST['update'])) {
    $pharmacyObj->updateRecord($_POST, "purchase");
  }  
    
?>
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br> 
<div class="container">
  <form action="edit_purchase.php" method="POST">
	<div class="form-group">
	<label for="napplication">Application:</label>
	<select name="napplication" class="form-select" aria-label="Default select example">
			<?php
			$k = 1;

          $pharm = $pharmacyObj->show_application(); 
          foreach ($pharm as $ph) {
						if ($k==$pharmacy['id_application']){
							echo "<option value=".$k++." selected>".$ph['information_app']."</option>";}
							else{
								echo "<option value=".$k++.">".$ph['information_app']."</option>";
							}
	 } ?>
</select>
	</div>
		<div class="form-group">
		<label for="nmedicine">Medicine:</label>
		<select name="nmedicine" class="form-select" aria-label="Default select example">
			<?php
			$k = 1;
          $pharm = $pharmacyObj->show_medicine(); 
          foreach ($pharm as $ph) {
        if ($k==$pharmacy['id_medicine']){
  echo "<option value=".$k++." selected>".$ph['information_med']."</option>";}
	else{
		echo "<option value=".$k++.">".$ph['information_med']."</option>";
	}
	 } ?>
</select>
		</div>
    <div class="form-group">
		<label for="ncount">Count:</label>
      <input type="text" class="form-control" name="ncount" value="<?php echo $pharmacy['count']; ?>" required="">
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