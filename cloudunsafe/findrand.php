<?php
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
echo $string;
$my_file = 'Log.txt';
	  $handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
	  fwrite($handle, $string);
	  fclose($handle);
?>