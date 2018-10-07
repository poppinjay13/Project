<?php
session_start();
include("../config.php");
if (!isset($_SESSION['UserID'])) {
		header("location:../index.php");
		exit;
}
$uid = $_SESSION['UserID'];
$sql = "SELECT * FROM tenderers where IDNo = $uid";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
$stmt = $conn->prepare("UPDATE tenderers
SET Phone = ?, Email = ?, Address = ?, POBox = ?, Password = ?
WHERE IDNo = $uid");
$stmt->bind_param("sssss",$num,$mail,$add,$box,$password);
//$stmt2 = $conn->prepare("UPDATE login
//SET Email = ?, Password = ?
//WHERE IDNo = $uid");
//$stmt2->bind_param("ss",$mail,$password);
if($_SERVER["REQUEST_METHOD"] == "POST") {
	try{
	   $num = mysqli_real_escape_string($conn,$_POST['phone']);
	   $mail = mysqli_real_escape_string($conn,$_POST['email']);
	   $add = mysqli_real_escape_string($conn,$_POST['address']);
	   $box = mysqli_real_escape_string($conn,$_POST['pobox']);
	   $password = mysqli_real_escape_string($conn,$_POST['password']);
		 if(isset($_FILES['pic'])) {
		   $filename = $_FILES["pic"]["name"];
		   $newname = $uid.".jpg";
		   $target_dir = "../assets/images/pic/";
		   $target_file = $target_dir.$newname;
		   $uploadOk = 1;
		     if ($uploadOk != 0){
		       if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
		         echo "<script>alert('New image set');</script>";
		         $prof = $newname;
		       } else {
		         echo "<script>alert('Sorry, there was an error uploading your picture.');</script>";
		       }
		     }
		   }
		 $stmt->execute();
		 //$stmt2->execute();
		 header("location: port.php");
	   }catch (Exception $e) {
    $error = "Error Updating your account details!<br> Please contact the administrator!";
	}
}
//sidebar
$count1 = $count2 = $count3 = 0;
$sql1 = "SELECT * FROM applications WHERE TendererID = '$uid'";
$result1 = mysqli_query($conn,$sql1);
$count1 = mysqli_num_rows($result1);
//
$sql2 = "SELECT * FROM applications WHERE TendererID = '$uid' AND Status = 'ACCEPTED'";
$result2 = mysqli_query($conn,$sql2);
$count2 = mysqli_num_rows($result2);
//
$sql3 = "SELECT * FROM applications WHERE TendererID = '$uid' AND Status = 'Completed'";
$result3 = mysqli_query($conn,$sql3);
$count3 = mysqli_num_rows($result3);
?>
<html>
	<head>
		<link href="../assets/css/port.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Tenderer's Module</title>
	</head>
	<body>
		<ul class="navbar">
			<li class="profpic"><img src="../assets/images/pic/<?php echo $uid?>.jpg"></li>
			<li><a href="home.php"><span>Home</span></a></li>
			<li><a href="#" class="active"><span>Portfolio</span></a></li>
			<div class="top_right">
				<li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>
			</div>
		</ul>
	<div class="sidebar">
		<!--Sidebar with tenderer's tender history-->
		<div class="sdinfo">
		<img src="../assets/images/pending.png">
		<h2><?php echo $count1 ?></h2>
		<h3>Submitted<br>Applications</h3>
		</div>
		<div class="sdinfo">
		<img src="../assets/images/approved.png">
		<h2><?php echo $count2 ?></h2>
		<h3>Approved<br>Tenders</h3>
		</div>
		<div class="sdinfo">
		<img src="../assets/images/complete.png">
		<h2><?php echo $count3 ?></h2>
		<h3>Succesful<br>Tenders</h3>
		</div>
	</div>
	<div class="uhead"><!--refer back to image path-->
		<label for='pic'><img src="../assets/images/pic/<?php echo('100446.jpg') ?>" title="Click to upload new profile picture"></label>
		<div class="uinfo">
		Name:
		<input type="text" name="name" value="<?php printf($row[1])?>" readonly><br><br>
		ID No:
		<input type="text" name="id" value="<?php printf($uid)?>" readonly><br><br>
		</div>
	</div>
	<div class="uedit">
		<form method="post" action="#" enctype="multipart/form-data">
			<input type="file" id='pic' name='pic' accept="application/jpg" style="display: none;"/>
			Phone Number:
			<input type="text" name="phone" value="<?php printf($row[3])?>"><br><br>
			Email Address:
			<input type="text" name="email" value="<?php printf($row[4])?>"><br><br>
			Physical Address:
			<input type="text" name="address" value="<?php printf($row[5])?>"><br><br>
			P.O. Box:
			<input type="text" name="pobox" value="<?php printf($row[6])?>"><br><br>
			Password:
			<input type="password" name="password" value="<?php printf($row[7])?>"><br><br>
			<input type="checkbox" name="confirm" style="margin:0px; position:static; width:13px; margin-left:80px;" required>
			I confirm that information entered above is true to the best of my knowledge<br><br>
			<input type="submit" value="SUBMIT DETAILS" id="button">
		</form>
	</div>
	</body>
</html>
