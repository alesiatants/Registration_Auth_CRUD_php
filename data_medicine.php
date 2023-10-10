<?php
  
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
  // Delete record from table
  if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
      $deleteId = $_GET['deleteId'];
      $pharmacyObj->deleteRecord($deleteId, "medicine");
  }
     
?> 
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br><br> 
<div class="container">
  <?php
    if (isset($_GET['msg1']) == "insert") {
      echo "<div class='alert alert-success alert-dismissible fade show'>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              Your Registration added successfully
            </div>";
      } 
    if (isset($_GET['msg2']) == "update") {
      echo "<div class='alert alert-success alert-dismissible fade show'>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              Your Registration updated successfully
            </div>";
    }
    if (isset($_GET['msg3']) == "delete") {
      echo "<div class='alert alert-success alert-dismissible fade show'>
              <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'></button>
              Record deleted successfully
            </div>";
    }
  ?>
  <h2>View Records
    <a href="add_medicine.php" class="btn btn-primary" style="float:right;">Add New Record</a>
  </h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name medicine</th>
        <th>Form</th>
        <th>Manufacturer</th>
        <th>Cost</th>
      </tr>
    </thead>
    <tbody>
        <?php 
          $pharmacy = $pharmacyObj->displayData('medicine'); 
          foreach ($pharmacy as $ph) {
        ?>
        <tr>
          <td><?php echo $ph['name_medicine'] ?></td>
          <td><?php echo $ph['form'] ?></td>
          <td><?php echo $ph['manufacturer'] ?></td>
          <td><?php echo $ph['cost'] ?></td>
          <td>
            <a href="edit_medicine.php?editId=<?php echo $ph['id'] ?>" style="color:green">
              <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
            <a href="data_medicine.php?deleteId=<?php echo $ph['id'] ?>" style="color:red" onclick="confirm('Are you sure want to delete this record')">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php }else{
	echo "Доступ запрещен!!!";}?>
	<?php include("footer.php");?>