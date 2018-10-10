<?php
session_start();
include("../config.php");
/*$error = "null";
$status = $_GET['status'];
$stmt = $conn->prepare("INSERT INTO tenderers (Name, IDNo, Phone, Email, Address, POBox, Password) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("sssssss",$name,$id,$num,$mail,$add,$box,$password);
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
	   }
		}
   } catch (Exception $e) {
    $error = "Error Signing you up for service. Please try again later!";
	}
}*/
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
				<input name="password" type="password" onclick="reshow();"/><br/><br/>
				<label for = "repassword" class="repassword">Re-Enter Password</label><br/>
				<input name="repassword" type="password" class="repassword"/><br/><br/>
				<input type="submit" class="btn" value="Create New User"/><br/><br/>
			</fieldset>
			</form>
		</div>
	</body>
</html>
