<?php
$buttonText = $_REQUEST['button_text'];
$color = $_REQUEST['color'];

//empty()变量不存在或其值为false,isset()检查变量是否被设置,defined()检测常量是否被设置
if (empty($buttonText) || empty($color)){
    echo 'Could not create image - form not filled out correctly';
    exit;
}
//在内存中创建图像,输出需要使用ImagePNG()函数
$img = imagecreatefrompng($color.'-button.png');
//获取图像的高度和宽度
$widthImage = imagesx($img);
$heightImage = imagesy($img);
//图像周围留有空白
$widthImageMargins = $widthImage - (2*18);
$heightImageMargins = $heightImage - (2*18);

$fontSize = 33;
//给GD2库指定字体位置
putenv('GDFONTPATH = C:\WINDOWS\Fonts');
$fontName = 'arial';

//查看文本边框测试文本大小
do{
    $fontSize--;
    //对给定的字体大小$fontSize，文本倾斜0°,使用字体$fontName,返回包含边框各个角的坐标的数组
    $bbox = imagettfbbox($fontSize, 0, $fontName, $buttonText);
    
    $rightText = $bbox[2];
    $leftText = $bbox[0];
    $widthText = $rightText - $leftText;
    $heightText = abs($bbox[7]-$bbox[1]);
}while ($fontSize>8 && 
        ($heightText>$heightImageMargins ||
         $widthText > $widthImageMargins));
if ($heightText>$heightImageMargins || $widthText>$widthImageMargins){
    echo 'Text given will not fit on button.<br/>';
}
else {
    $textX = $widthImage/2 - $widthText/2;
    $textY = $heightImage/2 - $heightText/2;
    //添加矫正因子
    if ($leftText<0){
        $textX += abs($leftText);
    }
    //添加基线因素微调
    $aboveLineText = abs($bbox[7]);
    $textY += $aboveLineText;
    
    $textY -= 2;
    
    $white = imagecolorallocate($img, 255, 255, 255);
    //将文本写到按钮上
    imagettftext($img, $fontSize, 0, $textX, $textY, $white, $fontName, $buttonText);
    
    //输出到浏览器
    header('Content-type:image/png');
    imagepng($img);
    
    imagedestroy($img);
    
}