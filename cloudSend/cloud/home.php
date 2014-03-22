<?php
require_once('banner.php');
error_reporting(0);
session_start();

$un = $_SESSION['username'];
$pw = $_SESSION['password'];

if(($un=='') || ($pw=='')||$_SESSION['login']==0)
{
echo "<script language=javascript>alert('Please Login first..Warning from home page')</script>";
require_once('login.php');
exit(0);
}
$var = '<div ="logout" align="right">
<a href = "logout.php">Logout User</a>
</div>';
echo $var;

echo "<h1> Hello ".$un."</h1>";

?>
<html>
<style type = "text/css">

</style>
<body>
<div = "choices" align = "center">
<ul>
<li><a href = "http://localhost/cloud/upload.php">Upload file</a><br />
<li><a href = "http://localhost/cloud/retrieve.php">Retrieve file</a><br />
<li><a href = "http://localhost/cloud/delete.php">Delete file</a>
<ul>

</div>

</body>

</html>
