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
$username = $un;

$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("cloud",$con) or die('could not connect with database');
$sql = "select * from cloudpart0 where username = \"$username\" ";
$result = mysql_query($sql,$con);

$con2 = mysql_connect("localhost","root","") or die('could not open database2');
mysql_select_db("key_escrow",$con) or die('could not connect with database2');

echo "<form name=\"down\" action = \"deleter.php\" method = \"POST\">";
while($row =  mysql_fetch_assoc($result))
{
$sql2 = "select * from keys_db "; //now get all keys 
$result2 = mysql_query($sql2,$con2) or die(mysql_error());
	while($row2 = mysql_fetch_array($result2))
	{
		if(($row['trans_id']==$row2['trans_id']) && $row2['datakey']!=NULL)
		{
		//display
		$transid = $row['trans_id'];
		$name = $row['filename'];
		echo "<input type=\"radio\" name=\"file\" id=\"file\" value=\"$transid\"> ".$trans_id;
		echo $name;
		echo "<br>";
		//leave
		break;
		}
	}//end of inner while

}//end of outer while
echo "<input type=\"submit\" value=\"Submit\">";
echo "</form>";
mysql_close($con);
?>