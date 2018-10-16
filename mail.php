<?php
session_start();
function sendmail($message,$recepient){
$subject = "Do Not Reply";
$headers = "Content-Type: text/html; charset=UTF-8\r\n";
$message = wordwrap($message,150,"<br>",false);
if(mail($recepient,$subject,$message,$headers)){
}else{
  $_SESSION['alert'] = "Error Sending Your Message";
}
}
?>
