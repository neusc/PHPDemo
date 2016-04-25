<?php
//获得当前日期的UNIX时间戳
// $timestamp = time();
// $timestamp = date("U");
// $timestamp = mktime();

//返回一个关联数组，表示日期和时间的各个部分
$today = getdate();
print_r($today);
echo '<br/><br/>';

//检查用户输入日期的有效性  
print_r(checkdate(2,29,2008));
echo '<br/><br/>';

echo strftime('%A<br/>');
echo strftime('%x<br/>');
echo strftime('%c<br/>');
echo strftime('%Y<br/>');
echo '<br/><br/>';

//返回浮点类型的时间戳
echo number_format(microtime(true),10,'.','');

echo '<br/><br/>';

//日历格式之间的转换，首先要转换成Julian Day Count中间格式
$jd = gregoriantojd(9, 18, 1582);
echo jdtojulian($jd);
