<?php
    $name= $_GET['Filename'];
 

   header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($name));
    ob_clean();
    flush();
    readfile("C:\xampp\htdocs\Tender\applications/".$name); 
    exit;

?>
