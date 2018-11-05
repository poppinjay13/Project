<?php
//session_start();//not necessary if session already started in host page
//this document contains the mail function to allow for notification and communication.
function sendmail($message,$recepient){
$subject = "Do Not Reply";
$headers = "Content-Type: text/html; charset=UTF-8\r\n";//type set to html to allow for formatting
$message = wordwrap($message,150,"<br>",false);
if(mail($recepient,$subject,$message,$headers)){
  return true;
}else{
  $_SESSION['alert'] = "Error Fulfilling Your Request At This Time";
  return false;
}
}
?>
