
<?php
session_start();
//you have to connect to database by including config.php
include("../config.php");
if (!isset($_SESSION['ManID'])) {
		header("location:../index.php");
		exit;
}

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

		<li class="profpic"><img src="../assets/images/user.png"></li>

		<li><a href="#" class="active"><span>Home</span></a></li>

		<li><a href="details.php"><span>My Details</span></a></li>

        <li><a href="newtender.php"><span>+ Float new tender</span></a></li>

    <div class="top_right">

		<li><a href="../index.php" title="logout"><img src="../assets/images/logout.png"></a></li>

	</div>
	</ul>


	<div class="bod">
	<?php
		if($count <= 0) {
	?>
	<center>
	<h2 style="color:white;" style="color:white;">You have not floated any tenders yet</h2><br>
	<h3 style="color:white;">Click on float new tender to float a tender</h3>
	</center>
	<?php
		}else {
		?>
	<center>
	<h1 style="color:white;">Floated tenders</h1>
  </center>
	<?php

        while ($row=mysqli_fetch_row($result)){
         if($row[2]==$depart){


	?>
	<div class="tender">
	<div class="text">

<!--		<h3>ID: <?php //printf($row[0])?></h3>-->
		<h2><?php printf($row[1])?></h2>
		<h3>Requirements: <?php printf($row[3])?></h3>
		<h3>Due Date: <?php printf($row[5])?></h3>

   <div align="center">
        <?php
            echo "<a class='button' href='viewapplicants.php?TENDERID=". $row[0] ."' title='ViewApplicants'  >View Applicants</a>";//on clicking this button you can view applicants of the specific tender selected

        ?><br>
    <?php
            echo "<a class='button' href='edittender.php?TenderID=". $row[0] ."' title='Edittenders' >Edit tender</a>";// this button allows you

        ?>
    </div>
	</div>
	</div>
	<?php
			$tab++;

            }

	}

        }
	?>
       <!-- <button class="floatnew"><a href="newtender.php" style="text-decoration:none"> <h2>+FLOAT TENDER</h2></a>
        </button> -->
	</body>
</html>
