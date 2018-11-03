<?php
session_start();
if (!isset($_SESSION['ManID'])) {
    header("location:../index.php");
    exit;
}

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
    readfile("C:\xampp\htdocs\Tender\Project\applications/".$name);
    exit;

           $msg = "
          <h1>Tender Application On Progress </h1><br>
          <h2>Tender Application for <i></i></h2>
          <h3>This email is to inform you that your application is still being analysed.</h3>";
          $mail = $row2[4];
          echo "<script>alert($mail);</script>";
          sendmail($msg,$mail);
?>
