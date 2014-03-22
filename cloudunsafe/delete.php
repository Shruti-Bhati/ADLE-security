<?php
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
$username = $un;

$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("cloudunsafe",$con) or die('could not connect with database');
$sql = "select * from cloudpartunsafe0 where username = \"$username\" ";
$result = mysql_query($sql,$con);
echo "<form name=\"down\" action = \"deleter.php\" method = \"POST\">";
while($results =  mysql_fetch_assoc($result))
{
$transid = $results['trans_id'];
$name = $results['filename'];
echo "<input type=\"radio\" name=\"file\" id=\"file\" value=\"$transid\"> ";
echo $name;
echo "<br>";
}
echo "<input type=\"submit\" value=\"Submit\">";
echo "</form>";
mysql_close($con);
?>