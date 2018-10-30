<?php
session_start();
require("../config.php");
require("../mail.php");
if (!isset($_SESSION['UserID'])) {
    header("location:../index.php");
    exit;
}

$uid= $_SESSION['UserID'];

$tab = 1;
$count = 0;
$sql = "SELECT * FROM applications where TendererID=$uid";
$result = mysqli_query($conn,$sql);
$count= mysqli_num_rows($result);
$row=mysqli_fetch_row($result);

$tab2 = 1;
$count2 = 0;
$sqli = "SELECT * FROM tenderers where IDNo='$uid' ";
$result2 = mysqli_query($conn,$sqli);
$count2= mysqli_num_rows($result2);
$row2=mysqli_fetch_row($result2);

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //code for file upload below
  $filename = $_FILES["upload"]["name"];
  $newname = $_POST['TenderID']."-".$_POST['TendererID'].".pdf";
  $target_dir = "../applications/";
  $target_file = $target_dir.$newname;
  $uploadOk = 1;
  $DocType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
  // Check file size
  if ($_FILES["upload"]["size"] > 10000000) {
    echo "<script>alert('Sorry, your file is too large.');</script>";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($DocType != "pdf"){
    echo "<script>alert('Sorry, only pdf files are allowed.');</script>";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk != 0){
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
      echo "<script>alert('The new file ". basename( $_FILES["upload"]["name"])." has been uploaded.');</script>";
      $msg = "
      <h1>Request Submission Confirmation</h1><br>
      <h2>Tender Application for <i>$row[1]</i></h2>
      <h3>This email is to inform you that your tender document has been succesfully updated and will be reviewed in due time.</h3>";
      $mail = $row2['4'];
      echo "<script>alert($mail);</script>";
      sendmail($msg,$mail);
      header("location:home.php");
    } else {
      echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
    }
  }
}

?>

<html>
<head>

    <script src="jquery.js"></script>
    <style>
    th,td{
      padding: 10px 15px;
    }
    </style>
		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Tenderama | Submitted</title>
	</head>
	<body>

	 <ul class="navbar">
      <li class="profpic">
      <object data="../assets/images/pic/<?php echo $uid?>.jpg" type="image/png">
        <img src="../assets/images/pic/profile.jpg" alt="profile">
      </object>
      </li>
      <li><a href="home.php"><span>Home</span></a></li>
      <li><a href="port.php"><span>Portfolio</span></a></li>
      <li><a href="#" class="active"><span>Submitted</span></a></li>
      <div class="top_right">
        <li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>
      </div>
    </ul>

	<div class="bod">
	<center>
	<h2 style="color:white;" style="color:white;"> <?php echo $row2[1];?>'s Submitted Tenders</h2><br>

	</center>

<div class="dynabod" style="margin-right: 200px;width: 900px;"><br>
<center><h3>SUBMITTED TENDERS</h3>
<?php
if($result = $conn->query($sql)){
  if($result->num_rows > 0){
    echo '<table style="padding-bottom:50px;">';
    echo "<thead>";
    echo "<tr>";
    echo "<th>TenderID</th>";
    echo "<th>IDNo</th>";
    echo "<th>Status</th>";
    echo "<th>Application</th>";
    echo "<th>Submit Document</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row= $result->fetch_array()){
      echo "<tr>";
      echo "<td >" . $row['TenderID'] . "</td>";
      echo "<td>" . $row['TendererID'] . "</td>";
      echo "<td>" . $row['Status'] . "</td>";
      echo '<td><a href = "../applications/'.$row['Docs'].'">View Document</a></td>';
      echo "<form method='POST' enctype='multipart/form-data'>";
      echo "<td>";
      echo '
      <input type = "hidden" name = "TenderID" value = "'.$row["TenderID"].'">
      <input type = "hidden" name = "TendererID" value = "'.$row["TendererID"].'">
      <label for = "upload" style="cursor:pointer;border:solid white;padding:5px;">Select Document</label>
      <input type="file" id="upload" name="upload" accept="application/pdf" required style="width:0px;height:0px;"/>
      <div id="fileupload"></div>
      ';
      echo "</td>";
      echo "<td>";
      echo '<input type="submit" value="Submit New Document" //style="padding:5px;cursor:pointer;">';
      echo "</td>";
      echo "</form>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "Note that submitting a new application document will overwrite the existing document";
    echo "</table>";
    echo $row[10];
    // Free result set
    $result->free();
  }else{
    echo "<p class='lead'><em>No submitted tenders  yet.</em></p>";
  }
}
// Close connection
$conn->close();
?>
</center>
</div>
    </div>

</body>
</html>
