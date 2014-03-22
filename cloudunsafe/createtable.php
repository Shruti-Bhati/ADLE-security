<?php
function createtables() {
$con = mysql_connect("localhost","root","") or die('could not open database');
$sql = "CREATE DATABASE IF NOT EXISTS cloudunsafe";
mysql_query($sql,$con);
mysql_select_db("cloudunsafe",$con) or die('could not connect with database2');

for($i=0;$i<20;$i++)
{
$sql = "create table IF NOT EXISTS cloudpartunsafe".$i."(filecontent LONGBLOB,type VARCHAR(10),size VARCHAR(15),username VARCHAR(50),password VARCHAR(50),filename VARCHAR(50),trans_id BIGINT)";
mysql_query($sql,$con) or die('couldnot execute the order');
}

$sql = "create table IF NOT EXISTS transidunsafe(trans BIGINT NOT NULL AUTO_INCREMENT,primary key(trans))";
mysql_query($sql,$con) or die('couldnot execute the order2');

/*
$sql = "CREATE DATABASE IF NOT EXISTS key_escrowunsafe";
mysql_query($sql,$con);
mysql_select_db("key_escrowunsafe",$con) or die('could not connect with database2');
$sql = "create table IF NOT EXISTS keys_dbunsafe(userkey VARCHAR(50),datakey VARCHAR(300),trans_id BIGINT,len BIGINT)";
mysql_query($sql,$con) or die('couldnot execute the order3');
*/
$sql = "CREATE DATABASE IF NOT EXISTS user_detailsunsafe";
mysql_query($sql,$con);
mysql_select_db("user_detailsunsafe",$con) or die('could not connect with database2');
$sql = "create table IF NOT EXISTS userunsafe(username VARCHAR(1000),password VARCHAR(1000),email VARCHAR(100))";
mysql_query($sql,$con) or die('couldnot execute the order3');
mysql_close($con);
}
?>