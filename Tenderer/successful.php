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
$sql = "SELECT * FROM applications where TendererID=$uid AND Status='COMPLETED'";
$result = mysqli_query($conn,$sql);
$count= mysqli_num_rows($result);
$row=mysqli_fetch_row($result);

$tab2 = 1;
$count2 = 0;
$sqli = "SELECT * FROM tenderers where IDNo='$uid' ";
$result2 = mysqli_query($conn,$sqli);
$count2= mysqli_num_rows($result2);
$row2=mysqli_fetch_row($result2);
?>

<html>
<head>

    <script src="jquery.js"></script>
    <style>
    th,td{
      padding: 10px 15px;
      text-align: center;
    }a{
      text-decoration: none;
    }
    </style>
		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Tenderama | Succesful</title>
	</head>
	<body>

<<<<<<< HEAD
	   <ul class="navbar">
            <li class="profpic">
            <object data="../assets/images/pic/<?php echo $uid?>.jpg" type="image/png">
          <img src="../assets/images/pic/profile.jpg" alt="profile">
        </object>
            </li>
            <li><a href="home.php"><span>Home</span></a></li>
            <li><a href="#" class="active"><span>Portfolio</span></a></li>
            <div class="top_right">
                <li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>
            </div>
        </ul>

	<div class="bod">
	<?php

	?>
	<center>
	   <h2 style="color:white;" style="color:white;"> <?php echo $row2[2];?>'s successful tenders</h2><br>

	</center>

<div class="tendernew"><br>
<center><h3>APPROVED TENDERS</h3>


			 <?php


                     if($result = $conn->query($sql)){
                        if($result->num_rows > 0){

                       echo "<table>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>TenderID</th>";
                                    echo "<th>IDNo</th>";
                            echo "<th>Status</th>";
                          



                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                   while($row= $result->fetch_array()){



                                echo "<tr>";
                                    echo "<td >" . $row['TenderID'] . "</td>";
                                    echo "<td>" . $row['TendererID'] . "</td>";
                                  echo "<td>" . $row['Status'] . "</td>";



                     echo "</tr>";

                                }
                            echo "</tbody>";
                        echo "</table>";
                        echo $row[10];

                        // Free result set
                        $result->free();
                         }else{
                        echo "<p class='lead'><em>No successful tenders  yet.</em></p>";
                        }
                         }

                        // Close connection
                        $conn->close();
                        ?>

=======
	 <ul class="navbar">
      <li class="profpic">
      <object data="../assets/images/pic/<?php echo $uid?>.jpg" type="image/png">
        <img src="../assets/images/pic/profile.jpg" alt="profile">
      </object>
      </li>
      <li><a href="home.php"><span>Home</span></a></li>
      <li><a href="port.php"><span>Portfolio</span></a></li>
      <li><a href="#" class="active"><span>Succesful</span></a></li>
      <div class="top_right">
        <li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>
      </div>
    </ul>
<div class="bod">
<center>
	<h2 style="color:white;" style="color:white;"> <?php echo $row2[1];?>'s Succesful Tenders</h2><br>
</center>
<div class="dynabod"><br>
<center><h3>SUCCESFUL TENDERS</h3>
<?php
if($result = $conn->query($sql)){
  if($result->num_rows > 0){
    echo '<table style="padding-bottom:50px;">';
    echo "<thead>";
    echo "<tr>";
    echo "<th>TenderID</th>";
    echo "<th>Amout (Kgs)</th>";
    echo "<th>Status</th>";
    echo "<th>Tender Document</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row= $result->fetch_array()){
      echo "<tr>";
      echo "<td >" . $row['TenderID'] . "</td>";
      echo "<td>" . $row['Amount'] . "</td>";
      echo "<td>" . $row['Status'] . "</td>";
      echo "<td>";
      echo '<a href = "../applications/'.$row['Docs'].'">View Document</a>';
      echo "</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo $row[10];
    // Free result set
    $result->free();
  }else{
    echo "<p class='lead'><em>No Succesful tenders  yet.</em></p>";
  }
}
// Close connection
$conn->close();
?>
>>>>>>> a16f631b834cf3535634473e4975856d8e673b14
</center>
</div>
</div>
</body>
</html>
