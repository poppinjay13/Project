<?php
/*if(mail(
"+254719653520@safaricomsms.com",
"",
"This is my heartbeat song!",
"From: Ian Odundo <thisian13@gmail.com>"
)){
echo "Success";
}else{
echo "Failure";
}*/
include("../config.php");
$sql = "SELECT Name FROM tenderers WHERE IDNo = '100446'";
$result = mysqli_query($conn,$sql);
while($row=mysqli_fetch_row($result)){
  echo $row[0];
}
?>
