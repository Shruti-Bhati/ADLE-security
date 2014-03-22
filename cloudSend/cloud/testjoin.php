<?php
$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("cloud",$con) or die('could not connect with database');


$username = "sneha";
$sql = "select * from cloudpart0 where username = \"$username\" "; 
$result = mysql_query($sql,$con) or die(mysql_error()); //store the result of first query (username)

$con2 = mysql_connect("localhost","root","") or die('could not open database2');
mysql_select_db("key_escrow",$con) or die('could not connect with database2');
//$sql2 = "select * from keys_db "; //now get all keys 

//$result2 = mysql_query($sql2,$con2) or die(mysql_error());
while($row = mysql_fetch_array($result))
{
$sql2 = "select * from keys_db "; //now get all keys 
$result2 = mysql_query($sql2,$con2) or die(mysql_error());

$val = $row['trans_id'];//get one of the id 
	while($row2 = mysql_fetch_array($result2))
	{
		if(($row['trans_id']==$row2['trans_id']) && $row2['datakey']!=NULL)
		{
		//display and leave
		echo "<br />";
		echo $row['filename'];
		break;
		}
	
	}//end of inner while loop
	

}
mysql_close();
?>