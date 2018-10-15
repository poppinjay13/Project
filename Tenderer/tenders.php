<?php
require("../config.php");
require("../mail.php");
if (!isset($_SESSION['UserID'])) {
		header("location:../index.php");
		exit;
}
$uid = $_SESSION['UserID'];
if($_SERVER["REQUEST_METHOD"] == "GET") {
	$_SESSION['tendid'] = $_GET['key'];
}
$tender = $_SESSION['tendid'];
$sql1 = "SELECT * FROM tenders where TenderID = $tender";
$result1 = mysqli_query($conn,$sql1);
$count1 = mysqli_num_rows($result1);
?>
<html>
	<head>
		<link href="../assets/css/tender.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Tenderer's Module</title>
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
		<li><a href="#" class="active"><span>Tender Details</span></a></li>
		<div class="top_right">
			<li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>
		</div>
	</ul>
	<div class="tend">
	<centre>
  <h1>Tender Application Details<br><br></h1>
	</centre>
		<?php
		if($count1 == 1){
		$row=mysqli_fetch_row($result1);
		?>
		<form>
			Tender Name:  <i><?php printf($row[1])?></i><br><br>
			Tender Description:  <i><?php printf($row[3])?></i><br><br>
			Deadline for Applications is at <i><?php printf(substr($row[5],0,10))?></i><br><br>
			For Enquiries or clarification please contact:  <i><?php printf($row[4])?></i><br><br>
		</form>
	</div>
	<?php
	}else{
		echo "<h3>Error Encountered Retrieving The Details of This Tender.<br> Please try again later!</h3>";
	}
	$uid = $_SESSION['UserID'];
	$sql2 = "SELECT * FROM tenderers where IDNo = $uid";
	$result2 = mysqli_query($conn,$sql2);
	$count2 = mysqli_num_rows($result2);
	if($count2 == 1){
	$rowt=mysqli_fetch_row($result2);
	?>
	<hr>
	<div class="tendall">
	<h1>Tenderer's Application Details<br><br></h1>
	<div class="tendrlft">
	<form method="post" action="#" enctype="multipart/form-data">
		Name:
		<input type="text" name="tername" value="<?php printf($rowt[1])?>" readonly><br><br>
		ID Number:
		<input type="text" name="terID" value="<?php printf($rowt[2])?>" readonly><br><br>
		Business:
		<input type="text" name="biz" placeholder="Registered name of your Business" required><br><br>
		Position:
		<input type="text" name="pos" placeholder="Positon you hold in above business"><br><br>
	</div>
	<div class="tendrght">
		Asking Price:
		<input type="text" name="price" placeholder="(Ksh) 12345" required><br><br>
		Scheduled Completion:
		<input type="text" name="complete" placeholder="12/12/2018" required><br><br>
		Amount of Goods:
		<input type="text" name="amount" placeholder="12345 (Kgs)" required><br><br>
		Location:
		<input type="text" name="locate" placeholder="Where is the business located?"><br><br>
	</div>
	</div>
	<br><br>
	<div id="centre">
	<i><span style="color:#303940;">Tender Documents Required<br></span>Kindly upload required Tender Documents in pdf format below:</i><br><br>
	<input type="file" id="upload" name="doc" accept="application/pdf" required/>
	<div id="fileupload"><label for="upload">Click to pick a file</label></div><br><br>
	<input type="checkbox" required>
	I understand that all supplied information is viable for verification<br>
 and any discrepancies amount to a felony	and may lead to criminal persecution.
	<br><br>
	<input type="submit" id="btnSub" value="Apply for Tender?"></button>
	</div>
</form>
	</body>
</html>
<?php
}else{
	echo "<h3>Error Encountered Retrieving Your Details.<br> Please Try Again Later!</h3>";
}
$stmt = $conn->prepare("INSERT INTO applications
(TenderID,TendererID,Name,Business,Position,Price,Completion,Amount,Location,Docs)
VALUES (?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssssss",$tenderid,$tendererid,$name,$business,$pos,$price,$completion
,$amnt,$location,$docs);
if($_SERVER["REQUEST_METHOD"] == "POST") {
	try{
     $tenderid = $tender;
     $tendererid = mysqli_real_escape_string($conn,$_POST['terID']);
		 $name = mysqli_real_escape_string($conn,$_POST['tername']);
	   $business = mysqli_real_escape_string($conn,$_POST['biz']);
	   $pos = mysqli_real_escape_string($conn,$_POST['pos']);
	   $price = mysqli_real_escape_string($conn,$_POST['price']);
	   $completion = mysqli_real_escape_string($conn,$_POST['complete']);
	   $amnt = mysqli_real_escape_string($conn,$_POST['amount']);
	   $location = mysqli_real_escape_string($conn,$_POST['locate']);
      //code for file upload below
			$filename = $_FILES['doc']['name'];
      $newname = $tenderid."-".$tendererid.".pdf";
      $target_dir = "../applications/";
      $target_file = $target_dir.$newname;
      $uploadOk = 1;
      $DocType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
      if (file_exists($target_file)) {
				echo "<script>alert('Seems like you already applied for this tender. Tsk!');</script>";
        $uploadOk = 0;
			}else{
      // Check file size
      if ($_FILES["doc"]["size"] > 10000000) {
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
        if (move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file)) {
          echo "<script>alert('The file ". basename( $_FILES["doc"]["name"])." has been uploaded.');</script>";
          $docs = $newname;
		  		$stmt->execute();
					$message = "Your Tender Has Been Succesfully Sent.";
					$recipient = $rowt['4'];
					sendmail($message,$recepient);
        } else {
          echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
      }
		}
	 }catch(Exception $e){
		 echo "<script>alert('Unable to submit application presently. Please try again later');</script>";
		 header("location: home.php");
	 }
 }
?>
