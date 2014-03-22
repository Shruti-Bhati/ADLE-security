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


//Generate a random array of 11 elements
$count = 11 ;
$rand_array = array();
$i=0;
while($count!=0)
{
	$gen = rand(0,19);
	if(!in_array($gen,$rand_array)) //if gen is present is not present
	{
		$rand_array[$i] = $gen;
		$i++;
		$count--;
	}
	else
	continue;
}

//Convert the array to string
$string = NULL;
for($i=0;$i<11;$i++)
{
$string = $string.$rand_array[$i].";";
}
$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("cloudunsafe",$con) or die('could not connect with database');

echo $string."<br />";
//echo $string[0]."<br />";
$len = count($rand_array);

//strlen($string);
for($i=0;$i<$len;$i++)
{
$var = $rand_array[$i];
//echo "<br />".$var."<br />";
$sql = "delete from cloudpartunsafe" . $var . " where trans_id = " . $id;
//"delete from cloudpartunsafe".$var."where trans_id = $id and username =\"$un\" " ;
//'delete from cloudpartunsafe'.$var.'where trans_id = $id and username = $un';
//"delete from cloudpartunsafe".$var."where trans_id = \"$id\" and username =\"$un\" " ;
mysql_query($sql,$con) or die(mysql_error());
echo "<br />Deleted from cloud ".$var;
}


	  $later = microtime();
	  $res = $later-$earlier;
	  $my_file = 'Log.txt';
	  $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
	  fwrite($handle, $string);
	  fclose($handle);

	echo "<script language=javascript>alert('Your file has been successfully deleted')</script>";  
	require_once('home.php');
	exit(0);
?>
