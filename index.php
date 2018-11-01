<?php
   session_start();
   require("config.php");
   require("valid.php");
   $error = "null";
   $myemail = $mypassword = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myemail = mysqli_real_escape_string($conn,$_POST['email']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']);
      if(!validemail($myemail)){
        $error = "That email address looks incorrect. Please recheck it.";
      }else{
      $sql = "SELECT * FROM login WHERE Email = '$myemail' and Password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result);
      if($count == 1) {
        		 $row=mysqli_fetch_row($result);
             if($row[1]=='tenderer'){
               $_SESSION['UserID'] = $row[0];
               header("location: Tenderer/home.php");
             }
             else if($row[1]=='department manager'){
               $_SESSION['ManID'] = $row[0];
               header("location: Manager/manager.php");
             }else if($row[1]=='administrator'){
               $_SESSION['AdminID'] = $row[0];
               header("location: Admin/admin.php");
             }else{
               $error = "Please contact the administrator for help with your account!";
             }
      }else {
         $error = "Your Login Account or Password is invalid !";
      }
   }
 }
?>
<html>
	<head>
		<link href="assets/css/login.css" type="text/css" rel="stylesheet">
		<link href="assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>School Tendering System</title>
	</head>
	<body>
		<div class="info">
			<section>
				<h1>TENDERAMA</h1>
				<h2>A website for all your tendering needs.</h2>
        <h3>
					This web based application is the pet project of 100446 and 99460
					to be presented in the second year of their studies
					for the award of a degree in their Informatics and Computer Science Course
					at Strathmore University.
				</h3>
				<h4>Not yet tendering with us? <a href="signup.php">Click here.</a></h4>
        <h4><a href="mailto:tenderama254@gmail.com?Subject=Authentication%20Error" target="_top">Having trouble logging in?</a></h4>
			</section>
		</div>
		<div class="login_box">
			<center><section>
				<img src="assets/images/loginbg.png" class="loginbg"><br>
				<h5>Please log into your account to continue</h5>
				<form method="post">
					<input type="text" placeholder="Email" name="email" style="background-image: url(assets/images/login.png)" value="<?php echo $myemail ?>"><br>
					<input type="password" placeholder="Password" name="password"  style="background-image: url(assets/images/password.png)" value="<?php echo $mypassword ?>"><br>
					<button formaction="#">LOGIN</button>
				</form>
				<?php
					if($error != "null"){
				?>
				<div style = "font-size:15px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
				<?php
					}
				?>
			</section></center>
		</div>
	</body>
</html>
