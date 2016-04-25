<?php

@ $db=new mysqli('localhost','same','same','same');

if(mysqli_connect_errno())
{
	echo '连接失败';
}
else
{
	echo '连接成功';
}

/*
$con = mysql_connect("localhost","same","same");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 else
 {
	 echo '连接成功！';
 }

mysql_close($con);
*/
?>