<?php
$out = '
<style type="text/css">
div {
    text-align: center;
    }
	</style>
	<body>
	<div>
	<center>
	Enter your details<br>

	
	
<form method="post">
<table cellpadding="5">
<tr>
<td>Username: </td><td><input type="text" name="username_cloud" id="username_cloud"></td>
</tr>
<tr>
<td>Password: </td><td><input type="password" name="password_cloud" id="password_cloud"></td>
</tr>
<tr>
<td>
Password again: </td><td><input type="password" name="password" id="password"></td>
</tr>
<tr>
<td>
Email id :</td><td><input type="email" name="email" id="email"></td>
</tr>
</table>

<input type="submit" name="signup" value="Signup">
</center>

</form>

</div></body>';
echo $out;
$con=mysql_connect("localhost","root","");
mysql_select_db("user_details",$con) or die(mysql_error());


  if(isset($_POST['username_cloud'])&&($_POST['password_cloud'])&&($_POST['email']))
  {
  $username = $_POST['username_cloud'];
  $password = md5($_POST['password_cloud']); 
  $email = $_POST['email'];
  $sql = "SELECT * FROM user WHERE username = \"$username\" ";
  
  if(mysql_num_rows(mysql_query($sql,$con))==0) //no such row present already
  {
	$query = "INSERT INTO user (username, password, email)VALUES ('$username', '$password','$email')";
	if(mysql_query($query,$con))
	header('Location:login.php');
  }
  else
  {
	echo "<script language=javascript>alert('This username is not available.Please select a different username.')</script>";
	require_once('signup.php');
	exit(0);
  }
  
  }
  
  
  


?>