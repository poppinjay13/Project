<html>
<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
</script>
</head>
<body>
<form method="post" action="#" enctype="multipart/form-data">
  <input type="file" id="upload" name="doc" accept="application/pdf" required/>
	<div id="fileupload"><label for="upload">Click to pick a file</label></div><br><br>
  <input type="submit" id="btnSub" value="Apply for Tender?"></button>
</form>
  <?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
  	try{
        //code for file upload below
  			$filename = $_FILES['doc']['name'];
        $newname = "test.pdf";
        $target_dir = "../applications/";
        $target_file = $target_dir.$newname;
        $uploadOk = 1;
        $DocType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        if (file_exists($target_file)) {
  				echo "<script>alert('Seems like you already applied for this tender. Tsk!');</script>";
          $uploadOk = 0;
  			}else{
        // Check file size
        if ($_FILES["doc"]["size"] > 10000000) {
          echo "<script>alert('Sorry, your file is too large.');</script>";
          $uploadOk = 0;
        }
        // Allow certain file formats
        if($DocType != "pdf"){
          echo "<script>alert('Sorry, only pdf files are allowed.');</script>";
          $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk != 0){
          if (move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file)) {
            echo "<script>alert('The file ". basename( $_FILES["doc"]["name"])." has been uploaded.');</script>";
          } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
          }
        }
  		}
  	 }catch(Exception $e){
  		 echo "<script>alert('Unable to submit application presently. Please try again later');</script>";
  	 }
   }
  ?>
</body>
</html>
