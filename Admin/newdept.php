<?php
session_start();
include("../config.php");
if (!isset($_SESSION['AdminID'])) {
		header("location:../index.php");
		exit;
}
$error = "null";
$status = "department manager";
$newid= mt_rand(0,100000);
$stmt = $conn->prepare("INSERT INTO heads (HeadID, Name, Email, Department, Phone_Num) VALUES (?,?,?,?,?)");
$stmt2 = $conn->prepare("INSERT INTO login (Idnum, Status, Email, Password) VALUES (?,?,?,?)");
if($_SERVER["REQUEST_METHOD"] == "POST") {
	try{
		 $name = mysqli_real_escape_string($conn,$_POST['name']);
		 $mail = mysqli_real_escape_string($conn,$_POST['email']);
		 $dept = mysqli_real_escape_string($conn,$_POST['department']);
	   $num = mysqli_real_escape_string($conn,$_POST['phone']);
	   $password = mysqli_real_escape_string($conn,$_POST['password']);
	   $password2 = mysqli_real_escape_string($conn,$_POST['repassword']);
	   if ($password != $password2) {
		   $error = "Please ensure passwords entered match.";
	   }else{
	   $sql = "SELECT * FROM heads WHERE Email = '$mail'";
	   $result = mysqli_query($conn,$sql);
	   $count = mysqli_num_rows($result);
	   if($count > 0) {
		   $error = "The Email Address you entered is already in use";
	   }else{
		 	 $stmt->bind_param("sssss",$newid,$name,$mail,$dept,$num);
			 $stmt->execute();
			 //$stmt2->bind_param("ssss",$newid,$status,$mail,$password);
			 //$stmt2->execute();
		   header("location: users.php");
	   }
		}
   } catch (Exception $e) {
    $error = "Error Creating Account. Please try again later!";
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
				<label for = "name">Full Name</label><br/>
				<input name="name" type="text" value="<?php //echo $row['0'] ?>"/><br/><br/>
				<label for = "email">Email Address</label><br/>
				<input name="email" type="text"/><br/><br/>
				<label for = "department">Department</label><br/>
				<select name="department">
					<option value="Languages">Languages</option>
					<option value="Mathematics">Mathematics</option>
					<option value="Humanities">Humanities</option>
					<option value="Sciences">Sciences</option>
					<option value="Technical">Technical</option>
					<option value="Economics">Economics</option>
					<option value="Business">Business</option>
					<option value="Laboratory">Laboratory</option>
					<option value="Administration" selected>Administration</option>
					<option value="Finance">Finance</option>
					<option value="Guidance and Counselling">Guidance and Counselling</option>
				</select><br/><br/>
				<label for = "phone">Phone Number</label><br/>
				<input name="phone" type="text"/><br/><br/>
				<label for = "password">Password</label><br/>
				<input name="password" type="password"/><br/><br/>
				<label for = "repassword">Re-Enter Password</label><br/>
				<input name="repassword" type="password"/><br/><br/>
				<input type="submit" class="btn" value="Create New Account"/><br/><br/>
			</fieldset>
			</form>
		</div>
	</body>
</html>
