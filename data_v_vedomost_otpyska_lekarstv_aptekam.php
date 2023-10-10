<?php
  
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
  // Delete record from table
  
     
?> 
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="card text-center" style="padding:15px;">
  <h4>PHP: CRUD (Add, Edit, Delete, View) Application using OOP (Object Oriented Programming) and MYSQL</h4>
</div><br><br> 
<div class="container">
  
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Num application</th>
        <th>Name medicine</th>
        <th>Manufacturer</th>
        <th>Count</th>
				<th>Cost</th>
				<th>Total sum</th>
      </tr>
    </thead>
    <tbody>
        <?php 
          $pharmacy = $pharmacyObj->displayData('v_vedomost_otpyska_lekarstv_aptekam'); 
          foreach ($pharmacy as $ph) {
        ?>
        <tr>
          <td><?php echo $ph['id'] ?></td>
          <td><?php echo $ph['name_medicine'] ?></td>
          <td><?php echo $ph['manufacturer'] ?></td>
          <td><?php echo $ph['count'] ?></td>
					<td><?php echo $ph['cost'] ?></td>
					<td><?php echo $ph['total_sum'] ?></td>
          
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php }else{
	echo "Доступ запрещен!!!";}?>
	<?php include("footer.php");?>