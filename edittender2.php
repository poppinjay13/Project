
<?php
session_start();
include("config.php");
$tab = 1;
$count = 0;
$tenderId=$_GET['TenderID'];

$sql = "SELECT * FROM tenders WHERE TenderID=$tenderId";
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
		<li><a href="amanager.php" ><span>Home</span></a></li>
		<li><a href="managerdetails.php"><span>My Details</span></a></li>
        <li><a href="#" class="active"><span>Edit Tender</span></a></li>
		<div class="dropdown">
		<li class="navbtn"><img src="images/user.svg"></li>
		<div class="dropdown-content">
		  <a href="logout.php">Log Out</a>
		</div>
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
                    Deadtime:<br>
                        <input  type="datetime" name="deadtime" value="<?php printf($row[5])?>" placeholder=""><br><br>
                    Deaddate:<br>
                     <input  type="datetime" name="deadtime" value="<?php printf($row[6])?>" placeholder=""><br><br>
                        
                  
                        <button  type="submit" name="submit" class="cust">submit</button>
                  
                </form>

	</div>
	</div>
	<?php
			$tab++;
		
            }
	}
	?>
       
	</body>
</html>