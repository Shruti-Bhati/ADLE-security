<?php
//1.create database + table
$con = mysql_connect("localhost","root","") or die('could not open database');
$sql = "CREATE DATABASE IF NOT EXISTS cloudunsafe";
mysql_query($sql,$con);
mysql_select_db("testcloud",$con) or die('could not connect with database2');

for($i=0;$i<20;$i++)
{
$sql = "create table IF NOT EXISTS cloudpartunsafe".$i."(filecontent LONGBLOB)";
mysql_query($sql,$con) or die('couldnot execute the order');
}
//2.Create 5 mb variable
$file = 
//3. run a for loop to append teh data to database

?>