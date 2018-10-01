<?php
session_start();
include("config.php");
$tenderId=$_GET['TenderID'];

$tab = 1;
$count = 0;   
$sql = "SELECT * FROM applications where TenderID=$tenderId";
$result = mysqli_query($conn,$sql);
$count= mysqli_num_rows($result);

?>
<head>
		<link href="css/user.css" type="text/css" rel="stylesheet">
		<link href="images/fav.png" rel="icon" type="image/x-icon" />
		<title>View tender applications</title>
	</head>
	<body>
	<ul class="navbar">
		<li><span><img src="images/menu.png"></span></li>
		<li><a href="amanager.php" ><span>Home</span></a></li>
		<li><a href="managerdetails.php"><span>My Details</span></a></li>
        <li><a href="#" class="active">View applicants</a></li>
		<div class="dropdown">
		<li class="navbtn"><img src="images/user.svg"></li>
		<div class="dropdown-content">
		  <a href="logout.php">Log Out</a>
		</div>
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
                                  
                                  
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            
                   while($row= $result->fetch_array()){
                      
                     
                                echo "<tr>";
                                    echo "<td>" . $row['TenderID'] . "</td>";
                                    echo "<td>" . $row['IDNo'] . "</td>";
                                    echo "<td>" . $row['Submission date'] . "</td>";
                                echo "<td>";
                                  
                                          echo "<button>View Documents</button>";
                                    echo "</td>";
                                    echo "<td>";
                                  
                                          echo "<button>Grant Tender</button>";
                                    echo "</td>";
                                     echo "<td>";
                                        
                                          echo "<button>Reject Tender</button>";
                                    echo "</td>";
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