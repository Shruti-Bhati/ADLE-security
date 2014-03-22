<?php
require_once('createtable.php');
createtables();
?>
<html>
<body>
<center>
<br /><br /><br /><br />
<form action = "verify.php" method = "post">
	<table>
		<tr>
			<td> USERNAME * : </td><td><input type="text" name="uname"></td>
		</tr>
		<tr></tr>
		<tr>
			<td>PASSWORD * :</td><td><input type="password" name="pass"></td>
		</tr>
	</table>
	<br /><br />
	<input type="submit" value="submit">
</form>
<a href="signup.php">New User ! ! Click Here </a>
</center>
</body>
</html>