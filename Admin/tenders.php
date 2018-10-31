<?php
session_start();
require ("../config.php");
require ("../mail.php");
if (!isset($_SESSION['AdminID'])) {
    header("location:../index.php");
    exit;
}
if($_SERVER["REQUEST_METHOD"] == "GET") {
  $tid = $_GET['id'];
  $tender = "SELECT * FROM tenders WHERE TenderID = $tid";
  $result = mysqli_query($conn,$tender);
  $row = mysqli_fetch_row($result);
}else{
  $_SESSION['alert']="Could not display tender details at this time. Please try again later!";
  //header("location:admin.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $tid = $_GET['id'];
  $Name = $conn->real_escape_string($_REQUEST['Name']);
  $Department =$conn->real_escape_string($_REQUEST['Department']);
  $Requirements = $conn->real_escape_string($_REQUEST['Requirements']);
  $Enquiries = $conn->real_escape_string($_REQUEST['Enquiries']);
  $Deaddate = $conn->real_escape_string($_REQUEST['Deaddate']);
      //Prepare an update statement
      $sql = "UPDATE tenders SET Name = ?, Department = ?, Requirements = ?, Enquiries = ?, Deaddate = ? WHERE TenderID = $tid";
      if ($stmt = $conn->prepare($sql)) {
          # Bind variables to the prepared statement as parameters
          $stmt->bind_param("sssss",$param_Name,$param_Department,$param_Requirements,$param_Enquiries,$param_Deaddate);
          #Set the parameters
          $param_Name = $Name;
          $param_Department = $Department;
          $param_Requirements = $Requirements;
          $param_Enquiries = $Enquiries;
          $param_Deaddate = $Deaddate;
          #Attempt to execute the prepared statement
          if ($stmt->execute()){
              #Redirect to admin page
              header("location: admin.php");
          }else{
              $_SESSION['alert']="Something went wrong :( Please try again later";
          }
      }
      #Close statement
      $stmt->close();
}
?>
<html>
<head>
  <link href="../assets/css/adminedit.css" type="text/css" rel="stylesheet"/>
  <link href="../assets/css/admin.css" type="text/css" rel="stylesheet"/>
	<link href="../assets/css/alert.css" type="text/css" rel="stylesheet">
  <link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
  <title>Tenderama | Tender</title>
</head>
<body>
  <ul class="navbar"><!--vertical navigation bar-->
  <li class="img"><img src="../assets/images/user.png"></li>
   <li><a href="admin.php">Dashboard</a></li>
   <li><a href="users.php">Users</a></li>
   <li><a href="profile.php">Profile</a></li>
   <li><a class="active">Tender</a></li>
   <li><a href="../logout.php">Log Out</a></li>
  </ul>
  <div class="details"><!--tenders details-->
		<?php
	    if(isset($_SESSION['alert'])){
	      echo "<div class='alert'>$_SESSION[alert]</div>";
				unset($_SESSION['alert']);
	    }
	    ?>
    <form method="POST">
      <h2>Tender Details</h2>
    <fieldset>
      <legend>Edit Tender Details</legend>
      <label for = "Name">Name:</label><br/>
      <input name="Name" type="text" value="<?php echo $row['1'] ?>"/><br/><br/>
      <label for = "Department">Department:</label><br/>
      <select name="Department" id="Department">
        <option value="Languages">Languages</option>
        <option value="Mathematics">Mathematics</option>
        <option value="Humanities">Humanities</option>
        <option value="Sciences">Sciences</option>
        <option value="Technical">Technical</option>
        <option value="Economics">Economics</option>
        <option value="Business">Business</option>
        <option value="Laboratory">Laboratory</option>
        <option value="Administration">Administration</option>
        <option value="Finance">Finance</option>
        <option value="Guidance and Counselling">Guidance and Counselling</option>
      </select><br/><br/>
      <label for = "Requirements">Requirements:</label><br/>
      <textarea name="Requirements"><?php echo $row['3'] ?></textarea><br/><br/>
      <label for = "Enquiries">Enquiries</label><br/>
      <input name="Enquiries" type="text" value="<?php echo $row['4'] ?>"/><br/><br/>
      <label for = "Deaddate">Deaddate</label><br/>
      <input name="Deaddate" type="date" value="<?php echo (substr($row[5],0,10)) ?>"/><br/><br/>
      <input type="submit" class="btn" value="Update Tender"/><br/><br/>
    </fieldset>
    </form>
  </hr>
    <div>
      <h2>Tender Applications</h2>
      <?php
      $apply="SELECT * FROM applications WHERE TenderID = $tid";//Query for submitted applications
      $resapps = mysqli_query($conn,$apply);
      $countapps = mysqli_num_rows($resapps);
      ?>
      <table>
        <thead>
          <tr>
            <th>TendererID</th>
            <th>Business</th>
            <th>Price</th>
            <th>Completion Date</th>
            <th>Document</th>
            <th>Status</th>
          <tr>
         	<tr class="spacer"></tr>
        </thead>
        <tbody>
          <div class="tenderdata">
        <?php
        if($countapps >= 1){
          while ($app=mysqli_fetch_row($resapps)){
            ?>
        	<tr class="tender" title="Click to view Tender Document" onclick="location.href = '../applications/<?php echo $app[9]?>'">
        		<td><?php echo $app[1]?></td>
        		<td><?php echo $app[3]?></td>
        		<td><?php echo $app[5]?></td>
        		<td><?php echo (substr($app[6],0,10))?></td>
        		<td><?php echo $app[9]?></td>
            <td><?php echo $app[10]?></td>
        	</tr>
        	<tr class="spacer"></tr>
        <?php
        }
      }else{?>
        <td colspan='6'>No Applications to Display for this Tender</td>
      <?php }?>
        </div>
  		</tbody>
      </table></div>
  </div>
</body>
<script>
SelectElement("Department", "<?php echo $row['2']?>");
function SelectElement(id, valueToSelect)
{
    var element = document.getElementById(id);
    element.value = valueToSelect;
}
</script>
</html>
