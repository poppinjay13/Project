<?php
session_start();
include '../config.php';
if (!isset($_SESSION['AdminID'])) {
		header("location:../index.php");
		exit;
}
$uid = $_SESSION['AdminID'];
?>
<html>
<head>
  <link href="../assets/css/users.css" rel="stylesheet">
	<link href="../assets/css/alert.css" type="text/css" rel="stylesheet">
  <link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
  <title>Admin Module</title>
</head>
<body>
   <ul class="navbar">
   <li class="img"><img src="../assets/images/user.png"></li>
    <li><a href="admin.php">Dashboard</a></li>
    <li><a class="active">Users</a></li>
    <li><a href="profile.php">Profile</a></li>
    <li><a href="../logout.php">Log Out</a></li>
   </ul>
  <div class="load-data">
		<?php
	    if(isset($_SESSION['alert'])){
	      echo "<div class='alert'>$_SESSION[alert]</div>";
				unset($_SESSION['alert']);
	    }
	    ?>
    <!--TABLE FOR DEPARTMENT MANAGERS-->
    <h1 style="text-align:center;">DEPARTMENT MANAGERS</h1>
    <?php
    $heads = "SELECT * FROM heads";
    $reshead = mysqli_query($conn,$heads);
    ?>
    <table>
      <thead>
        <tr>
          <th>ADMIN ID</th>
          <th>NAME</th>
          <th>EMAIL</th>
          <th>DEPARTMENT</th>
          <th>CONTACT</th>
          <th></th>
		</tr>
     	<tr class="spacer"></tr>
      </thead>
      <tbody>
      <?php
        while ($row=mysqli_fetch_row($reshead)){
      ?>
      <div class="tenderdata">
      	<tr>
      		<td><?php echo $row['0']?></td>
      		<td><?php echo $row['1']?></td>
      		<td><?php echo $row['2']?></td>
      		<td><?php echo $row['3'] ?></td>
          <td><?php echo $row['4'] ?></td>
          <td>
            <?php
            echo "<div onclick='manager($row[0])' class='editor'>EDIT USER DETAILS</div>";
            ?>
          </td><!--php send id-->
      	</tr>
      	<tr class="spacer"></tr>
      </div>
      <?php }?>
		</tbody>
    <tr class="spacer"></tr>
    <tr class="spacer"></tr>
    </table>
    <div id="btnadd"><a href="newdept.php"><button class="btnadd">Add New Department Manager</button></a></div>
    <!--TABLE FOR TENDERERS-->
    <h1 style="text-align:center;">TENDERERS</h1>
     <?php
     $tenderers = "SELECT * FROM TENDERERS";
     $restenderers = mysqli_query($conn,$tenderers);
     ?>
      <table>
        <thead>
          <tr>
            <th>NAME</th>
            <th>PHONE NUMBER</th>
            <th>EMAIL</th>
            <th>ADDRESS</th>
            <th>P.O. BOX</th>
            <th></th>
  		</tr>
       	<tr class="spacer"></tr>
        </thead>
        <tbody>
          <?php
            while ($row=mysqli_fetch_row($restenderers)){
          ?>
        <div class="tenderdata">
        	<tr>
        		<td><?php echo $row['1']?></td>
        		<td><?php echo $row['3']?></td>
        		<td><?php echo $row['4']?></td>
        		<td><?php echo $row['5']?></td>
        		<td><?php echo $row['6']?></td>
  			    <td>
              <?php
              echo "<div onclick='user($row[2])' class='editor'>EDIT USER DETAILS</div>";
              ?>
            </td><!--php send id-->
        	</tr>
        	<tr class="spacer"></tr>
        </div>
        <?php }?>
  		</tbody>
      <tr class="spacer"></tr>
      <tr class="spacer"></tr>
      </table>
      <div id="btnadd"><a href="newuser.php"><button class="btnadd">Add New Tenderer</button></a></div>
  </div>
  <script type="text/javascript">
		function manager(data){
			var form = document.createElement("form");
			form.target = "_self";
			form.method = "GET";
			form.action = "editdept.php";
			form.style.display = "none";
			var input = document.createElement("input");
			form.appendChild(input);
			input.type = "hidden";
			input.name = "deptid";
			input.value = data;
			document.body.appendChild(form);
			form.submit();
			document.body.removeChild(form);
			}
      function user(data){
  			var form = document.createElement("form");
  			form.target = "_self";
  			form.method = "GET";
  			form.action = "edituser.php";
  			form.style.display = "none";
  			var input = document.createElement("input");
  			form.appendChild(input);
  			input.type = "hidden";
  			input.name = "user";
  			input.value = data;
  			document.body.appendChild(form);
  			form.submit();
  			document.body.removeChild(form);
  			}
	</script>
</body>
</html>
