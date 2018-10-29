<?php
session_start();
include("../config.php");
require("../mail.php");
if (!isset($_SESSION['UserID'])) {
		header("location:../index.php");
		exit;
}
$idnum= $_GET['TendererID'];
$tenderid = $_SESSION['TenderID'];
echo $tenderid;
echo $idnum;
$tab2 = 1;
$count2 = 0;   
$sqli = "UPDATE applications SET Status='REJECTED' WHERE TendererID='$idnum' && TenderID='$tenderid'";
$result2 = mysqli_query($conn,$sqli);
//$count2= mysqli_num_rows($result2);
//$row2= mysqli_num_rows($result2);

$sql = "SELECT * FROM tenderers";
$result = mysqli_query($conn,$sql);
$count= mysqli_num_rows($result);
$row= mysqli_num_rows($result);

$sqlii = "SELECT * FROM tenders WHERE TENDERID=$tenderid";
$result3 = mysqli_query($conn,$sql);
$count3= mysqli_num_rows($result3);
$row3= mysqli_num_rows($result3);

while ($row=mysqli_fetch_row($result)){

         if($row[2]==$idnum){ 
           	$msg = "
	 			  <h1>Rejection email</h1><br>
	 			  <h2>Your Tender Application for <i>$row3[1]</i> has been rejected</h2>
	 			  <h3>This email is to inform you that your application has been rejected, because you did not meet some requirents. </h3>";
				  $mail = $row[4];
				  echo "<script>alert($mail);</script>";
				  sendmail($msg,$mail);
         echo $row[3];
         }}
                 
if ($conn->query($sqli) === TRUE) {
    echo "Record updated successfully";
    header("location:../Manager/viewapplicants.php?TENDERID=". $tenderid ."");
} else {
    echo "Error updating record: " . $conn->error;
     header("location:../Manager/viewapplicants.php?TENDERID=". $tenderid ."");
}
?>