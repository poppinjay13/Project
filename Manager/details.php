<?php

session_start();
if (!isset($_SESSION['ManID'])) {
    header("location:../index.php");
    exit;
}


include "../config.php";

$uid = $_SESSION['ManID'];//insert ID from sessions

$sql = "SELECT * FROM heads where HeadID = $uid";

$result = mysqli_query($conn,$sql);

$row=mysqli_fetch_row($result);

$stmt = $conn->prepare("UPDATE heads SET Email = ?, Phone_Num = ? WHERE HeadID = $uid");//update details in department manager table

$logmail = $conn->prepare("UPDATE login SET Email = ? WHERE Idnum = $uid");//update email in login table

$logpass = $conn->prepare("UPDATE login SET Password = ? WHERE Idnum = $uid");//update email in login table

if($_SERVER["REQUEST_METHOD"] == "POST") {

	try{

	   $email = mysqli_real_escape_string($conn,$_POST['email']);

		 $phone = mysqli_real_escape_string($conn,$_POST['phone']);

	   $password = mysqli_real_escape_string($conn,$_POST['password']);

		 $repassword = mysqli_real_escape_string($conn,$_POST['repassword']);

		 if($password == $repassword){//if password fields are matching

			 $stmt->bind_param("ss",$email,$phone);

			 $stmt->execute();

			 $logmail->bind_param("s",$email);

			 $logmail->execute();

			 if($password != ""){//if new passwords are not null

				 $logpass->bind_param("s",$password);

				 $logpass->execute();

			 }

			 header("location: details.php");//reload page to refresh form

		 }else{

			 $error = "Ensure passwords entered match!";

		 }

   }catch(Exception $ex){

     $error = "Error Updating Your Account Details!";

   }

 }

?>
<html>
	<head>
		<link href="../assets/css/port.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Manager's details</title>
	</head>
	<body>
	<ul class="navbar">

		<li class="profpic"><img src="../assets/images/user.png"></li>

		<li><a href="manager.php"><span>Home</span></a></li>

		<li><a href="#" class="active"><span>My Details</span></a></li>

		<div class="top_right">

		<li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>

	</div>
	</ul>
	<form method="POST">
	<div class="uhead">
		<img src="../assets/images/user.png">
		<div class="uinfo">
		Name:
		<input type="text" name="name" value="<?php printf($row[1])?>" readonly><br><br>
		Head ID:
		<input type="text" name="id" value="<?php printf($uid)?>" readonly><br><br>
		</div>
	</div>
	<div class="uedit">
			Department:
			<input type="text" name="deparetment" value="<?php printf($row[3])?>"><br><br>
			Email Address:
			<input type="text" name="email" value="<?php printf($row[2])?>"><br><br>
			Phone Number:
			<input type="text" name="phone" value="<?php printf($row[4])?>"><br><br>
          Password:

            <input name="password" type="password"/><br/><br/>

      Confirm Password:

                <input name="repassword" type="password"/><br/><br/>

	</div>
<div >
        <input type="submit" class="btn" value="Update Details"/><br/><br/>
    </div>
        </form>
    </body>
</html>
