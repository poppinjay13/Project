<?php
include "../config.php";
/*
$sql = "SELECT * FROM administrators where AdminID = $uid";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
$stmt = $conn->prepare("UPDATE administrators
SET Email = ?, Password = ?
WHERE AdminID = $uid");
//$stmt->bind_param("ss",$email,$password);
if($_SERVER["REQUEST_METHOD"] == "POST") {
	try{
	   $email = mysqli_real_escape_string($conn,$_POST['email']);
	   $password = mysqli_real_escape_string($conn,$_POST['password']);
   }catch(Exception $ex){
     $error = "Error Updating Account Details!";
   }
 }*/
?>
<html>
<head>
  <link href="../assets/css/adminedit.css" rel="stylesheet"/>
  <link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
  <title>Admin Module</title>
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
  <div class="details"><!--department manager details to be edited-->
    <form method="POST">
    <fieldset>
      <legend><?php echo "Manager ID:"//"$row['1']" ?></legend>
      <label for = "name">Full Name</label><br/>
      <input name="name" type="text" value="<?php //echo $row['0'] ?>"/><br/><br/>
      <label for = "email">Email Address</label><br/>
      <input name="email" type="text"/><br/><br/>
      <label for = "department">Department</label><br/>
      <select name="department">
        <option value="Languages">Languages</option>
        <option value="Mathematics">Mathematics</option>
        <option value="Humanities">Humanities</option>
        <option value="Sciences">Sciences</option>
        <option value="Technical">Technical</option>
        <option value="Economics">Economics</option>
        <option value="Business">Business</option>
        <option value="Laboratory">Laboratory</option>
        <option value="Administration" selected>Administration</option>
        <option value="Finance">Finance</option>
        <option value="Guidance and Counselling">Guidance and Counselling</option>
      </select><br/><br/>
      <label for = "phone">Phone Number</label><br/>
      <input name="phone" type="text"/><br/><br/>
      <label for = "password">Password</label><br/>
      <input name="password" type="password" onclick="reshow();"/><br/><br/>
      <label for = "repassword" class="repassword">Re-Enter Password</label><br/>
      <input name="repassword" type="password" class="repassword"/><br/><br/>
      <input type="submit" class="btn" value="Update Details"/><br/><br/>
    </fieldset>
    </form>
  </div>
</body>
<script>
document.ready({
  var reenter = document.getElementsByClassName('repassword'), i;

  for (var i = 0; i < reenter.length; i ++) {
      reenter[i].style.display = 'none';
  }
function reshow(){
//the re-enter password field is only visible if the password field is clicked
for (var i = 0; i < reenter.length; i ++) {
    reenter[i].style.display = 'visible';
}
}
});
</script>
</html>
