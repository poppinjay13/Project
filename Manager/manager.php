
<?php
session_start();
include("../config.php");
$tab = 1;
$count = 0;
$tab2 = 1;
$count2 = 0;
$uid = $_SESSION['ManID'];
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
		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Department manager's Module</title>
	</head>
	<body>
	<ul class="navbar">
		<li class="profpic"><img src="../assets/images/pic/<?php echo $uid?>.jpg"></li>
		<li><a href="#" class="active"><span>Home</span></a></li>
		<li><a href="details.php"><span>My Details</span></a></li>
    <div class="top_right">
		<li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>
	</div>
	</ul>

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



   <button class="cust"  >
        <?php
            echo "<a href='viewapplicants.php?TenderID=". $row[0] ."' title='ViewApplicants'  >View Applicants</a>";

        ?></button>
     <button class="cust"  ><?php
            echo "<a href='edittender.php?TenderID=". $row[0] ."' title='ViewApplicants' >Edit tender</a>";

        ?></button>
	</div>
	</div>
	<?php
			$tab++;

            }
	}}
	?>
        <button class="floatnew"><a href="newtender.php" style="text-decoration:none"> <h2>+FLOAT TENDER</h2></a>
        </button>
	</body>
</html>
