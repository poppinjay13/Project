
<?php
session_start();
include("../config.php");
$tab = 1;
$count = 0;
$Tenderid= $_GET['TENDERID'];

$sql = "SELECT * FROM tenders WHERE TenderID=$Tenderid";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

?>

<html>
	<head>
        
		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
              <link rel="stylesheet" href="../assets/js/jquery.datetimepicker.min.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery.datetimepicker.full.js"></script>
        <script>
        $(function(){
                $("#datetime").datetimepicker();
        });
            
        </script>
        
		<title>Department manager's Module</title>
	</head>
	<body>
	<ul class="navbar">
		<li class="profpic"><img src="../assets/images/pic/<?php echo $uid?>.jpg"></li>
		<li><a href="manager.php" ><span>Home</span></a></li>
		<li><a href="details.php"><span>My Details</span></a></li>
    <li><a href="#" class="active"><span>Edit Tender</span></a></li>
		<div class="top_right">
		<li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>
	</div>
	</ul>

	<div class="bod">
	<?php
		
	?>
	<center>
	<h2 style="color:white;" style="color:white;">Edit tender details</h2><br>

	</center>
	<?php

        while ($row=mysqli_fetch_row($result)){



	?>
	<div class="tendernew">
	<div class="text">
         <div id="form">
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" accept-charset="utf-8">
                    Name:<br>
                        <input  type="text" name="tendername" value="<?php printf($row[1])?>" placeholder=""><br><br>

                     Department:<br>
                    <input  type="text" name="tendername" value="<?php printf($row[2])?>" placeholder=""><br><br>
                        <br><br>
                    Requirements:<br>
                    <textarea name="requirements" value="<?php printf($row[3])?>" placeholder="" rows="4" cols="50"></textarea>
                        <br><br>
                    Enquiries:<br>
                        <input  type="text" name="enquiries" value="<?php printf($row[4])?>" placeholder=""><br><br>
                  
                    Deaddate:<br>
                     <input  type="datetime" name="deadtime" value="<?php printf($row[5])?>" placeholder="" id="datetime"><br><br>


                        <button  type="submit" name="submit" class="cust">submit</button>

                </form>

	</div>
	</div>
	<?php
			$tab++;

            }
	
	?>

	</body>
</html>
