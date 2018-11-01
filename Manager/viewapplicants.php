<?php
session_start();
include("../config.php");
if (!isset($_SESSION['ManID'])) {
    header("location:../index.php");
    exit;
}
//require("../mail.php");
$Tenderid= $_GET['TENDERID'];
$depart = $_SESSION['Department'];
//$yes=$_GET['comments'];
//echo $yes;
$tab = 1;
$count = 0;
$sql = "SELECT * FROM applications where TenderID=$Tenderid";
$result = mysqli_query($conn,$sql);
$count= mysqli_num_rows($result);
$row=mysqli_fetch_row($result);
$_SESSION['TenderID'] = $row[0];
        $Tenderid = $_SESSION['TenderID'];


$tab2 = 1;
$count2 = 0;
$sqli = "SELECT * FROM tenders where TenderID='$Tenderid' AND Department='$depart' ";
$result2 = mysqli_query($conn,$sqli);
$count2= mysqli_num_rows($result2);
$row2=mysqli_fetch_row($result2);


?>
<html>
<head>

    <script src="jquery.js"></script>


        </script>
		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>View tender applications</title>
	</head>
	<body>
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
	<?php

	?>
	<center>
	<h2 style="color:white;" style="color:white;">Applicants of  <?php echo $row2[1];?></h2><br>

	</center>

<div class="tendernew"><br>
<center><h3>APPLICANTS</h3>



			 <?php


                     if($result = $conn->query($sql)){
                        if($result->num_rows > 0){

                       echo "<table>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>TenderID</th>";
                                    echo "<th>IDNo</th>";
                                    echo "<th>Submission date</th>";
                                    echo "<th>Status</th>";




                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                   while($row= $result->fetch_array()){


                                echo "<tr>";
                                    echo "<td>" . $row['TenderID'] . "</td>";
                                    echo "<td>" . $row['TendererID'] . "</td>";
                                    echo "<td>" . $row['Completion'] . "</td>";
                                  echo "<td>" . $row['Status'] . "</td>";


                                echo "<td>";


            echo "<a class='button2' href='singleapplicant.php?Tendererid=". $row[1] ."' title='ViewApplicants'  >View Details</a>";//on clicking this button you can view applicants of the specific tender selected



                                    echo "</td>";
                       echo "<td>";




                                echo "</tr>";
                                }
                            echo "</tbody>";
                        echo "</table>";

                        // Free result set
                        $result->free();
                         }else{
                        echo "<p class='lead'><em>No applicants yet.</em></p>";
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
