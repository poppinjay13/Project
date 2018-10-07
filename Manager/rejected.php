<?php
session_start();
include("../config.php");
$idnum= $_GET['TendererID'];
$tenderid = $_SESSION['TenderID'];
echo $idnum;
$tab2 = 1;
$count2 = 0;   
$sqli = "UPDATE applications SET Status='REJECTED' WHERE TendererID='$idnum' && TenderID='$tenderid'";
$result2 = mysqli_query($conn,$sqli);
$count2= mysqli_num_rows($result2);
$row2= mysqli_num_rows($result2);

                 
if ($conn->query($sqli) === TRUE) {
    echo "Record updated successfully";
    header("location:../Manager/viewapplicants.php?TENDERID=". $tenderid ."");
} else {
    echo "Error updating record: " . $conn->error;
     header("location:../Manager/viewapplicants.php?TENDERID=". $tenderid ."");
}
?>
