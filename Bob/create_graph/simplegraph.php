<?php
//set up image
$height = 200;
$width = 200;
//创建空白背景
$img = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($img, 255, 255, 255);
$blue = imagecolorallocate($img, 0, 0, 64);

//draw on image
//绘制一个黑色背景
imagefill($img, 0, 0, $blue);
//绘制一条线
imageline($img, 0, 0, $width, $height, $white);
//添加标签
imagestring($img, 4, 50, 150, 'Sales', $white);

//输出图像
//header()必须放在向浏览器发送任何输出之前
header('Content-type: image/png');
//输出png格式的图像
imagepng($img);
//
imagedestroy($img);
