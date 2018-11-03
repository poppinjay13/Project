<?php
session_start();
include("../config.php");
if (!isset($_SESSION['AdminID'])) {
		header("location:../index.php");
		exit;
}
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
$done = "SELECT * FROM tenders WHERE status = 'Completed'";
$resultdn = mysqli_query($conn,$done);
$countdn = mysqli_num_rows($resultdn);//total tenderers
//queries to populate the table
$query = "SELECT * FROM tenders ORDER BY TenderID DESC";
$result = mysqli_query($conn,$query);
$count = mysqli_num_rows($result);
?>
<html>
<head>
  <link href="../assets/css/admin.css" rel="stylesheet">
	<link href="../assets/css/alert.css" type="text/css" rel="stylesheet">
  <link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
	<script src="../assets/js/notify.js" type="text/javascript"></script>
  <title>Tenderama | Admin</title>
</head>
<body>
   <ul class="navbar">
   <li class="img"><img src="../assets/images/user.png"></li>
    <li><a class="active">Dashboard</a></li>
    <li><a href="users.php">Users</a></li>
    <li><a href="profile.php">Profile</a></li>
    <li><a href="../logout.php">Log Out</a></li>
   </ul>
  <div class="stats">
		<?php
	    if(isset($_SESSION['alert'])){
	    ?>
	    <script>notifyMe("<?php echo $_SESSION['alert']?>");</script>
	    <?php
	      unset($_SESSION['alert']);
	    }
	    ?>
  <h1><B>Dashboard</B></h1>
  <section><h3 style="font-size: 30px;"><?php echo $countf?></h3><h3>Tenders floated</h3></section>
  <section><h3 style="font-size: 30px;"><?php echo $countt?></h3><h3>Tenderers</h3></section>
  <section><h3 style="font-size: 30px;"><?php echo $countd?></h3><h3>Department Managers</h3></section>
  <section><h3 style="font-size: 30px;"><?php echo $countdn?></h3><h3>Tenders completed</h3></section>
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
      	<tr class="tender" onclick="details('<?php echo $row[0]?>');" title="View Request Information">
      		<td><?php echo $row[1]?></td>
      		<td><?php echo $row[2]?></td>
      		<td><?php echo $row[4]?></td>
      		<td><?php echo (substr($row[5],0,10))?></td>
      		<td><?php echo $row[6]?></td>
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
<script>
function details(id){
		var form = document.createElement("form");
		form.target = "_self";
		form.method = "GET";
		form.action = "tenders.php";
		form.style.display = "none";
		var input = document.createElement("input");
		form.appendChild(input);
		input.type = "hidden";
		input.name = "id";
		input.value = id;
		document.body.appendChild(form);
		form.submit();
		document.body.removeChild(form);
	}
</script>
</html>
