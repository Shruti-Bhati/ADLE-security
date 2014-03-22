<?php
require_once('encrypt_decrypt.php');
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

$earlier = microtime(true);

//generating new transaction id
$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("cloud",$con) or die('could not connect with database');
$sql = "select * from transid";
$result = mysql_query($sql,$con) or die('couldnot execute the order1');
if( mysql_num_rows($result) == 0)
{
	$sql = "insert into transid values(1)";
	$result = mysql_query($sql,$con) or die('couldnot execute the order2');
	$new_id = 1;
}
else
{
	$result_row= mysql_fetch_array($result);
	$prev_id = $result_row['trans'];
	$new_id = $prev_id+1;
	$sql = "UPDATE transid SET trans = trans+1";
	$result = mysql_query($sql,$con) or mysql_error($con);
}
mysql_close($con);
//uploading file content

if ($_FILES["userfile"]["error"] > 0)
  {
  echo "Error: " . $_FILES["userfile"]["error"] . "<br>";
  }
else
  {

	  //Store these things in table
	  $fn1 = $_FILES["userfile"]["tmp_name"]; //Use the tmp_name always to get file content
	  $type = $_FILES["userfile"]["type"];
	  $size = $_FILES["userfile"]["size"];
	  $file = file_get_contents ($fn1);
	  $len = strlen($file);
	  $datakey = md5($file);
	  $username = $un;
	  $password2 = $pw;
	  
	  $file = fnEncrypt($file, $datakey);
	  $file = fnEncrypt($file, $password2);
	  $filename = $_FILES["userfile"]["name"];
	  
	  //add key to escrow system
	  $con = mysql_connect("localhost","root","") or die('could not open database');
	  mysql_select_db("key_escrow",$con) or die('could not connect with database');
	  $sql = "insert into keys_db values(\"$username\",\"$datakey\",\"$new_id\",\"$len\")";
	  mysql_query($sql,$con) or die(mysql_error());
	  mysql_close($con);
	  
	  //store file
	  $con = mysql_connect("localhost","root","") or die('could not open database');
	  mysql_select_db("cloud",$con) or die('could not connect with database');
	  for($i=0;$i<20;$i++)
	  {
	  $sql = "insert into cloudpart".$i." values(\"$file\",\"$type\",\"$size\",\"$username\",\"$password2\",\"$filename\",\"$new_id\")";
	  mysql_query($sql,$con) or die('couldnot execute the order');
	  }
	  mysql_close($con);
	  
	  $later =microtime(true);
	  $res = $later-$earlier;
	  $my_file = 'uploadtimes.txt';
	  $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
	  $data = "\nTime taken ".$res." seconds filesize ".$size." KB";
	  fwrite($handle, $data);
	  fclose($handle);
	
	echo "<script language=javascript>alert('Your file has been successfully uploaded')</script>";  
	require_once('home.php');
	exit(0);
}
  
  


?>