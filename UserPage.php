<?php 
	session_start();
	?>
	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>User</title>
	<link rel="stylesheet" type="text/css" href="styles2.css">
</head>
<body>
		<div class="container">
			<label for="">Cabinet</label>
			<?php

				$login = $_SESSION['login'];
				$password = $_SESSION['password'];
				
				$con = mysqli_connect("localhost","root", "", "login"); 
				if(isset($_POST['log'])){
					$login = mysqli_real_escape_string($con,$login);
					$password = mysqli_real_escape_string($con,$password);
					
					if($login!="" && $password!=""){
						$select = "SELECT * FROM users WHERE login ='$login' and password ='$password'";
						$result = mysqli_query($con, $select);
						$count = mysqli_num_rows($result);
						if( $count == 0){
							header("Location: NoUser.php");
						}
						else{
							$result = mysqli_query($con, $select);
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						}
					}
					else{
						header("Location: login.php");
					}
				}
				mysqli_close($con);
				?>
			<form class="" action="CheckForUpdate.php" method="POST">
				<input type="text" name="login" value="<?php echo $row["login"]; ?>">
				<input type="password" name="password" value="<?php echo $row["password"]; ?>">
				<input type="text" name="name" value="<?php echo $row["name"]; ?>">
				<input type="text" name="secondname" value="<?php echo $row["secondname"]; ?>">
				<input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
				<button type="submit" class="btn" name="log">Save</button>
			</form>
		</div>
</body>
</html>