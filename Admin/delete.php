<?php
  require ("../config.php");
  if($_SERVER["REQUEST_METHOD"] == "GET") {
  	$uid = $_GET['id'];
    $status = $_GET['status'];
    $del_login = $conn->prepare("DELETE FROM login WHERE Idnum = $uid");//delete from login
    if($status == 'tenderer'){
      $del_user = $conn->prepare("DELETE FROM tenderers WHERE IDNo = $uid");//delete from tenderers
    }else{
      $del_user = $conn->prepare("DELETE FROM heads WHERE HeadID = $uid");//delete from department managers
    }
    $del_user->execute();
    $del_login->execute();

?>
<html>
<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
</script>
</head>
<body>
<script>
    history.pushState("", "Delete", "http://localhost/project/Admin/");
    swal("Well there you go","This user has been deleted!","success").then((willDelete) => {
      if (willDelete) {
        location.href = "users.php";
      } else {
        swal("Process Terminated!","Phwex! That was pretty close. He! He!","info");
      }
    });
</script>
</body>
</html>
<?php }?>
