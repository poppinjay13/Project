<html>
<head>
  <link href="../assets/css/profile.css" rel="stylesheet"/>
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
    <form>
      <label for = "name">Username</label><br/>
      <input name="name" type="text" readonly/><br/>
      <label for = "idnum">ID Number</label><br/>
      <input name="idnum" type="text"/><br/>
      <label for = "email">Email Address</label><br/>
      <input name="email" type="text"/><br/>
      <label for = "phone">Phone Number</label><br/>
      <input name="phone" type="text"/><br/>
      <label for = "password">Password</label><br/>
      <input name="password" type="password" onclick="reshow();"/><br/>
      <label for = "repassword" class="repassword">Re-Enter Password</label><br/>
      <input name="repassword" type="password" class="repassword"><br/>
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
