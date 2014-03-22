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
mysql_select_db("cloud",$con) or die('could not connect with database');
$id = $_POST['file'];
$sql = "select * from cloudpart0 where trans_id = \"$id\" ";
$result = mysql_query($sql,$con);
$results = mysql_fetch_array($result);
$content = $results['encfilecontent'];
$username = $_SESSION['password'];

$name = $results['filename'];
$type = $results['type'];
$size = $results['size'];

$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("key_escrow",$con) or die('could not connect with database');
$sql = "select * from keys_db where trans_id = \"$id\" ";
$result = mysql_query($sql,$con);
$results = mysql_fetch_array($result);

$datakey = $results['datakey'];

$len = $results['len'];
$file = fnDecrypt($content, $username);
$file = fnDecrypt($file, $datakey);
$file = substr($file,0,$len+1);
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


	  
?>