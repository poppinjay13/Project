
<?php
session_start();
include("../config.php");
if (!isset($_SESSION['UserID'])) {
    header("location:../index.php");
    exit;
}


$tid= $_GET['TenderID'];
$uid = $_SESSION['UserID'];
$tab2 = 1;
$count2 = 0;
$tab = 1;
$count = 0;

$sqli = "UPDATE applications SET Status='COMPLETED' WHERE TendererID='$uid' && TenderID='$tid'";
$result2 = mysqli_query($conn,$sqli);
//the status of the tender on the applicants table will be set to updated.
$msqli = "UPDATE tenders SET Status='COMPLETED' WHERE TenderID='$tid'";
$result4 = mysqli_query($conn,$msqli);
//the status of the tender on the tender table will be set to approved.


if ($conn->query($sqli) === TRUE) {

    echo "Record updated successfully";
    header("location:../Tenderer/port.php");

} else {
    echo "Error updating record: " . $conn->error;
      header("location:../Tenderer/port.php");
}
?>
