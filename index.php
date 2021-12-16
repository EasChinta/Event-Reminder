<?php 
	session_start();
	require("config.php");

?>
<!DOCTYPE html>
<html lang="en">
	<?php include "header.php";?>
	<body>
		
		<div class='container mt-3'>
			<div class="jumbotron"><h2 class='text-muted text-center'>Event Reminder</h2></div>
			<div class='row'>
				<div class='col-md-5 mx-auto'>
					<h3 class='text-muted text-center'>LOGIN</h3>
					<?php 
						if(isset($_POST["login"])){
							$_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
							$uname=mysqli_real_escape_string($con,$_POST["uname"]);
							$upass=mysqli_real_escape_string($con,$_POST["upass"]);
							
							$sql="select * from admin where ANAME='{$uname}' and APASS='{$upass}'";
							$res=$con->query($sql);
							if($res->num_rows>0){
								$row=$res->fetch_assoc();
								$_SESSION["login_info"]=$row;
								header('location:home.php');
							}else{
								echo"<div class='alert alert-danger'>Invalid Login Details.</div>";
							}
						}
					?>
					<form action='index.php' method='post'>
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name='uname'  placeholder="Username" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name='upass' placeholder="Password" required>
						</div>
						<div class="form-group">
							<input type='submit' name='login' value='Login' class='btn btn-primary'>
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</body>
</html>