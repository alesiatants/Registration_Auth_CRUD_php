<?php include("header.php");?>
<?php if(!empty($_SESSION['user'])&&($_SESSION['user']['role_of_user']=="Админ"||($_SESSION['user']['role_of_user']=="Оператор"&&$_SESSION['user']['is_approve']==1))){?>

	<div class="container">
<h1 align="center">Аптечный склад</h1>
<?php
$connection = mysqli_connect("localhost", "root", "LisAn711$", 'pharmacy_warehouse');
if(!$connection)
die("could not connect".mysqli_connect_error());
else 
echo 'Connection established!';
$year = [2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022];
foreach ($year as $v) {

echo "<h3 align='center'> Ведомость отпуска лекарственных препаратов аптеками в " .$v . " году </h3>";

$query = "SELECT * FROM V_vedomost_otpyska_lekarstv_aptekam WHERE id IN(SELECT id from application where year(date_created)=$v);";
$stmt = mysqli_query($connection,$query);

echo "<table class='table'>";
    echo "<tr class='table-warning'>";
          echo "<th></th>";
          echo "<th>Название лекарства</th>";
          echo "<th>Производитель</th>";
          echo "<th>Количество, шт.</th>";
					echo "<th>Цена, руб.</th>";
					echo "<th>Сумма оплаты руб.</th>";
    echo "</tr>";

$i = 0;

while ($row = mysqli_fetch_array($stmt, MYSQLI_ASSOC)){
	  echo "<tr>";
          echo "<td> </td>";
          echo "<td>" . $row['name_medicine'] . "</td>";
          echo "<td>" . $row['manufacturer'] . "</td>";
          echo "<td>" . $row['count'] . "</td>";
					echo "<td>" . $row['cost'] . "</td>";
					echo "<td>" . $row['total_sum'] . "</td>";								
    echo "</tr>";
$k = $row['id'];
$res = mysqli_query($connection, "SELECT id FROM V_vedomost_otpyska_lekarstv_aptekam WHERE id = $k;");
$count = mysqli_num_rows($res);
$i++;
	if($i===$count){
		$res_1 = mysqli_query($connection,"SELECT sum(count), sum(total_sum) FROM V_vedomost_otpyska_lekarstv_aptekam WHERE id = $k group by id;");
		while ($row_1 = mysqli_fetch_array($res_1, MYSQLI_ASSOC)){
				echo "<tr class='table-info'>";
							echo "<td> Номер заявки : </td>";
							echo "<td>" . $k . "</td>";
							echo "<td> Количество : </td>";
							echo "<td>" .  $row_1['sum(count)'] . "</td>";
							echo "<td> Общая стоимость : </td>";
							echo "<td>" . $row_1['sum(total_sum)'] . "</td>";
				echo "</tr>";}
    $i = 0;
	}
}

$res_1 = mysqli_query($connection,"SELECT sum(count), sum(total_sum) FROM V_vedomost_otpyska_lekarstv_aptekam WHERE id IN(SELECT id from application where year(date_created)=$v);");
while ($row_1 = mysqli_fetch_array($res_1, MYSQLI_ASSOC)){ 
		echo "<tr class='table-success'>";  
			echo "<td> Итого: </td>";
			echo "<td></td>";  
			echo "<td> Количество: </td>";
			echo "<td>" . $row_1["sum(count)"] . "</td>";
			echo "<td> Сумма: </td>";
			echo "<td>" . $row_1["sum(total_sum)"] . "</td>";
		echo "</tr>";  
}     

echo "</table>";
echo "<hr>";
}


$res_1 = mysqli_query($connection,"SELECT sum(count), sum(total_sum) FROM V_vedomost_otpyska_lekarstv_aptekam;");
	while ($row_1 = mysqli_fetch_array($res_1, MYSQLI_ASSOC)){
		echo "<table class='table'>";
		echo "<tr class='table-primary'>";
		echo "<td> Итого : </td>";
		echo "<td> Количество : " . $row_1['sum(count)'] . "</td>";
		echo "<td> Общая стоимость : " . $row_1['sum(total_sum)'] . "</td>";
		echo "</tr>";
	}		
?>
<?php }else{
	echo "Доступ запрещен!!!";}?>
	<?php include("footer.php");?>