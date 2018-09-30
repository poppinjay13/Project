
<?php
session_start();
include("config.php");
$tab = 1;
$count = 0;
$tab2 = 1;
$count2 = 0;
$uid = $_SESSION['Idnum'];
$sqli = "SELECT * FROM heads where HeadID = $uid";
$result2 = mysqli_query($conn,$sqli);
$count2 = mysqli_num_rows($result2);
$row2=mysqli_fetch_row($result2);
$_SESSION['Department'] = $row2[3];
$depart = $_SESSION['Department'];

$sql = "SELECT * FROM tenders";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

?>

<html>
	<head>
		<link href="css/user.css" type="text/css" rel="stylesheet">
		<link href="images/fav.png" rel="icon" type="image/x-icon" />
		<title>Department manager's Module</title>
	</head>
	<body>
	<ul class="navbar">
		<li><span><img src="images/menu.png"></span></li>
		<li><a href="#" class="active"><span>Home</span></a></li>
		<li><a href="managerdetails.php"><span>My Details</span></a></li>
		<div class="dropdown">
		<li class="navbtn"><img src="images/user.svg"></li>
		<div class="dropdown-content">
		  <a href="logout.php">Log Out</a>
		</div>
		</div>
	</ul>
<div style="padding-top: 52px;">
	<?php
		if($count <= 0) {
	?>
	<center>
	<h2>You have not floated any tender.</h2><br>
	<h3>Click on float tender to add a tender.</h3>
	</center>
	<?php
		}else {
		?>
	<h1>Available Tender Requests</h1>
	<?php

        while ($row=mysqli_fetch_row($result)){

          if($row[2]==$depart){
	?>
	<div class="tender">
	<div class="text">

<!--		<h3>ID: <?php //printf($row[0])?></h3>-->
		<h2><?php printf($row[1])?></h2>
		<h3>Requirements: <?php printf($row[3])?></h3>
		<h3>Due Date: <?php printf($row[6])?></h3>
        <button  class="cust"><a href="viewapplicants.php" style="text-decoration:none">view applicants</a></button>
		<button class="cust"><a href="edittender.php" style="text-decoration:none"></a>edit tender</button>
	</div>
	</div>
	<?php
			$tab++;

            }
	}}
	?>
        <button class="floatnew"><a href="newtender.php" style="text-decoration:none"> <h2>+FLOAT TENDER</h2></a>
        </button>
      </div>
	</body>
</html>
