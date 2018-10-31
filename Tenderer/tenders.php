<?php
session_start();
require("../config.php");
require("../mail.php");
require("../valid.php");
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
$business = $pos = $price = $completion = $amnt = $location = "";//initialise variables
?>
<html>
	<head>
		<link href="../assets/css/tender.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Tendererama | Tender</title>
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
		<input type="text" name="biz" placeholder="Registered name of your Business"  value="<?php echo $business ?>"required><br><br>
		Position:
		<input type="text" name="pos" placeholder="Positon you hold in above business" value="<?php echo $pos ?>"><br><br>
	</div>
	<div class="tendrght">
		Asking Price:
		<input type="text" name="price" placeholder="(Ksh) 12345" value="<?php echo $price ?>" required><br><br>
		Scheduled Completion:
		<input type="date" name="complete" placeholder="12/12/2018" value="<?php echo $completion ?>" required><br><br>
		Amount of Goods:
		<input type="text" name="amount" placeholder="12345 (Kgs)" value="<?php echo $amnt ?>" required><br><br>
		Location:
		<input type="text" name="locate" placeholder="Where is the business located?" value="<?php echo $location ?>"><br><br>
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
		if($row['6'] == "PENDING"){
     $tenderid = $tender;
     $tendererid = mysqli_real_escape_string($conn,$_POST['terID']);
		 $name = mysqli_real_escape_string($conn,$_POST['tername']);
	   $business = mysqli_real_escape_string($conn,$_POST['biz']);
	   $pos = mysqli_real_escape_string($conn,$_POST['pos']);
	   $price = mysqli_real_escape_string($conn,$_POST['price']);
	   $completion = mysqli_real_escape_string($conn,$_POST['complete']);
	   $amnt = mysqli_real_escape_string($conn,$_POST['amount']);
	   $location = mysqli_real_escape_string($conn,$_POST['locate']);
		 //check if asking price is a valid value
		 if(!validnum($price)){
			 echo "<script>alert('Your asking price seems incorrect. Please remove any commas or currency identifiers and ensure your values are all numbers then try again.');</script>";
			 $uploadOk = 0;
		 }
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
					$msg = "
	 			  <h1>Request Submission Confirmation</h1><br>
	 			  <h2>Tender Application for <i>$row[1]</i></h2>
	 			  <h3>This email is to inform you that your application has been succesfully recieved and will be reviewed in due time.</h3>";
				  $mail = $rowt['4'];
				  echo "<script>alert($mail);</script>";
				  sendmail($msg,$mail);
		  		$stmt->execute();
					header("location:home.php");
        } else {
          echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
      }
		}
	}else{
		echo "<script>alert('Unfortunately this request is no longer open for applications.');</script>";
	}
	 }catch(Exception $e){
		 echo "<script>alert('Unable to submit application presently. Please try again later');</script>";
	 }
 }
?>
