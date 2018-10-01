<?php
//$uid = $_SESSION['User_ID'];
?>
<html>
<head>
  <link href="../assets/css/users.css" rel="stylesheet">
  <title>Admin Module</title>
</head>
<body>
   <ul class="navbar">
   <li class="img"><img src="../assets/images/user.png"></li>
    <li><a href="admin.php">Dashboard</a></li>
    <li><a class="active">Users</a></li>
    <li><a href="">Profile</a></li>
    <li><a href="../logout.php">Log Out</a></li>
   </ul>
  <div class="load-data">
   <div class="searchbar">
   	 <input type="text" placeholder="Search by name..">
   </div>
    <table>
      <thead>
        <tr>
          <th>NAME</th>
          <th>EMAIL</th>
          <th>PHONE NUMBER</th>
          <th>TYPE</th>
          <th></th>
		</tr>
     	<tr class="spacer"></tr>
      </thead>
      <tbody>
      <?php $i=0;while($i<7){?>
      <div class="tenderdata">
      	<tr>
      		<td>Sample</td>
      		<td>Sample</td>
      		<td>Sample</td>
      		<td>Sample</td>
			<td><span class="editor" onClick="send(data)">EDIT USER DETAILS</span></td><!--php send id-->
      	</tr>
      	<tr class="spacer"></tr>
      </div>
      <?php $i++;}?>
		</tbody>
    </table>
    <button class="btnadd">Add New User</button>
  </div>
  <script>
		function send(data){
			alert("clicked!");
			/*var form = document.createElement("form");
			form.target = "_blank";
			form.method = "GET";
			form.action = ".php";
			form.style.display = "none";
			var input = document.createElement("input");
			form.appendChild(input);
			input.type = "hidden";
			input.name = "key";
			input.value = data;
			document.body.appendChild(form);
			form.submit();
			document.body.removeChild(form);*/
			}
	</script>
</body>
</html>
