<?php

session_start();
include("../config.php");
if (!isset($_SESSION['UserID'])) {
        header("location:../index.php");
        exit;
}


if($_SERVER["REQUEST_METHOD"] == "GET") {
  $tid = $_GET['TenderID'];
  $tender = "SELECT * FROM tenders WHERE TenderID = $tid";
  $result = mysqli_query($conn,$tender);
  $row = mysqli_fetch_row($result);
}else{
  $_SESSION['alert']="Could not display tender details at this time. Please try again later!";
 
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $tid = $_GET['TenderID'];
  $Name = $conn->real_escape_string($_REQUEST['Name']);
  $Department =$conn->real_escape_string($_REQUEST['Department']);
  $Requirements = $conn->real_escape_string($_REQUEST['Requirements']);
  $Enquiries = $conn->real_escape_string($_REQUEST['Enquiries']);
  $Deaddate = $conn->real_escape_string($_REQUEST['Deaddate']);
      //Prepare an update statement
      $sql = "UPDATE tenders SET Name = ?, Department = ?, Requirements = ?, Enquiries = ?, Deaddate = ? WHERE TenderID = $tid";
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
              #Redirect to admin page
              header("location: manager.php");
          }else{
              $_SESSION['alert']="Something went wrong :( Please try again later";
          }
      }
      #Close statement
      $stmt->close();
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
         <?php
        if(isset($_SESSION['alert'])){
          echo "<div class='alert'>$_SESSION[alert]</div>";
                unset($_SESSION['alert']);
        }
        ?>
    <form method="POST">
      <h2>Tender Details</h2>
 
     
      <label for = "Name">Name:</label><br/>
      <input name="Name" type="text" value="<?php echo $row['1'] ?>"/><br/><br/>
      <label for = "Department">Department:</label><br/>
     <input readonly name="Department" type="text" value="<?php echo $row['2'] ?>"/><br/><br/>
      <label for = "Requirements">Requirements:</label><br/>
      <textarea name="Requirements" cols="30" rows="10"><?php echo $row['3'] ?></textarea><br/><br/>
      <label for = "Enquiries">Enquiries</label><br/>
      <input name="Enquiries" type="text" value="<?php echo $row['4'] ?>"/><br/><br/>
      <label for = "Deaddate">Deaddate</label><br/>
      <input name="Deaddate" type="date" value="<?php echo (substr($row[5],0,10)) ?>"/><br/><br/>
      <input type="submit" class="cust" value="Update Tender"/><br/><br/>

    </form>
  </hr>
    <div>
    </div>
    </div>
    

    </body>
</html>


