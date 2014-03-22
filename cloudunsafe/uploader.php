<?php
//require_once('encrypt_decrypt.php');
error_reporting(0);
session_start();

$un = $_SESSION['username'];
$pw = $_SESSION['password'];

if(($un=='') || ($pw=='')||$_SESSION['login']==0)
{
echo "<script language=javascript>alert('Please Login first..Warning from uploader page')</script>";
require_once('login.php');
exit(0);
}

$earlier = microtime(true);

//generating new transaction id
$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("cloudunsafe",$con) or die('could not connect with database');
$sql = "select * from transidunsafe";
$result = mysql_query($sql,$con) or die('couldnot execute the order1');
if( mysql_num_rows($result) == 0)
{
	$sql = "insert into transidunsafe values(1)";
	$result = mysql_query($sql,$con) or die('couldnot execute the order2');
	$new_id = 1;
}
else
{
	$result_row= mysql_fetch_array($result);
	$prev_id = $result_row['trans'];
	$new_id = $prev_id+1;
	$sql = "UPDATE transidunsafe SET trans = trans+1";
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
	  //$fn1 = $_FILES["userfile"]["tmp_name"]; //Use the tmp_name always to get file content
	  $fileName = $_FILES['userfile']['name'];
	  $tmpName  = $_FILES['userfile']['tmp_name'];
	  
		$fp = fopen($tmpName, 'r');
		$content = fread($fp, filesize($tmpName));
		$content = addslashes($content);
		fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}
	  $type = $_FILES["userfile"]["type"];
	  $size = $_FILES["userfile"]["size"];
	  //$file = file_get_contents ($fn1);
	  $len = strlen($file);
	
	  $username = $un;
	  $password2 = $pw;
	  $filename = $_FILES["userfile"]["name"];
	 
	  //store file
	  $con = mysql_connect("localhost","root","") or die('could not open database');
	  mysql_select_db("cloudunsafe",$con) or die('could not connect with database');
	  for($i=0;$i<20;$i++)
	  {
	  $sql = "insert into cloudpartunsafe".$i." values(\"$content\",\"$type\",\"$size\",\"$username\",\"$password2\",\"$filename\",\"$new_id\")";
	  mysql_query($sql,$con) or die(mysql_error());
	  }
	  mysql_close($con);
	  
	  $later =microtime(true);
	  $res = $later-$earlier;
	  $my_file = 'uploadtimeunsafe.txt';
	  $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
	  $data = "\nTime taken ".$res." seconds filesize ".$size." KB";
	  fwrite($handle, $data);
	  fclose($handle);
	
	echo "<script language=javascript>alert('Your file has been successfully uploaded')</script>";  
	require_once('home.php');
	exit(0);
}
  
  


?>