<?php
function createtables() {
$con = mysql_connect("localhost","root","") or die('could not open database');
$sql = "CREATE DATABASE IF NOT EXISTS cloud";
mysql_query($sql,$con);
mysql_select_db("cloud",$con) or die('could not connect with database2');

for($i=0;$i<20;$i++)
{
$sql = "create table IF NOT EXISTS cloudpart".$i."(encfilecontent LONGBLOB,type VARCHAR(10),size VARCHAR(15),username VARCHAR(50),password VARCHAR(50),filename VARCHAR(50),trans_id BIGINT)";
mysql_query($sql,$con) or die('couldnot execute the order');
}
$sql = "create table IF NOT EXISTS transid(trans BIGINT NOT NULL AUTO_INCREMENT,primary key(trans))";
mysql_query($sql,$con) or die('couldnot execute the order2');


$sql = "CREATE DATABASE IF NOT EXISTS key_escrow";
mysql_query($sql,$con);
mysql_select_db("key_escrow",$con) or die('could not connect with database2');
$sql = "create table IF NOT EXISTS keys_db(userkey VARCHAR(50),datakey VARCHAR(300),trans_id BIGINT,len BIGINT)";
mysql_query($sql,$con) or die('couldnot execute the order3');

$sql = "CREATE DATABASE IF NOT EXISTS user_details";
mysql_query($sql,$con);
mysql_select_db("user_details",$con) or die('could not connect with database2');
$sql = "create table IF NOT EXISTS user(username VARCHAR(1000),password VARCHAR(1000),email VARCHAR(100))";
mysql_query($sql,$con) or die('couldnot execute the order3');
mysql_close($con);


}
?>