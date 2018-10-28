<?php
//email validation
function validemail($email){
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false;
  }else{
    return true;
  }
}
//phone number validation
function validphone($phone){
  if(strlen($phone)<10 || strlen($phone)>13 || !validnum($phone)){
    return false;
  }else{
    return true;
  }
}
//name validation
function validname($name){
  if (!preg_match("/^[a-zA-Z ]*$/",$name)){
    return false;
  }else{
    return true;
  }
}
//password validation
function validpassword($password){
  if(strlen($password)<8){
    return false;
  }else{
    return true;
  }
}
//check if value is numerical
function validnum($num){
  if(!is_numeric($num)){
    return false;
  }else{
    return true;
  }
}
?>
