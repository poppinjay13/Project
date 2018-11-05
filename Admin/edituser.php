<?php
session_start();
require ("../config.php");
require ("../mail.php");
if (!isset($_SESSION['AdminID'])) {
		header("location:../index.php");
		exit;
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
  $userid = $_GET['user'];
  $sql = "SELECT * FROM tenderers where IDNo = $userid";
  $result = mysqli_query($conn,$sql);
  $row=mysqli_fetch_row($result);
}
$userid = $_GET['user'];
$stmt = $conn->prepare("UPDATE tenderers SET Name = ?, Email = ?, Phone = ?, Address = ?, POBox =  ? WHERE IDNo = $userid");//update tenderers table
$logmail = $conn->prepare("UPDATE login SET Email = ? WHERE Idnum = $userid");//update email in login table
$logpass = $conn->prepare("UPDATE login SET Password = ? WHERE Idnum = $userid");//update email in login table
if($_SERVER["REQUEST_METHOD"] == "POST") {
	try{
	   $name = mysqli_real_escape_string($conn,$_POST['name']);
     $email = mysqli_real_escape_string($conn,$_POST['email']);
     $phone = mysqli_real_escape_string($conn,$_POST['phone']);
		 $address = mysqli_real_escape_string($conn,$_POST['address']);
     $pobox = mysqli_real_escape_string($conn,$_POST['pobox']);
	   $password = mysqli_real_escape_string($conn,$_POST['password']);
   	 $repassword = mysqli_real_escape_string($conn,$_POST['repassword']);
     if($password == $repassword){            //if password fields are matching
			 $stmt->bind_param("sssss", $name, $email, $phone, $address, $pobox);
			 $stmt->execute();
			 $logmail->bind_param("s",$email);
			 $logmail->execute();
			 if($password != ""){               //if new passwords are not null
				 $password = md5($password);
				 $logpass->bind_param("s",$password);
				 $logpass->execute();
			 }
			 $mail = $row['4'];
			 $msg = "
			 <h1>Account Modification Alert</h1><br>
			 <h2>Alert from Tenderama Online Tendering System</h2>
			 <h3>This email is to inform you that your account details have been modified by the administrator.<br>
			 Feel free to contact the administrator for any clarification.</h3>";
			 sendmail($msg,$mail);
			 header("location: users.php");
     }
   }catch(Exception $ex){
     $_SESSION['alert'] = "Error Updating Account Details!";
   }
 }
?>
<html>
<head>
  <link href="../assets/css/adminedit.css" rel="stylesheet"/>
	<link href="../assets/css/alert.css" type="text/css" rel="stylesheet">
  <link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
	<script src="../assets/js/notify.js" type="text/javascript"></script>
  <title>Tenderama | Edit Tenderer</title>
</head>
<body>
  <ul class="navbar"><!--vertical navigation bar-->
  <li class="img"><img src="../assets/images/user.png"></li>
   <li><a href="admin.php">Dashboard</a></li>
   <li><a href="users.php">Users</a></li>
   <li><a href="profile.php">Profile</a></li>
   <li><a class="active">Edit</a></li>
   <li><a href="../logout.php">Log Out</a></li>
  </ul>
  <div class="details"><!--user details to be edited-->
		<?php
	    if(isset($_SESSION['alert'])){
	    ?>
	    <script>notifyMe("<?php echo $_SESSION['alert']?>");</script>
	    <?php
	      unset($_SESSION['alert']);
	    }
	    ?>
    <form method="POST">
    <fieldset>
      <legend><?php echo "ID Number: ".$row['2'] ?></legend>
      <label for = "name">Full Name</label><br/>
      <input name="name" type="text" value="<?php echo $row['1'] ?>"/><br/><br/>
      <label for = "email">Email Address</label><br/>
      <input name="email" type="text" value="<?php echo $row['4'] ?>"/><br/><br/>
      <label for = "phone">Phone Number</label><br/>
      <input name="phone" type="text" value="<?php echo $row['3'] ?>"/><br/><br/>
      <label for = "address">Address</label><br/>
      <input name="address" type="text" value="<?php echo $row['5'] ?>"/><br/><br/>
      <label for = "pobox">P.O. Box</label><br/>
      <input name="pobox" type="text" value="<?php echo $row['6'] ?>"/><br/><br/>
      <label for = "password">Password</label><br/>
      <input name="password" type="password"/><br/><br/>
      <label for = "repassword" class="repassword">Re-Enter Password</label><br/>
      <input name="repassword" type="password"/><br/><br/>
      <input type="submit" class="btn" value="Update Details"/><br/><br/>
    </fieldset>
    </form>
  </div>
</body>
<script>
</script>
</html>
