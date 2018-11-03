<?php
session_start();
include("../config.php");
if (!isset($_SESSION['UserID'])) {
    header("location:../index.php");
    exit;
}
require("../mail.php");
$Tenderid = $_SESSION['TenderID'];
$Tendererid= $_GET['Tendererid'];
$depart = $_SESSION['Department'];
$comm='<p id="demo"></p>';
$_SESSION['Comments'] = $comm;
        $comments = $_SESSION['Comments'];
//echo $comm;
//$Tenderid= $_GET['TENDERID'];
$tab = 1;
$count = 0;
$sql = "SELECT * FROM applications where TendererID=$Tendererid AND TenderID=$Tenderid ";
$result = mysqli_query($conn,$sql);
$count= mysqli_num_rows($result);
$row=mysqli_fetch_row($result);


$tab2 = 1;
$count2 = 0;
$sqli = "SELECT * FROM tenderers where IDNo='$Tendererid' ";
$result2 = mysqli_query($conn,$sqli);
$count2= mysqli_num_rows($result2);
$row2=mysqli_fetch_row($result2);



?>
<html>
<head>

    <script src="jquery.js"></script>



		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>View tender applications</title>
    <style>
    th,td{
      text-align: center;
    }
    </style>
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
	<h2 style="color:white;" style="color:white;">Single applicant</h2><br>

	</center>

<div class="tendernew"><br>
<center><h3>Details of <?php echo $row[1];?> on tender <?php echo $row[0];?></h3>


			 <?php


                     if($result = $conn->query($sql)){
                        if($result->num_rows > 0){

                       echo "<table style='width:75%;'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>TenderID</th>";
                                    echo "<th>IDNo</th>";
                                    echo "<th>Submission date</th>";
                            echo "<th>Status</th>";
                            echo "<th>View doc</th>";



                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                   while($row= $result->fetch_array()){
                    echo "<form method='POST' action=''>";


                                echo "<tr>";
                                    echo "<td >" . $row['TenderID'] . "</td>";
                                    echo "<td>" . $row['TendererID'] . "</td>";
                                    echo "<td>" . $row['Completion'] . "</td>";
                                  echo "<td>" . $row['Status'] . "</td>";


                                echo "<td>";

                                         echo '<a href = "../applications/'.$row['Docs'].'">View Document</a>';

                                    echo "</td>";
                     echo "</tr>";
                      if($row['Status']==''||$row['Status']==null){
                     ?>
<tr>
  <td colspan = "5">
    <BR>
   <h3>Enter Your Comments Below:</h3>
   <textarea name="comments" style="width:100%;height:300px;" placeholder="This application was rejected/accepted because...">
   </textarea>
  </td>
</tr>
<tr>
  <td colspan = "3">
    <a type='submit'<?php echo "href='accept.php?TendererID=".$row['TendererID']."'"?>>
      <img src='../assets/images/accept.jpg'>
    </a>
  </td>
  <td>
    <a type='submit'<?php echo "href='rejected.php?TendererID=".$row['TendererID']."'"?>>
      <img src='../assets/images/reject.png'>
    </a>
  </td>
</tr>
<tr>
  <td colspan="3">
    ACCEPT
  </td>
  <td>
    REJECT
  </td>
</tr>

</form>
<?php
}
else if($row['Status']=='ACCEPTED')
{
  ?>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr>
<td></td>
<td></td>

    <td colspan="3">
        <a class='button2' type='submit'<?php echo "href='finish.php?TendererID=".$row['TendererID']."'"?>>COMPLETE
    </a>
  </td>
    </tr>


<?php
}

                             if($row[10]==''||$row[10]==null){
                         $msg = "
          <h1>Tender Application Received </h1><br>
          <h2>Tender Application for <i></i></h2>
          <h3>This email is to inform you that your application has been succesfully received and will be reviewed in due time.</h3>";
          $mail = $row2[4];
          echo "<script>alert($mail);</script>";
          sendmail($msg,$mail);

                        }
                                }
                            echo "</tbody>";
                        echo "</table>";
                        echo $row[10];

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
