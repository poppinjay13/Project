<html>
<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
</script>
</head>
<body>
  <button onclick="btnal()">Please Touch Me</button>
<script>
  function btnal(){
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        swal("Are you sure?","This user has been deleted!","success").then((willDelete) => {
					if (willDelete) {
						location.href = "search.php";
					} else {
						swal("Process Terminated!","Phwex! That was pretty close. He! He!","info");
					}
				});
      } else {
        swal("Your imaginary file is safe!");
      }
    });
  };
</script>
</body>
</html>
