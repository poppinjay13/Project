<?php
session_start();
include("../config.php");
if (!isset($_SESSION['UserID'])) {
		header("location:../index.php");
		exit;
}
$uid = $_SESSION['UserID'];
$tab = 1;
$count = 0;
$sql = "SELECT * FROM tenders ORDER BY Status DESC";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
?>
<html>
	<head>
		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/css/alert.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Tendererama | Home</title>
	</head>
	<body>
	<ul class="navbar">
		<li class="profpic">
		<object data="../assets/images/pic/<?php echo $uid?>.jpg" type="image/png">
      <img src="../assets/images/pic/profile.jpg" alt="profile">
    </object>
		</li>
		<li><a href="#" class="active"><span>Home</span></a></li>
		<li><a href="port.php"><span>Portfolio</span></a></li>
		<div class="top_right">
			<li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>
		</div>
	</ul>
	<div class="bod">
		<?php
	    if(isset($_SESSION['alerts'])){
	      echo "<div class='alert'>$_SESSION[alerts]</div>";
				unset($_SESSION['alerts']);
	    }
	    ?>
	<?php
		if($count <= 0) {
	?>
	<center>
	<h2 style="color:white;" style="color:white;">There are currently no Tender Requests available.</h2><br>
	<h3 style="color:white;">Please check back later</h3>
	</center>
	<?php
		}else {
		?>
	<center>
	<h1 style="color:white;">Available Tender Requests</h1>
  </center>
	<?php
	while ($row=mysqli_fetch_row($result)){
	echo "
	<div class='tender' onClick='send($row[0])'>
	<div class='text'>
		<h2> $row[1] </h2>
		<h3>Department: <i>$row[2]</i> </h3>
		<h3>Requirements: <i>$row[3]</i> </h3>
		<h3>Due Date: <i>$row[5]</i> </h3>
		<h3>Status: <i>$row[6]</i> </h3>
	</div>
	</div>";
			$tab++;
		}
	}
	?>
	<script>
		function send(data){
			var form = document.createElement("form");
			form.target = "_self";
			form.method = "GET";
			form.action = "tenders.php";
			form.style.display = "none";
			var input = document.createElement("input");
			form.appendChild(input);
			input.type = "hidden";
			input.name = "key";
			input.value = data;
			document.body.appendChild(form);
			form.submit();
			document.body.removeChild(form);
			}
	</script>
</div>
</body>
</html>
