<?php
  
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
  // Edit customer record
  if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $pharmacy = $pharmacyObj->displyaRecordById($editId, "medicine");
  }
  // Update Record in customer table
  if(isset($_POST['update'])) {
    $pharmacyObj->updateRecord($_POST, "medicine");
  }  
    
?>
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br> 
<div class="container">
  <form action="edit_medicine.php" method="POST">
    <div class="form-group">
      <label for="nmedicine">Name medicine:</label>
      <input type="text" class="form-control" name="nmedicine" value="<?php echo $pharmacy['name_medicine']; ?>" required="">
    </div>
    <div class="form-group">
      <label for="nform">Form:</label>
      <input type="text" class="form-control" name="nform" value="<?php echo $pharmacy['form']; ?>" required="">
    </div>
    <div class="form-group">
      <label for="nmanufacturer">Manufacturer:</label>
      <input type="text" class="form-control" name="nmanufacturer" value="<?php echo $pharmacy['manufacturer']; ?>" required="">
    </div>
		<div class="form-group">
      <label for="ncost">Cost:</label>
      <input type="text" class="form-control" name="ncost" value="<?php echo $pharmacy['cost']; ?>" required="">
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