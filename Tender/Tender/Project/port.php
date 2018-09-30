<?php
session_start();
include("config.php");
$tab = 1;
$count = 0;
$uid = $_SESSION['Idnum'];
$sql = "SELECT * FROM tenderers where IDNo = $uid";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
$row=mysqli_fetch_row($result);
?>
<html>
	<head>
		<link href="css/port.css" type="text/css" rel="stylesheet">
		<link href="images/fav.png" rel="icon" type="image/x-icon" />
		<title>Tenderer's Module</title>
	</head>
	<body>
	<ul class="navbar">
		<li><span><img src="images/menu.png"></span></li>
		<li><a href="user.php"><span>Home</span></a></li>
		<li><a href="#" class="active"><span>Portfolio</span></a></li>
		<div class="dropdown">
		<li class="navbtn"><img src="images/user.png"></li>
		<div class="dropdown-content">
		  <a href="#">Notifications</a>
		  <a href="logout.php">Log Out</a>
		  <a href="#">Contact Us</a>
		</div>
		</div>
	</ul>
	<div class="sidebar">
		<!--Sidebar with tenderer's tender history-->
		<div class="sdinfo"></div>
		<div class="sdinfo"></div>
		<div class="sdinfo"></div>
	</div>
	<div class="uhead">
		<img src="images/user.png">
		<div class="uinfo">
		Name:
		<input type="text" name="name" value="<?php printf($row[1])?>" readonly><br><br>
		ID No:
		<input type="text" name="id" value="<?php printf($uid)?>" readonly><br><br>
		</div>
	</div>
	<div class="uedit">
			Phone Number:
			<input type="text" name="number" value="<?php printf($row[3])?>"><br><br>
			Email Address:
			<input type="text" name="email" value="<?php printf($row[4])?>"><br><br>
			Physical Address:
			<input type="text" name="address" value="<?php printf($row[5])?>"><br><br>
			P.O. Box:
			<input type="text" name="pobox" value="<?php printf($row[6])?>"><br><br>
			Any Other Details of Noteworthy Status:<br><br>
			<textarea placeholder="Enter any other information you would like to add to your profile..."></textarea><br><br>
		Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
	</div>
	</body>
</html>