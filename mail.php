<?php
function sendmail($message,$recepient);
$subject = "Do Not Reply";
$headers = "";
$message = wordwrap($message,60,"",false);
mail($recepient,$subject,$message,$headers);
?>
