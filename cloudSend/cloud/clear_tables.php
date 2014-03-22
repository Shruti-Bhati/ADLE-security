
<?php
$con = mysql_connect("localhost","root","") or die('could not open database');
//mysql_select_db("cloud",$con) or die('could not connect with database');
$sql = "drop database cloud";
mysql_query($sql,$con);
$sql = "drop database key_escrow";
mysql_query($sql,$con);
$sql = "drop database user_details";
mysql_query($sql,$con);
mysql_close($con);

?>