
<?php
#Initialize the session
    session_start();
    #If the session is not set it will redirect you to the login page
    if (!isset($_SESSION['Idnum']) && !isset($_SESSION['Password']) || empty($_SESSION['Idnum'])) {
        # code...
        header("location:../Project/amanager.php");
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
        $Deadtime = $conn->real_escape_string($_REQUEST['Deadtime']);
        $Deaddate = $conn->real_escape_string($_REQUEST['Deaddate']);



            //Prepare an insert statement
            $sql = "INSERT into tenders(Name,Department,Requirements,Enquiries,Deadtime,Deaddate) VALUES(?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                # Bind variables to the prepared statement as parameters
                $stmt->bind_param("ssssss",$param_Name,$param_Department,$param_Requirements,$param_Enquiries,$param_Deadtime,$param_Deaddate);
                #Set the parameters
                $param_Name = $Name;
                $param_Department = $Department;
                $param_Requirements = $Requirements;
                $param_Enquiries = $Enquiries;
                $param_Deadtime = $Deadtime;
                $param_Deaddate = $Deaddate;


                #Attempt to execute the prepared statement
                if ($stmt->execute()){
                    #Redirect to manager page
                    header("location: amanager.php");
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
		<link href="css/home.css" type="text/css" rel="stylesheet">
		<link href="images/fav.png" rel="icon" type="image/x-icon" />
		<title>Edit tender</title>
	</head>
	<body>
	<ul class="navbar">
		<li><span><img src="images/menu.png"></span></li>
		<li><a href="amanager.php"><span>Home</span></a></li>
		<li><a href="managerdetails.php"><span>My Details</span></a></li>
    <li><a href="#" class="active"><span>Floating tender</span></a></li>
    <div class="top_right">
		<li class="profpic"><img src="images/pic/<?php echo $uid?>.jpg"></li>
	</div>
	</ul>
<div class="tendernew"><br>
<center><h3>ADD NEW TENDER</h3>
     <div id="form">
                <form action="" method="post" accept-charset="utf-8">
                    Name:<br>
                        <input  type="text" name="tendername" value="" placeholder=""><br><br>

                     Department:<br>
                    <select name="Department">
                    <option value="department">Languages</option>
                    <option value="department">Mathematics</option>
                    <option value="department">Humanities</option>
                    <option value="department">Sciences</option>
                    <option value="department">Technical</option>
                        <option value="department">Economics</option>
                        <option value="department">Business</option>
                        <option value="department">Laboratory</option>
                        <option value="department">Finance</option>
                        <option value="department">Administration</option>
                        <option value="department">Guidance and counselling</option>
                    </select>
                        <br><br>
                    Requirements:<br>
                    <textarea name="requirements" value="" placeholder="Tender description..." rows="4" cols="50"></textarea>
                        <br><br>
                    Enquiries:<br>
                        <input  type="text" name="enquiries" value="" placeholder=""><br><br>
                    Deadtime:<br>
                        <input  type="datetime" name="deadtime" value="" placeholder=""><br><br>
                    Deaddate:<br>
                     <input  type="datetime" name="deadtime" value="" placeholder=""><br><br>


                        <button  type="submit" name="submit" class="cust">submit</button>

                </form>
            </div>
</center>
</div>
	</body>
</html>
