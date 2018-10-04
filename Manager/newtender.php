
<?php  
#Initialize the session
    session_start();
    #If the session is not set it will redirect you to the login page
    if (!isset($_SESSION['Idnum']) && !isset($_SESSION['Password']) || empty($_SESSION['Idnum'])) {
        # code...
        header("location:../Project/manager.php");
            exit;
    }
    //Include the connection file
    require_once '../Project/config.php';

    //Define variables and initialize them with empty variables
    $Name =  $Department = $Requirements = $Enquiries = $Deadtime = $Deaddate= "";
   
    //Process form data when the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Name = $conn->real_escape_string($_REQUEST['Name']);
        $Department = $conn->real_escape_string($_REQUEST['Department']);
        $Requirements = $conn->real_escape_string($_REQUEST['Requirements']);
        $Enquiries = $conn->real_escape_string($_REQUEST['Enquiries']);
        $Deaddate = $conn->real_escape_string($_REQUEST['Deaddate']);
    
       
    
            //Prepare an insert statement
            $sql = "INSERT into tenders(Name,Department,Requirements,Enquiries,Deaddate) VALUES(?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                # Bind variables to the prepared statement as parameters
                $stmt->bind_param("sssss",$param_Name,$param_Department,$param_Requirements,$param_Enquiries,$param_Deaddate);
                #Set the parameters
                $param_Name = $Name;
                $param_Department = $Department;
                $param_Requirements = $Requirements;
                $param_Enquiries = $Enquiries;
                $param_Deaddate = $Deaddate;
           

                #Attempt to execute the prepared statement
                if ($stmt->execute()){
                    #Redirect to manager page
                    header("location: manager.php");
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
         <link rel="stylesheet" href="jquery.datetimepicker.min.css">
    <script src="jquery.js"></script>
    <script src="jquery.datetimepicker.full.js"></script>
        <script>
        $(function(){
                $("#datetime").datetimepicker();
        });
            
        </script>
        
		<link href="css/user.css" type="text/css" rel="stylesheet">
		<link href="images/fav.png" rel="icon" type="image/x-icon" />
		<title>Floating new tender</title>
	</head>
	<body>
	<ul class="navbar">

		<li class="profpic"><img src="../assets/images/pic/<?php echo $uid?>.jpg"></li>

		<li><a href="manager.php"><span>Home</span></a></li>

		<li><a href="details.php"><span>My Details</span></a></li>

    <li><a href="#" class="active"><span>Floating tender</span></a></li>

    <div class="top_right">

		<li><a href="../logout.php" title="logout"><img src="../assets/images/logout.png"></a></li>

	</div>
	</ul>
<div class="tendernew"><br>
<center><h3>ADD NEW TENDER</h3>
     <div id="form">
                <form action="" method="post" accept-charset="utf-8">
                    Name:<br>
                        <input  type="text" name="Name" value="" placeholder="enter tender name" size="35" required><br><br>
    
                     Department:<br>
                    <select name="Department"  >
                    <option value="Languages">Languages</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Humanities">Humanities</option>
                    <option value="Sciences">Sciences</option>
                    <option value="Technical">Technical</option>
                        <option value="Economics">Economics</option>
                        <option value="Business">Business</option>
                        <option value="Laboratory">Laboratory</option>
                        <option value="Finance">Finance</option>
                        <option value="Administration">Administration</option>
                        <option value="Guidance and counselling">Guidance and counselling</option>
                    </select>
                        <br><br>
                    Requirements:<br>
                    <textarea name="Requirements" value="" placeholder="Tender description..." rows="10" cols="30" required></textarea>
                        <br><br>
                    Enquiries:<br>
                        <input  type="text" name="Enquiries" value="" placeholder="0712345678" size="35" required><br><br>
                  
                    
                    Deaddate:<br>
                     <input  type="datetime" name="Deaddate" value="" placeholder="" size="35" id="datetime" required><br><br>
                        
                  
                        <button  type="submit" name="submit" class="cust">submit</button>
                  
                </form>
            </div>
</center>
</div>
	</body>
</html>
