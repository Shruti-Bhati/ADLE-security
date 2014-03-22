<?php
$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("key_escrow",$con) or die('could not connect with database');
$val = NULL;
$sql = "SELECT * from keys_db where datakey IS NULL ";
$result = mysql_query($sql,$con)or die('could not connect with execute');
$con2 = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("cloud",$con2) or die(mysql_error());
while($row = mysql_fetch_assoc($result))
{
$id = $row['trans_id'];
for($i=0;$i<20;$i++)
{
$sql = "DELETE FROM cloudpart".$i." WHERE trans_id = \"$id\" ";
mysql_query($sql,$con2) or die('couldnot execute the order');
}
$con = mysql_connect("localhost","root","") or die('could not open database');
mysql_select_db("key_escrow",$con) or die('could not connect with database');
$sql2 = "DELETE FROM keys_db WHERE trans_id = \"$id\" ";
mysql_query($sql2,$con) or die(mysql_error());
}
mysql_close($con);
mysql_close($con2);

?>
