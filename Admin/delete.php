<?php
  session_start();
  require ("../config.php");
  require ("../mail.php");
  if (!isset($_SESSION['AdminID'])) {
  		header("location:../index.php");
  		exit;
  }
  if($_SERVER["REQUEST_METHOD"] == "GET") {
  	$uid = $_GET['id'];
    $status = $_GET['status'];
    $getmail = "SELECT Email FROM login WHERE Idnum = $uid";
    $result = mysqli_query($conn,$getmail);
    $row = mysqli_fetch_assoc($result);
    $mail = $row['Email'];
    $msg = "
    <h1>Account Deletion Alert</h1><br>
    <h2>We're Sad to See You Leave, But Happy You Came By.</h2>
    <h3>This email is to inform you that your account with us has been deleted.<br>
    Please contact the administrator for further clarification.</h3>";
    if(sendmail($msg,$mail)){
      $del_login = $conn->prepare("DELETE FROM login WHERE Idnum = $uid");//delete from login
      if($status == 'tenderer'){
        $del_user = $conn->prepare("DELETE FROM tenderers WHERE IDNo = $uid");//delete from tenderers
      }else{
        $del_user = $conn->prepare("DELETE FROM heads WHERE HeadID = $uid");//delete from department managers
      }
      $del_user->execute();
      $del_login->execute();
  }else{
    $_SESSION['alert']="Could not delete this user at this time. Please try again later!";
  }

?>
<html>
<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
</script>
<title>Tenderama | Delete</head>
</head>
<body>
<script>
    history.pushState("", "Delete", "http://localhost/project/Admin/");
    swal("Well there you go","This user has been deleted!","success").then((willDelete) => {
      if (willDelete) {
        location.href = "users.php";
      } else {
        swal("It is unfortunately too late to terminate the process. Apologies","info");
      }
      location.href = "users.php";
    });
</script>
</body>
</html>
<?php }?>
