<?php
error_reporting(0);
session_start();


$un = $_POST['uname'];
//$pw = $_POST['pass'];
$pw = md5($_POST['pass']);

if($un==''||$pw=='')
{
echo "<script language=javascript>alert('Please Login first')</script>";
require_once('login.php');
exit(0);
}
//echo $un ."and ".$pw;
$con = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("user_details") or die(mysql_error());

$sql = "Select * from user WHERE username = '$un' AND password = '$pw' ";
//echo "done1";
$result = mysql_query($sql,$con) or die(mysql_error());
//echo "done2";
$_SESSION['login']=0;
$num = mysql_num_rows($result);
if($num==0)
{
require_once('login.php');
exit(0);
}
else
{
$_SESSION['username'] = $un;
$_SESSION['password'] = $pw;
$_SESSION['login']=1;

require_once('home.php');
exit(0);
}



echo "<script language=javascript>alert('Please enter a valid username and password')</script>";
require_once('login.php');
mysql_close();


?>