<?php
//session_start();//not necessary if session already started in host page
function sendmail($message,$recepient){
$subject = "Do Not Reply";
$headers = "Content-Type: text/html; charset=UTF-8\r\n";
$message = wordwrap($message,150,"<br>",false);
if(mail($recepient,$subject,$message,$headers)){
  return true;
}else{
  $_SESSION['alert'] = "Error Fulfilling Your Request At This Time";
  return false;
}
}
?>
