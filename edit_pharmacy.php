<?php
  
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
  // Edit customer record
  if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $pharmacy = $pharmacyObj->displyaRecordById($editId, "pharmacy");
  }
  // Update Record in customer table
  if(isset($_POST['update'])) {
    $pharmacyObj->updateRecord($_POST, "pharmacy");
  }  
    
?>
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br> 
<div class="container">
  <form action="edit_pharmacy.php" method="POST">
    <div class="form-group">
      <label for="npharmacy">Name pharmacy:</label>
      <input type="text" class="form-control" name="npharmacy" value="<?php echo $pharmacy['name_pharmacy']; ?>" required="">
    </div>
    <div class="form-group">
      <label for="ncity">City:</label>
      <input type="text" class="form-control" name="ncity" value="<?php echo $pharmacy['city']; ?>" required="">
    </div>
    <div class="form-group">
      <label for="nstreet">Street:</label>
      <input type="text" class="form-control" name="nstreet" value="<?php echo $pharmacy['street']; ?>" required="">
    </div>
		<div class="form-group">
      <label for="nphone">Phone:</label>
      <input type="text" class="form-control" name="nphone" value="<?php echo $pharmacy['phone']; ?>" required="">
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