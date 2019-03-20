
<?php
#Initialize the session
    session_start();
    #If the session is not set it will redirect you to the login page
    if (!isset($_SESSION['ManID'])){
        # code...
        header("location:../index.php");
            exit;
    }
    //Include the connection file
    require_once '../config.php';
$depart = $_SESSION['Department'];


    //Define variables and initialize them with empty variables
    $Name =  $Department = $Requirements = $Enquiries = $Deadtime = $Deaddate= $Status= "";

    //Process form data when the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Name = $conn->real_escape_string($_REQUEST['Name']);
        $Department =$conn->real_escape_string($_REQUEST['Department']);
        $Requirements = $conn->real_escape_string($_REQUEST['Requirements']);
        $Enquiries = $conn->real_escape_string($_REQUEST['Enquiries']);
        $Deaddate = $conn->real_escape_string($_REQUEST['Deaddate']);
        $Status = $conn->real_escape_string($_REQUEST['Status']);



            //Prepare an insert statement
            $sql = "INSERT into tenders(Name,Department,Requirements,Enquiries,Deaddate,Status) VALUES(?, ?, ?, ?, ?,?)";

            if ($stmt = $conn->prepare($sql)) {
                # Bind variables to the prepared statement as parameters
                $stmt->bind_param("ssssss",$param_Name,$param_Department,$param_Requirements,$param_Enquiries,$param_Deaddate,$param_Status);
                #Set the parameters
                $param_Name = $Name;
                $param_Department = $Department;
                $param_Requirements = $Requirements;
                $param_Enquiries = $Enquiries;
                $param_Deaddate = $Deaddate;
                 $param_Status = $Status;


                #Attempt to execute the prepared statement
                if ($stmt->execute()){
                    #Redirect to manager page
                    header("location: ../Manager/manager.php");
                }else{
                    echo "Something went wrong :( Please try again later";
                }
            }
            #Close statement
            $stmt->close();

        #Close connection
        $mysqli->close();
    }
?>
<html>
	<head>
         <link rel="stylesheet" href="../assets/js/jquery.datetimepicker.min.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery.datetimepicker.full.js"></script>
        <script>
        $(function(){
                $("#datetime").datetimepicker();
        });

        </script>

		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Floating new tender</title>
	</head>
	<body>
	<ul class="navbar">

		<li class="profpic"><img src="../assets/images/user.png"></li>

		<li><a href="manager.php"><span>Home</span></a></li>

		<li><a href="details.php"><span>My Details</span></a></li>

    <li><a href="#" class="active"><span>Floating tender</span></a></li>

    <div class="top_right">

		<li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>

	</div>
	</ul>
        <div class="bod">
	<?php

	?>
	<center>
	<h2 style="color:white;" style="color:white;">You are now floating a new tender</h2><br>

	</center>

<div class="tendernew" ><br>
<center><h3>ADD NEW TENDER</h3>
     <div id="form">
                <form action="" method="post" accept-charset="utf-8">
                    Name:<br>
                        <input  type="text" name="Name" value="" placeholder="enter tender name" size="35" required><br><br>

                     Department:<br>
                        <input  type="text" name="Department" value="<?php echo $depart; ?>" placeholder="" size="35" required readonly><br><br>
                    Requirements:<br>
                    <textarea name="Requirements" value="" placeholder="Tender description..." rows="10" cols="30" required></textarea>
                        <br><br>
                    Enquiries:<br>
                        <input  type="text" name="Enquiries" value="" placeholder="0712345678" size="35" required><br><br>


                    Deaddate:<br>
                     <input  type="datetime" name="Deaddate" value="" placeholder="" size="35" id="datetime" required><br><br>
                        <input  type="hidden" name="Status" value="PENDING" placeholder="" size="35" id="datetime" required><br><br>

                        <button  type="submit" name="submit" class="cust">submit</button>

                </form>
            </div>
</center>
</div>

	</body>
</html>
