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

$username = $un;
require_once('encrypt_decrypt.php');
$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("cloudunsafe",$con) or die('could not connect with database');
$id = $_POST['file'];

for($i=0;$i<20;$i++)
{
$sql = "select * from cloudpartunsafe".$i." where trans_id = \"$id\" ";
$result = mysql_query($sql,$con);
$num_rows = mysql_num_rows($result);
	if($num_rows!=0) //if the file with this trans_id exists in the i-th table
	{
	$results = mysql_fetch_array($result);
	$content = $results['filecontent'];
	$name = $results['filename'];	
	$type = $results['type'];
	$size = $results['size'];
	break;
	}
	else
	continue;
}



$username = $_SESSION['password'];

$con = mysql_connect("localhost","root","") or die('could not open database');
$len = $results['len'];
$file = $content;
$later = microtime();

	  
	  $res = $later-$earlier;
	  $my_file = 'retrievetimes.txt';
	  $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
	  $data = "\nTime taken ".$res." seconds,filesize ".$size." KB";
	  fwrite($handle, $data);
	  fclose($handle);

header("Content-length: ".$size."");
header("Content-type: ".$type."");
header('Content-Disposition: attachment; filename="'.$name.'"');
echo $file;
//sleep(2);
//header('Location:home.php');
//echo "<script language=javascript>alert('Your file has b')</script>";  
	//require_once('home.php');
	//exit(0);
	  
?>