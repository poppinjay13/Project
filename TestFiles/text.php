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
/*
include("../config.php");
$sql = "SELECT Name FROM tenderers WHERE IDNo = '100446'";
$result = mysqli_query($conn,$sql);
while($row=mysqli_fetch_row($result)){
  echo $row[0];
}
?>
<?php
$to = "+254719653520@safaricomsms.com";
$subject = "";
$txt = "Hello World Script Text!";
$headers = "";

mail($to,$subject,$txt,$headers);
*/?>
<?php
echo "<div onclick='alerting()' style='cursor:pointer;'>Testing Script</div>";
?>
<script type="text/javascript">
function alerting(){
alert("Onclick is working");
}
</script>
