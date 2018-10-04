<?php
session_start();
include("config.php");
$Tenderid= $_GET['TENDERID'];
$tab = 1;
$count = 0;   
$sql = "SELECT * FROM applications where TenderID=$Tenderid";
$result = mysqli_query($conn,$sql);
$count= mysqli_num_rows($result);

?>
<head>
          
    <script src="jquery.js"></script>
        <script>
            var expanded=false;
        $(function showCheckboxes(){
                var checkboxes=document.getElementById("checkboxes");
            if(!expanded){
                checkboxes.style.display="block";
                expanded=true;
            }else{
                checkboxes.style.display="none";
                expanded=false;
            }
        });
            
        </script>
		<link href="css/user.css" type="text/css" rel="stylesheet">
		<link href="images/fav.png" rel="icon" type="image/x-icon" />
		<title>View tender applications</title>
	</head>
	<body>
	<ul class="navbar">
		<li class="profpic"><img src="../assets/images/pic/<?php echo $uid?>.jpg"></li>
		<li><a href="manager.php" ><span>Home</span></a></li>
		<li><a href="managerdetails.php"><span>My Details</span></a></li>
        <li><a href="#" class="active">View applicants</a></li>
		<div class="top_right">

		<li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>

		</div>
	</ul>
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
                            echo "<th>View doc</th>";
                            
                                  
                                  
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            
                   while($row= $result->fetch_array()){
                      
                     
                                echo "<tr>";
                                    echo "<td>" . $row['TenderID'] . "</td>";
                                    echo "<td>" . $row['IDNo'] . "</td>";
                                    echo "<td>" . $row['Submission_date'] . "</td>";
                                  echo "<td>" . $row['Status'] . "</td>";
                    
             
                                echo "<td>";
                                  
                                         echo "<a href='download.php?Filename=".$row['path']."'>download</a> ";

                                    echo "</td>";
                       echo "<td>";
                    
                       
                
               $_SESSION['IDNo'] = $row[1];
        $_SESSION['TenderID'] = $row[0];
                       
                       echo "<a href='accepted.php?IDno=".$row['IDNo']."' ><img src='../assets/images/accept.jpg'></a>";
                     
                       echo"</td>";
                       echo "<td>";
                   
                       echo "<a href='rejected.php?IDno=".$row['IDNo']."' ><img src='i../assets/images/reject.png'></a>";
                     
                       echo"</td>";
                       
                                echo "</tr>";
                                }
                            echo "</tbody>";
                        echo "</table>";
                             
                        // Free result set
                        $result->free();
                         }else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
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
