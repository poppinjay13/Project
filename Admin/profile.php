<?php
session_start();
include "../config.php";
$uid = $_SESSION['UserID'];//insert ID from sessions
$sql = "SELECT * FROM administrators where AdminID = $uid";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
$stmt = $conn->prepare("UPDATE administrators SET Email = ?, Phone = ? WHERE AdminID = $uid");//update details in admin table
$logmail = $conn->prepare("UPDATE login SET Email = ? WHERE Idnum = $uid");//update email in login table
$logpass = $conn->prepare("UPDATE login SET Password = ? WHERE Idnum = $uid");//update email in login table
if($_SERVER["REQUEST_METHOD"] == "POST") {
	try{
	   $email = mysqli_real_escape_string($conn,$_POST['email']);
		 $phone = mysqli_real_escape_string($conn,$_POST['phone']);
	   $password = mysqli_real_escape_string($conn,$_POST['password']);
		 $repassword = mysqli_real_escape_string($conn,$_POST['repassword']);
		 if($password == $repassword){//if password fields are matching
			 $stmt->bind_param("ss",$email,$phone);
			 $stmt->execute();
			 $logmail->bind_param("s",$email);
			 $logmail->execute();
			 if($password != ""){//if new passwords are not null
				 $logpass->bind_param("s",$password);
				 $logpass->execute();
			 }
			 header("location: profile.php");//reload page to refresh form
		 }else{
			 $error = "Ensure passwords entered match!";
		 }
   }catch(Exception $ex){
     $error = "Error Updating Your Account Details!";
   }
 }
?>
<html>
<head>
  <link href="../assets/css/profile.css" rel="stylesheet"/>
  <link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
  <title>Admin Module</title>
</head>
<body>
  <ul class="navbar"><!--vertical navigation bar-->
  <li class="img"><img src="../assets/images/user.png"></li>
   <li><a href="admin.php">Dashboard</a></li>
   <li><a href="users.php">Users</a></li>
   <li><a class="active">Profile</a></li>
   <li><a href="../logout.php">Log Out</a></li>
  </ul>
  <div class="details"><!--admin details-->
    <form method="POST">
    <fieldset>
      <legend><?php echo $row['1'] ?></legend>
      <label for = "idnum">ID Number</label><br/>
      <input name="idnum" type="text" value="<?php echo $row['0'] ?>" title="Cannot edit ID Number" readonly/><br/><br/>
      <label for = "email">Email Address</label><br/>
      <input name="email" type="text" value="<?php echo $row['2'] ?>"/><br/><br/>
      <label for = "phone">Phone Number</label><br/>
      <input name="phone" type="text" value="<?php echo $row['3'] ?>"/><br/><br/>
      <label for = "password">Password</label><br/>
      <input name="password" type="password"/><br/><br/>
      <label for = "repassword" class="repassword">Re-Enter Password</label><br/>
      <input name="repassword" type="password"/><br/><br/>
      <input type="submit" class="btn" value="Update Details"/><br/><br/>
    </fieldset>
    </form>
  </div>
</body>
</html>
