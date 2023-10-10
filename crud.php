<?php
  
  // Include database file
  include 'mainfunction.php';
  $pharmacyObj = new Main();
 
    
?>
<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&$_SESSION['user']['role_of_user']=="Админ"){?>

<div class="container">
<table class="table table-hover">
	
    <thead>
      <tr>
        <th>Название таблицы</th>
        <th>Действие</th>
      </tr>
    </thead>
    <tbody>
			
				
				<?php 
          $pharmacy = $pharmacyObj->show_tables(); 
          foreach ($pharmacy as $ph) {
        ?>
				<tr>
				<td>
					<?php echo $ph['Tables_in_pharmacy_warehouse'] ?>
				</td>
				<?php
			$name = $ph['Tables_in_pharmacy_warehouse']?>
			<td>
			<?php echo "<a href='data_" . $name . ".php' style='color:green'>
						<i class='fa fa-table'></i></a>"?>
						
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
	</div>
	<?php }else{
	echo "Доступ запрещен!!!";}?>
	<?php include("footer.php");?>