<?php
session_start();
require("config.php");
require("mail.php");
$error = "null";
$status = "tenderer";
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
		   $error = "Please ensure passwords entered match.";
	   }else{
	   $sql = "SELECT * FROM tenderers WHERE IDNo = '$id' or Email = '$mail'";
	   $result = mysqli_query($conn,$sql);
	   $count = mysqli_num_rows($result);
	   if($count > 0) {
		   $error = "The ID number or Email address you entered is already in use";
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
				<h3>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.</h3>
				<h4>Already tendering with us? <a href="index.php">Click here.</a></h4>
			</section>
		</div>
		<div class="sign_box">
			<center><section>
				<h5>Create a new account below</h5>
				<form method="POST">
					<input type="text" placeholder="Full Name" name="name" required><br>
					<input type="text" placeholder="National ID Number (12345600)" name="IDNo" required><br>
					<input type="text" placeholder="Phone Number (0712345678)" name="phone" required><br>
					<input type="text" placeholder="Email" name="email" required><br>
					<input type="text" placeholder="Physical Address" name="address"><br>
					<input type="text" placeholder="P.O.Box ..." name="pobox"><br>
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
