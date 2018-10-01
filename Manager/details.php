<?php
session_start();
include("../config.php");
$tab = 1;
$count = 0;
$uid = $_SESSION['Idnum'];
$sql = "SELECT * FROM heads where HeadID = $uid";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
$row=mysqli_fetch_row($result);
?>
<html>
	<head>
		<link href="../assets/css/port.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Manager's details</title>
	</head>
	<body>
	<ul class="navbar">
		<li><span><img src="../assets/images/menu.png"></span></li>
		<li><a href="manager.php"><span>Home</span></a></li>
		<li><a href="#" class="active"><span>My Details</span></a></li>
		<div class="top_right">
		<li class="profpic"><img src="../assets/images/pic/<?php echo $uid?>.jpg"></li>
	</div>
	</ul>

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
			<input type="text" name="number" value="<?php printf($row[3])?>"><br><br>
			Email Address:
			<input type="text" name="email" value="<?php printf($row[2])?>"><br><br>
			Phone Number:
			<input type="text" name="address" value="<?php printf($row[4])?>"><br><br>



	</div>
	</body>
</html>
