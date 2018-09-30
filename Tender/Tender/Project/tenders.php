<?php
session_start();
include("config.php");
$tab = 1;
$count = 0;
$sql = "SELECT * FROM tenders";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
?>
<html>
	<head>
		<link href="css/tender.css" type="text/css" rel="stylesheet">
		<link href="images/fav.png" rel="icon" type="image/x-icon" />
		<title>Tenders</title>
	</head>
	<body>
	<ul class="navbar">
		<li><span><img src="images/menu.png"></span></li>
		<li><a href="user.php"><span>Home</span></a></li>
		<li><a href="port.php"><span>Portfolio</span></a></li>
		<li><a href="#" class="active"><span>Tender Details</span></a></li>
		<div class="dropdown">
		<li class="navbtn"><img src="images/user.svg"></li>
		<div class="dropdown-content">
		  <a href="#">Notifications</a>
		  <a href="logout.php">Log Out</a>
		  <a href="#">Contact Us</a>
		</div>
		</div>
	</ul>
	<div class="tendall">
	<div class="tendrlft">
	<form>
		Name:
		<input type="text"><br><br>
		ID Number:
		<input type="text"><br><br>
		Business:
		<input type="text"><br><br>
		Position:
		<input type="text"><br><br>
	</form>
	</div>
	<div class="tendrght">
	<form>
		Price:
		<input type="text"><br><br>
		Scheduled Completion:
		<input type="text"><br><br>
		Amount of Goods:
		<input type="text"><br><br>
		Location:
		<input type="text"><br><br>
	</form>
	</div>
	</div>
	</body>
</html>