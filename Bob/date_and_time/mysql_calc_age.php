<?php
$day = 18;
$month = 9;
$year = 1972;

//将生日格式化为ISO 8601标准日期，此格式是MySQL数据库的标准格式
$bdayISO = date("c",mktime(0,0,0,$month,$day,$year));

//面向对象
$db = new mysqli('localhost','same','same');
$query = "select datediff(now(),'$bdayISO')";
$res = $db->query($query);
$age = $res->fetch_array();

//面向过程
// $db = mysqli_connect('localhost','same','same');
// $res = mysqli_query($db, "select datediff(now(),'$bdayISO')");
// $age = mysqli_fetch_array($res);

echo "Age is ".floor($age[0]/365.25);