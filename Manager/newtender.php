
<?php
#Initialize the session
    session_start();
    #If the session is not set it will redirect you to the login page
    if (!isset($_SESSION['ManID'])) {
        # code...
        header("location:../index.php");
            exit;
    }
    //Include the connection file
    require_once '../config.php';

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
		<link href="../assets/css/home.css" type="text/css" rel="stylesheet">
		<link href="../assets/images/fav.png" rel="icon" type="image/x-icon" />
		<title>Floating new tender</title>
	</head>
	<body>
	<ul class="navbar">
		<li><span><img src="../assets/images/menu.png"></span></li>
		<li><a href="manager.php"><span>Home</span></a></li>
		<li><a href="details.php"><span>My Details</span></a></li>
    <li><a href="#" class="active"><span>Floating tender</span></a></li>
    <div class="top_right">
		<li class="profpic"><img src="../assets/images/pic/<?php echo $uid?>.jpg"></li>
	</div>
	</ul>
<div class="tendernew"><br>
<center><h3>ADD NEW TENDER</h3>
     <div id="form">
                <form action="" method="post" accept-charset="utf-8">
                    Name:<br>
                        <input  type="text" name="Name" value="" placeholder="" size="35"><br><br>

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
                    <textarea name="Requirements" value="" placeholder="Tender description..." rows="10" cols="30"></textarea>
                        <br><br>
                    Enquiries:<br>
                        <input  type="text" name="Enquiries" value="" placeholder="" size="35"><br><br>
                    Deadtime:<br>
                        <input  type="datetime" name="Deadtime" value="" placeholder="" size="35"><br><br>
                    Deaddate:<br>
                     <input  type="datetime" name="Deaddate" value="" placeholder="" size="35"><br><br>


                        <button  type="submit" name="submit" class="cust">submit</button>

                </form>
            </div>
</center>
</div>
	</body>
</html>
