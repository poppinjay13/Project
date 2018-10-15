<?php
session_start();
$msg="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
sendmail($msg,"thisian13@gmail.com");
function sendmail($message,$recepient){
$subject = "Do Not Reply";
$headers = "Content-Type: text/html; charset=UTF-8\r\n";
$message = wordwrap($message,70,"<br>",false);
if(mail($recepient,$subject,$message,$headers)){
  $_SESSION['alert'] = "Email Sent Succesfully";
}else{
  $_SESSION['alert'] = "Error Sending Your Message";
}
echo $_SESSION['alert'];
}
?>
