<?php
session_start();
require("config.php");
require("valid.php");
require("mail.php");
$error = "null";
$status = "tenderer";
$name=$id=$num=$mail=$add=$box="";
$stmt = $conn->prepare("INSERT INTO tenderers (Name, IDNo, Phone, Email, Address, POBox) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("ssssss",$name,$id,$num,$mail,$add,$box);
$stmt2 = $conn->prepare("INSERT INTO login (Idnum, Status, Email, Password) VALUES (?,?,?,?)");
$stmt2->bind_param("ssss",$id,$status,$mail,$password);
if($_SERVER["REQUEST_METHOD"] == "POST") {
	try{
	   $name = mysqli_real_escape_string($conn,$_POST['name']);
	   $id = mysqli_real_escape_string($conn,$_POST['IDNo']);
	   $num = mysqli_real_escape_string($conn,$_POST['phone']);
	   $mail = mysqli_real_escape_string($conn,$_POST['email']);
	   $add = mysqli_real_escape_string($conn,$_POST['address']);
	   $box = mysqli_real_escape_string($conn,$_POST['pobox']);
	   $password = mysqli_real_escape_string($conn,$_POST['password']);
	   $password2 = mysqli_real_escape_string($conn,$_POST['passval']);
	   if ($password != $password2) {
		   $error = "These passwords don't seem to match. Please review them.";
	   }else{
			if(!validname($name)){
				$error = "That name looks incorrect. Please review it.";
			}else if(!validphone($num)){
				$error = "That phone number doesn't seem correct. Please review it.";
			}else if(!validemail($mail)){
				$error = "That email address seems incorrect. Please review it.";
			}else if(!validpassword($password)){
				$error = "Unfortunately your password is too simple. Please make it harder.";
			}else{
	   $sql = "SELECT * FROM tenderers WHERE IDNo = '$id' or Email = '$mail'";
	   $result = mysqli_query($conn,$sql);
	   $count = mysqli_num_rows($result);
	   if($count > 0) {
		   $error = "It seems like you already have an account with that email or id number. Please login.";
	   }else{
			 $stmt->execute();
			 $stmt2->execute();
		   $_SESSION['UserID'] = $id;
		   header("location: Tenderer/home.php");
			 $msg = "
			 <h1>Account creation confirmation</h1><br>
			 <h2>Welcome to Tenderama Online Tendering System <b><i>$name</i></b></h2>
			 <h3>This email confirms that you have created a new account and are ready to start tendering with us.</h3>";
			 sendmail($msg,$mail);
	   }
		}
	}
   } catch (Exception $e) {
    $error = "Error Signing you up for service. Please try again later!";
	}
}
?>
<html>
	<head>
		<link href="assets/css/signup.css" type="text/css" rel="stylesheet">
		<link href="assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>School Tendering System</title>
	</head>
	<body>
		<div class="info">
			<section>
				<h1>TENDERAMA</h1>
				<h2>A website for all your tendering needs.</h2>
				<h3>
					This web based application is the pet project of 100446 and 99460
					to be presented in the second year of their studies
					for the award of a degree in their Informatics and Computer Science Course
					at Strathmore University.
				</h3>
				<h4>Already tendering with us? <a href="index.php">Click here.</a></h4>
				<h4><a href="mailto:tenderama254@gmail.com?Subject=Signup%20Error" target="_top">Having trouble signing up?</a></h4>
			</section>
		</div>
		<div class="sign_box">
			<center><section>
				<h5>Create a new account below</h5>
				<form method="POST">
					<input type="text" placeholder="Full Name" name="name" value="<?php echo $name ?>"required><br>
					<input type="text" placeholder="National ID Number (12345600)" name="IDNo" value="<?php echo $id ?>" required><br>
					<input type="text" placeholder="Phone Number (0712345678)" name="phone" value="<?php echo $num ?>" required><br>
					<input type="text" placeholder="Email" name="email" value="<?php echo $mail ?>" required><br>
					<input type="text" placeholder="Physical Address" name="address"  value="<?php echo $add ?>"><br>
					<input type="text" placeholder="P.O.Box ..." name="pobox" value="<?php echo $box ?>"><br>
					<input type="password" placeholder="Enter Password" name="password" required><br>
					<input type="password" placeholder="Re-enter Password" name="passval" required><br>
					<input type="submit" class="button" value="SIGN UP">
				</form>
				<?php
					if($error != "null"){
				?>
				<div style = "font-size:18px; color:#cc0000; margin-top:0px"><?php echo $error; ?></div>
				<?php
					}
				?>
			</section></center>
		</div>
	</body>
</html>
