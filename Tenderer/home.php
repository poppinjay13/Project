<?php
session_start();
include("../config.php");
$tab = 1;
$count = 0;
$sql = "SELECT * FROM tenders";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
?>
<html>
	<head>
		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Tenderer's Module</title>
	</head>
	<body>
	<ul class="navbar">
		<li><span><img src="../assets/images/menu.png"></span></li>
		<li><a href="#" class="active"><span>Home</span></a></li>
		<li><a href="port.php"><span>Portfolio</span></a></li>
		<div class="top_right">
		<li class="profpic"><img src="../assets/images/pic/<?php echo $uid?>.jpg"></li>
	</div>
	</ul>
	<div class="bod">
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
		<h3>Department: $row[2] </h3>
		<h3>Due Date: $row[6] </h3>
	</div>
	</div>";
			$tab++;
		}
	}
	?>
	<script>
		function send(data){
			var form = document.createElement("form");
			form.target = "_blank";
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
