<?php
session_start();
include("config.php");
//$uid = $_SESSION['User_ID'];
$float=$tenderer=$dept=$done="";
$float = "SELECT * FROM tenders";
$resultf = mysqli_query($conn,$float);
$countf = mysqli_num_rows($resultf);//total tenders
$tenderer = "SELECT * FROM tenderers";
$resultt = mysqli_query($conn,$tenderer);
$countt = mysqli_num_rows($resultt);//total tenderers
$dept = "SELECT * FROM heads";
$resultd = mysqli_query($conn,$dept);
$countd = mysqli_num_rows($resultd);//total department managers
$done = "SELECT * FROM tenders WHERE status = 'Complete'";
$resultdn = mysqli_query($conn,$done);
$countdn = mysqli_num_rows($resultdn);//total tenderers
//queries to populate the table
$query = "SELECT * FROM tenders ORDER BY TenderID DESC";
$result = mysqli_query($conn,$query);
$count = mysqli_num_rows($result);
?>
<html>
<head>
  <link href="css/admin.css" rel="stylesheet">
  <title>Admin Module</title>
</head>
<body>
   <ul class="navbar">
   <li class="img"><img src="images/user.png"></li>
    <li><a class="active">Dashboard</a></li>
    <li><a href="users.php">Users</a></li>
    <li><a href="">Profile</a></li>
    <li><a href="logout.php">Log Out</a></li>
   </ul>
  <div class="stats">
  <h1><B>Dashboard</B></h1>
  <section><h3><?php echo $countf?><br>Tenders floated</h3></section>
  <section><h3><?php echo $countt?><br>Tenderers</h3></section>
  <section><h3><?php echo $countd?><br>Department Managers</h3></section>
  <section><h3><?php echo $countdn?><br>Tenders completed</h3></section>
  </div>
  <div class="load-data">
  <h2>RECENT ACTIVITY</h2>
    <table>
      <thead>
        <tr>
          <th>NAME</th>
          <th>DEPARTMENT</th>
          <th>DEPARTMENT MANAGER</th>
          <th>DEADLINE</th>
          <th>STATUS</th>
        <tr>
       	<tr class="spacer"></tr>
      </thead>
      <tbody>
        <div class="tenderdata">
      <?php
      if($count >= 1){
        while ($row=mysqli_fetch_row($result)){
          ?>
      	<tr>
      		<td><?php echo $row[1]?></td>
      		<td><?php echo $row[2]?></td>
      		<td><?php echo $row[4]?></td>
      		<td><?php echo $row[6]?></td>
      		<td><?php echo $row[7]?></td>
      	</tr>
      	<tr class="spacer"></tr>
      <?php
      }
    }else{?>
      <td colspan='5'>No Recent Activity to Display</td>
    <?php }?>
      </div>
		</tbody>
    </table>
  </div>
</body>
</html>
