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
$earlier = microtime();
$id = $_POST['file'];
$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("key_escrow",$con) or die('could not connect with database');
$sql = "UPDATE keys_db SET datakey = NULL where trans_id = \"$id\" ";
$result = mysql_query($sql,$con);
	  $later = microtime();
	  $res = $later-$earlier;
	  $my_file = 'deletetimes.txt';
	  $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
	  $data = "\nTime taken ".$res." seconds filesize ".$size." KB";
	  fwrite($handle, $data);
	  fclose($handle);
if($result)
{echo "<script language=javascript>alert('Your file has been successfully deleted')</script>";  
	require_once('home.php');
	exit(0);
}


?>
