<?php
  class Main
  {
    private $servername = "localhost";
    private $username   = "root";
    private $password   = "LisAn711$";
    private $database   = "pharmacy_warehouse";
    public  $con;
    // Database Connection 
    public function __construct()
    {
        $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
        if(mysqli_connect_error()) {
       trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
        }else{
      return $this->con;
        }
    }
		
		public function login($login, $pass, $rem){
			//if($_COOKIE['captcha'] == $captcha){
				
			$query="SELECT * FROM users";
			$result = $this->con->query($query);
			

			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				
        if($row['login']==$login && $row['pass']==substr($pass,0,10)){
					
					$_SESSION['user']=['login'=>$login,'password'=>substr($pass,0,10),'role_of_user'=>$row['role_of_user'], 'is_approve'=>$row['is_approve']];
					if($rem){
						setcookie('login', $login, time()+360*24*7);
						setcookie('password', substr($pass,0,10), time()+360*24*7);
						setcookie('role_of_user', $row['role_of_user'], time()+360*24*7);
						setcookie('is_approve', $row['is_approve'], time()+360*24*7);
						if(isset($_COOKIE["count"]))
						{
								setcookie('count',(int) ++$_COOKIE["count"]);
						}
						else
						{
								setcookie('count',0);
						}
				//----------------------------------------------------------
						if(isset($_COOKIE["data"]))
						{
								$data = date('Y - F  - d - H - i  - s');
								setcookie('data', $data  );
						}
						else
						{
								setcookie('data', date('Y - F  - d - H - i  - s') );
						}
					}
					return true;
				}
			}//}
			return false;

		}
		public function logout(){
			setcookie('login','',time()-1);
			setcookie('password','',time()-1);
			setcookie('role_of_user','',time()-1);
			setcookie('is_approve','',time()-1);
			setcookie('date','',time()-1);
			unset($_SESSION['user']['login']);
			unset($_SESSION['user']['password']);
			unset($_SESSION['user']['role_of_user']);
			unset($_SESSION['user']['is_approve']);
			session_destroy();
		}
		public function insertData($post, $name)
    {
			if($name == "application"){
				$date_created = $this->con->real_escape_string(date($_POST['date_created']));
				/*$d = strtotime($date);
				if ($d) {
					$date_created = date('Y-m-d', $d);
				};*/
				$pharmacy = $_POST['pharmacy'];
				$date_completion = $this->con->real_escape_string(date($_POST['date_completion']));
				/*$d = strtotime($date);
				if ($d) {
					$date_completion = date('Y-m-d', $d);
				};*/
				$query="INSERT INTO `application`(date_created,id_pharmacy,date_completion) VALUES('$date_created','$pharmacy','$date_completion')";
				$sql = $this->con->query($query);
				if ($sql==true) {
						header("Location:data_application.php?msg1=insert");
				}else{
						echo "Registration failed try again!";
				}
			}

			if($name == "purchase"){
				$application = $_POST['application'];
				/*$d = strtotime($date);
				if ($d) {
					$date_created = date('Y-m-d', $d);
				};*/
				$medicine = $_POST['medicine'];
				$count = $this->con->real_escape_string((int)$_POST['count']);
				$query="INSERT INTO `purchase`(id_application,id_medicine,count) VALUES('$application','$medicine','$count')";
				$sql = $this->con->query($query);
				if ($sql==true) {
						header("Location:data_purchase.php?msg1=insert");
				}else{
						echo "Registration failed try again!";
				}
			}

			if($name == "pharmacy"){
      $name = $this->con->real_escape_string($_POST['name_pharmacy']);
      $city = $this->con->real_escape_string($_POST['city']);
      $street = $this->con->real_escape_string($_POST['street']);
      $phone = $this->con->real_escape_string($_POST['phone']);
      $query="INSERT INTO pharmacy(name_pharmacy,city,street,phone) VALUES('$name','$city','$street','$phone')";
			$sql = $this->con->query($query);
      if ($sql==true) {
          header("Location:data_pharmacy.php?msg1=insert");
      }else{
          echo "Registration failed try again!";
      }
		}
			
			if($name == "medicine"){
			$name = $this->con->real_escape_string($_POST['name_medicine']);
      $form = $this->con->real_escape_string($_POST['form']);
      $manufacturer = $this->con->real_escape_string($_POST['manufacturer']);
      $cost = $this->con->real_escape_string((double)$_POST['cost']);
      $query="INSERT INTO medicine(name_medicine,form,manufacturer,cost) VALUES('$name','$form','$manufacturer','$cost')";
			$sql = $this->con->query($query);
      if ($sql==true) {
          header("Location:data_medicine.php?msg1=insert");
      }else{
          echo "Registration failed try again!";
      }
		}
		if($name == "users"){
			$login = $this->con->real_escape_string($_POST['login']);
			$password = $this->con->real_escape_string(md5($_POST['password']));
			/*if($_SESSION==$_POST['password']){
      	$password = $this->con->real_escape_string($_POST['password']);}
				else {
					$password = $this->con->real_escape_string(md5($_POST['password']));
				}*/
				if(!empty($_POST['role'])){
      $role = $this->con->real_escape_string($_POST['role']);}
      $email = $this->con->real_escape_string($_POST['email']);
			if(!empty($_POST['approve'])){
			$is_approve = $this->con->real_escape_string((bool)$_POST['approve']);}
			if(!empty($_POST['role'])&&!empty($_POST['approve'])){
      $query="INSERT INTO users(login,pass,role_of_user,email,is_approve) VALUES('$login','$password','$role','$email','$is_approve')";
			$sql = $this->con->query($query);
      if ($sql==true) {
          header("Location:data_users.php?msg1=insert");
      }else{
          echo "Registration failed try again!";
      }}
			else{
				$query="INSERT INTO users(login,pass,email) VALUES('$login','$password','$email')";
			
			$sql = $this->con->query($query);
      if ($sql==true) {
          header("Location:index.php");
      }else{
          echo "Registration failed try again!";
      }}
		}

		
      
    }
    // Fetch customer records for show listing
    public function displayData($name_table)
    {
			if($name_table=="application"){
					$query = "SELECT application.id, application.date_created, pharmacy.name_pharmacy, application.date_completion FROM
					application 
					Inner join pharmacy on application.id_pharmacy=pharmacy.id;";
					
			}
			else{
				if($name_table=="purchase"){
					$query = "SELECT purchase.id as id, purchase.id_application, medicine.name_medicine, purchase.count FROM
					purchase
					left join medicine on purchase.id_medicine=medicine.id;";
				}
				else{
        $query = "SELECT * FROM $name_table";}}
        $result = $this->con->query($query);
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
               $data[] = $row;
        }
       return $data;
        }else{
       echo "No found records";
        }
    }
    // Fetch single data for edit from customer table
    public function displyaRecordById($id, $name)
    {
			
        $query = "SELECT * FROM $name WHERE id = '$id'";
        $result = $this->con->query($query);
    if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
            return $row;
        }else{
            echo "Record not found";
        }
    }
    // Update customer data into customer table
    public function updateRecord($postData, $name)
    {
			if($name == "pharmacy"){
          $name = $this->con->real_escape_string($_POST['npharmacy']);
          $city = $this->con->real_escape_string($_POST['ncity']);
          $street = $this->con->real_escape_string($_POST['nstreet']);
					$phone = $this->con->real_escape_string($_POST['nphone']);
          $id = $this->con->real_escape_string($_POST['id']);
    if (!empty($id) && !empty($postData)) {
          $query = "UPDATE pharmacy SET name_pharmacy = '$name', city = '$city', street = '$street', phone = '$phone' WHERE id = '$id'";
          $sql = $this->con->query($query);
          if ($sql==true) {
              header("Location:data_pharmacy.php?msg2=update");
          }else{
              echo "Registration updated failed try again!";
          }
        }}

				if($name == "application"){
          $date_created = $this->con->real_escape_string(date($_POST['ndate_created']));
				/*$d = strtotime($date);
				if ($d) {
					$date_created = date('Y-m-d', $d);
				};*/
				$pharmacy = $_POST['npharmacy'];
				$date_completion = $this->con->real_escape_string(date($_POST['ndate_completion']));
				
          $id = $this->con->real_escape_string($_POST['id']);
    if (!empty($id) && !empty($postData)) {
          $query = "UPDATE `application` SET date_created = '$date_created', id_pharmacy = '$pharmacy', date_completion = '$date_completion' WHERE id = '$id'";
          $sql = $this->con->query($query);
          if ($sql==true) {
              header("Location:data_application.php?msg2=update");
          }else{
              echo "Registration updated failed try again!";
          }
        }}

				if($name == "purchase"){
          $application= $_POST['napplication'];
				$medicine = $_POST['nmedicine'];
				$count = $this->con->real_escape_string((int)$_POST['ncount']);
				
          $id = $this->con->real_escape_string($_POST['id']);
    if (!empty($id) && !empty($postData)) {
          $query = "UPDATE `purchase` SET id_application = '$application', id_medicine = '$medicine', count = '$count' WHERE id = '$id'";
          $sql = $this->con->query($query);
          if ($sql==true) {
              header("Location:data_purchase.php?msg2=update");
          }else{
              echo "Registration updated failed try again!";
          }
        }}

				if($name == "medicine"){
          $name = $this->con->real_escape_string($_POST['nmedicine']);
          $form = $this->con->real_escape_string($_POST['nform']);
          $manufacturer = $this->con->real_escape_string($_POST['nmanufacturer']);
					$cost = $this->con->real_escape_string((double)$_POST['ncost']);
          $id = $this->con->real_escape_string($_POST['id']);
    if (!empty($id) && !empty($postData)) {
          $query = "UPDATE medicine SET name_medicine = '$name', form = '$form', manufacturer = '$manufacturer', cost = '$cost' WHERE id = '$id'";
          $sql = $this->con->query($query);
          if ($sql==true) {
              header("Location:data_medicine.php?msg2=update");
          }else{
              echo "Registration updated failed try again!";
          }
        }}
				if($name == "users"){
          $login = $this->con->real_escape_string($_POST['nlogin']);
          //$password = $this->con->real_escape_string(md5($_POST['npass']));
					$obj=$this->displyaRecordById($_POST['id'],'users');
					if($obj['pass']==$_POST['npass']){
						$password = $this->con->real_escape_string($_POST['npass']);}
						else {
							$password = $this->con->real_escape_string(md5($_POST['npass']));
						}
          $role = $this->con->real_escape_string($_POST['nrole']);
					$email = $this->con->real_escape_string($_POST['nemail']);
					$is_approve = $this->con->real_escape_string(($_POST['napprove']=="on"));
          $id = $this->con->real_escape_string($_POST['id']);
    if (!empty($id) && !empty($postData)) {
          $query = "UPDATE users SET login = '$login', pass = '$password', role_of_user = '$role', email = '$email', is_approve = '$is_approve' WHERE id = '$id'";
          $sql = $this->con->query($query);
          if ($sql==true) {
              header("Location:data_users.php?msg2=update");
          }else{
              echo "Registration updated failed try again!";
          }
        }}



      
    }
    // Delete customer data from customer table
   public function deleteRecord($id, $name)
   {
      $query = "DELETE FROM $name WHERE id = '$id'";
      $sql = $this->con->query($query);
      if ($sql==true) {
          header("Location:data_$name.php?msg3=delete");
      }else{
          echo "Record does not delete try again";
      }
    }
		public function show_tables(){
			$query = "SHOW TABLES FROM pharmacy_warehouse;";
			$result = $this->con->query($query);
			if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
               $data[] = $row;
        }
       return $data;
        }else{
       echo "No found records";
        }}
				public function show_pharmacy(){
					$query = "select CONCAT(name_pharmacy, ',', city, ',', street) as information from pharmacy;";
					$result = $this->con->query($query);
					if ($result->num_rows > 0) {
						$data = array();
						while ($row = $result->fetch_assoc()) {
									 $data[] = $row;
						}
					 return $data;
						}else{
					 echo "No found records";
						}}
		
						public function show_application(){
							$query = "SELECT CONCAT(application.date_created, ',',pharmacy.name_pharmacy, ',',pharmacy.city, ',',pharmacy.street, ',',application.date_completion) as information_app
							from application
							inner join pharmacy on application.id_pharmacy=pharmacy.id;";
							$result = $this->con->query($query);
							if ($result->num_rows > 0) {
								$data = array();
								while ($row = $result->fetch_assoc()) {
											 $data[] = $row;
								}
							 return $data;
								}else{
							 echo "No found records";
								}}
								public function show_medicine(){
									$query = "SELECT CONCAT(name_medicine, ',',form, ',',manufacturer) as information_med
									from medicine;";
									$result = $this->con->query($query);
									if ($result->num_rows > 0) {
										$data = array();
										while ($row = $result->fetch_assoc()) {
													 $data[] = $row;
										}
									 return $data;
										}else{
									 echo "No found records";
										}}
	}
	?>