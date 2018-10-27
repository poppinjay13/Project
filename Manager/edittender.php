<?php

session_start();
include("../config.php");
if (!isset($_SESSION['UserID'])) {
        header("location:../index.php");
        exit;
}


$tid = $_GET['TenderID'];
 echo $tid;
$Name = $Department = $Requirements = $Enquiries = $Deaddate = "";

 

if(isset($_POST["TenderID"]) && !empty($_POST["TenderID"])){
    // Get hidden input value
    $tenderid = $_POST["TenderID"];
    
    // Validate entries
     $Name = $mysqli->real_escape_string($_REQUEST['Name']);
        $Department = $mysqli->real_escape_string($_REQUEST['Department']);
        $Requirements = $mysqli->real_escape_string($_REQUEST['Requirements']);
        
        $Enquiries = $mysqli->real_escape_string($_REQUEST['Enquiries']);
        $Deaddate = $mysqli->real_escape_string($_REQUEST['Deaddate']);
    
        // Preparing an updating statement
        $sql = "UPDATE users SET Name=?, Department=?, Requirements=?, Enquiries=?, Deaddate=? WHERE TenderID=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Binding variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $param_Name,$param_Department,$param_Requirements,$param_Enquiries,$param_Deaddate, $param_tenderid);
            
            // Set parameters
             $param_Name =  $Name;
            $param_Department=$Department;
                $param_Requirements=  $Requirements;
                $param_Enquiries=$Enquiries;
                $param_Deaddate=$Deaddate ;
                $param_tenderid=$tenderid;
          

            echo '<script language="javascript">';
            echo 'alert("")';
            echo '</script>';
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: edittender.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
            // Close statement
        $stmt->close();
        }
         
        
    
    
    // Close connection
    $mysqli->close();
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["TenderID"]) && !empty(trim($_GET["TenderID"]))){
        // Get URL parameter
        $tenderid =  trim($_GET["TenderID"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM tenders WHERE TenderID = ?";
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_tenderid);
            
            // Set parameters
            $param_tenderid= $tenderid;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $Name = $row["Name"];
                    $Department = $row["Department"];
                    $Requirements = $row["Requirements"];
                   
                    $Enquiries = $row["Enquiries"];
                    $Deaddate = $row["Deaddate"];
                } else{
                    // URL doesn't contain valid tenderid.
                    header("location: edittender.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
             // Close statement
        $stmt->close();
        }
        
       
        
        // Close connection
        $conn->close();
    }  else{
        // URL doesn't contain tenderid parameter.
        header("location: edittender.php");
        exit();
    }
}
?>
 
<html>
	<head>
        
		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
              <link rel="stylesheet" href="../assets/js/jquery.datetimepicker.min.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery.datetimepicker.full.js"></script>
        <script>
        $(function(){
                $("#datetime").datetimepicker();
        });
            
        </script>
        
		<title>Department manager's Module</title>
	</head>
	<body>
	<ul class="navbar">
		<li class="profpic"><img src="../assets/images/user.png"></li>
		<li><a href="manager.php" ><span>Home</span></a></li>
		<li><a href="details.php"><span>My Details</span></a></li>
    <li><a href="#" class="active"><span>Edit Tender</span></a></li>
		<div class="top_right">
		<li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>
	</div>
	</ul>

	<div class="bod">
	<?php
		
	?>
	<center>
	<h2 style="color:white;" style="color:white;">Edit tender details</h2><br>

	</center>
	
	<div class="tendernew">
	<div class="text">
         <div id="form">
                <form  action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="POST">
                    Name:<br>
                        <input  type="text" name="Name" value="<?php echo $Name;?>" placeholder=""><br><br>

                     Department:<br>
                    <input  type="text" name="Department" value="<?php echo $Department;?>" placeholder=""><br><br>
                        <br><br>
                    Requirements:<br>
                    <input  type="textarea"  name="Requirements" rows="4" cols="50" value="<?php echo $Requirements;?> "placeholder=""><br><br>
                    <!--<textarea name="Requirements" value="<?php echo $Requirements;?>" placeholder="" rows="4" cols="50"></textarea>-->
                        <br><br>
                    Enquiries:<br>
                        <input  type="text" name="Enquiries" value="<?php echo $Enquiries;?>" placeholder=""><br><br>
                  
                    Deaddate:<br>
                     <input  type="datetime" name="Deaddate" value="<?php echo $Deaddate;?>" placeholder="" id="datetime"><br><br>
                    <input type="submit" class="cust" value="Submit">
                     
                </form>

	</div>
	</div>
	

	</body>
</html>


