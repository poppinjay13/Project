<?php
session_start();
include("../config.php");
$error = "null";
$status = "tenderer";
$stmt = $conn->prepare("INSERT INTO tenderers (Name, IDNo, Phone, Email, Address, POBox) VALUES (?,?,?,?,?,?)");
$stmt2 = $conn->prepare("INSERT INTO login (Idnum, Status, Email, Password) VALUES (?,?,?,?)");
if($_SERVER["REQUEST_METHOD"] == "POST") {
	try{
		$name = mysqli_real_escape_string($conn,$_POST['name']);
	   $id = mysqli_real_escape_string($conn,$_POST['idnum']);
	   $num = mysqli_real_escape_string($conn,$_POST['phone']);
	   $mail = mysqli_real_escape_string($conn,$_POST['email']);
	   $add = mysqli_real_escape_string($conn,$_POST['address']);
	   $box = mysqli_real_escape_string($conn,$_POST['pobox']);
	   $password = mysqli_real_escape_string($conn,$_POST['password']);
	   $password2 = mysqli_real_escape_string($conn,$_POST['repassword']);
	   if ($password != $password2) {
		   $error = "Please ensure passwords entered match.";
	   }else{
	   $sql = "SELECT * FROM tenderers WHERE IDNo = '$id' or Email = '$mail'";
	   $result = mysqli_query($conn,$sql);
	   $count = mysqli_num_rows($result);
	   if($count > 0) {
		   $error = "The ID number or Email address you entered is already in use";
	   }else{
			 $stmt->bind_param("ssssss",$name,$id,$num,$mail,$add,$box);
			 $stmt->execute();
			 $stmt2->bind_param("ssss",$id,$status,$mail,$password);
			 $stmt2->execute();
		   header("location: users.php");
	   }
		}
   } catch (Exception $e) {
    $error = "Error Signing you up for service. Please try again later!";
	}
}
?>
<html>
	<head>
		<link href="../assets/css/adminnew.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Admin Module</title>
	</head>
	<body>
		<ul class="navbar">
    <li class="img"><img src="../assets/images/user.png"></li>
     <li><a href="admin.php">Dashboard</a></li>
		 <li><a href="users.php">Users</a></li>
     <li><a href="profile.php">Profile</a></li>
     <li><a class="active">Account +</a></li>
     <li><a href="../logout.php">Log Out</a></li>
    </ul>
		<div class="data">
			<form method="post" action="#">
				<fieldset>
					<label for="name">Name</label><br>
					<input type="text" name="name"/><br><br>
					<label for="idnum">ID Number</label><br>
					<input type="text" name="idnum"/><br><br>
					<label for="phone">Phone Number</label><br>
					<input type="text" name="phone"/><br><br>
					<label for="email">Email</label><br>
					<input type="text" name="email"/><br><br>
					<label for="address">Physical Address</label><br>
					<input type="text" name="address"/><br><br>
					<label for="pobox">P.O. Box</label><br>
					<input type="text" name="pobox"/><br><br>
					<label for="password">Password</label><br>
					<input type="password" name="password"/><br><br>
					<label for="repassword">Re-enter Password</label><br>
					<input type="password" name="repassword"/><br><br>
					<input type="submit" name="submit" value="CREATE ACCOUNT" class="btn"/>
				</fieldset>
			</form>
		</div>
	</body>
</html>
