<?php
$day = 18;
$month = 9;
$year = 1972;

//将生日转换为unix时间戳
$bdayunix = mktime(0,0,0,$month,$day,$year);
//获取当前日期unix时间戳
$nowunix = time();
$ageunix = $nowunix - $bdayunix;
//floor函数返回小于其值的最大整数
$age = floor($ageunix/(60*60*24*365));

echo "Age is $age";