
<?php
session_start();
//you have to include the config.php so as to connect to database
include("../config.php");
//mail.php is required to send mails 
require("../mail.php");
//if session is not present then the tendering process is closed.
if (!isset($_SESSION['ManID'])) {
    header("location:../index.php");
    exit;
}


$idnum= $_GET['TendererID'];
$tenderid = $_SESSION['TenderID'];
$comments = $_SESSION['Comments'];
$tab2 = 1;
$count2 = 0;
$tab = 1;
$count = 0;

$sqli = "UPDATE applications SET Status='ACCEPTED' WHERE TendererID='$idnum' && TenderID='$tenderid'";
$result2 = mysqli_query($conn,$sqli);
//the status of the tender on the applicants table will be set to updated.
$msqli = "UPDATE tenders SET Status='APPROVED' WHERE TenderID='$tenderid'";
$result4 = mysqli_query($conn,$msqli);
//the status of the tender on the tender table will be set to approved.


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
            $msg ="
          <h1>Acception email</h1><br>
          
          <h3>This email is to inform you that your application has been accepted, kindly submit tender as per requirements. Submit a document too.</h3>";
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
<!DOCTYPE html>
<html>
<head>




  <script src="jquery.js"></script>

    <link href="../assets/css/home.css" type="text/css" rel="stylesheet">
    <link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
    <title>View tender applications</title>
  </head>
  <body >


  <ul class="navbar">
    <li class="profpic"><img src="../assets/images/user.png"></li>
    <li><a href="manager.php" ><span>Home</span></a></li>
    <li><a href="details.php"><span>My Details</span></a></li>
        <li><a href="#" class="active">View applicants</a></li>
    <div class="top_right">

    <li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>

    </div>
  </ul>

  <div class="bod">








</body>
</html>
