<?php
/*
 * Database query to get poll info
 */
$vote = $_REQUEST['vote'];

$dbConn = new mysqli('localhost','poll','poll','poll');
if (!$dbConn){
    echo 'Could not connect to the database';
    exit;
}
//更新数据库表数据
if (!empty($vote)){
    $vote = addslashes($vote);
    $query = "update poll_results set num_votes=num_votes+1 where candidate ='$vote'";
    if (!($result=@$dbConn->query($query))){
        echo 'Could not connect to database';
        exit;
    }
}
//获取投票结果总行数以及总票数
$query = 'select * from poll_results';
if (!($result = @$dbConn->query($query))){
    echo 'Could not connect to database';
    exit;
}
//候选人数
$numCandidate = $result->num_rows;
//总票数
$totalVotes = 0;
while ($row = $result->fetch_object()){
    $totalVotes += $row->num_votes;
}
//echo $totalVotes;
//重置$result指针
$result->data_seek(0);

/*
 * Initial calculation for graph
 */
//putenv('GDFONTPATH=C:\WINDOWS\Fonts');
$width = 500;
$leftMargin = 50;
$rightMargin = 50;
$barHeight = 40;
$barSpacing = $barHeight/2;
//指定使用字体的绝对路径
$font = "C:\WINDOWS\Fonts\Arial.ttf";
$tilteSize = 16;
$mainSize = 12;
$smallSize = 12;
$textIndent = 10;

//绘制图形的起点
$x = $leftMargin+60;
$y = 50;
//百分比绘图,1%表示即barUnit
$barUnit = ($width-($x+$rightMargin))/100;
//图像高度
$height = $numCandidate*($barHeight+$barSpacing)+50;

/*
 * Set up base image
 */
//创建空白画布
$img = imagecreatetruecolor($width, $height);

//分配颜色
$white = imagecolorallocate($img, 255, 255, 255);
$blue = imagecolorallocate($img, 0, 64, 128);
$black = imagecolorallocate($img, 0, 0, 0);
$pink = imagecolorallocate($img, 255, 78, 243);

$textColor = $black;
$percentColor = $black;
$bgColor = $white;
$lineColor = $black;
$barColor = $blue;
$numberColor = $pink;

//创建绘图所用的画布
//绘制填充颜色的矩形
imagefilledrectangle($img, 0, 0, $width, $height, $bgColor);

//绘制画布的轮廓线
imagerectangle($img, 0, 0, $width-1, $height-1, $lineColor);

//添加标题
$title = 'Poll Results';
//bounding box包含区域的最小矩形,返回矩形4个顶点的全部8个坐标
$titleDimensions = imagettfbbox($tilteSize, 0, $font, $title);
$titleLength = $titleDimensions[2] - $titleDimensions[0];
$titleHeight = abs($titleDimensions[7] - $titleDimensions[1]);
$titleAboveLine = abs($titleDimensions[7]);
$titleX = ($width-$titleLength)/2;
$titleY = ($y-$titleHeight)/2 + $titleAboveLine;
//将文本置于图像之上
imagettftext($img, $tilteSize, 0, $titleX, $titleY, $textColor, $font, $title);
//绘制基线
imageline($img, $x, $y-5, $x, $height-15, $lineColor);

/*
 * Draw data into graph
 */
//$num = 0;
//注意此处while循环语句的执行范围，容易出现绘制图形补全的情况
while ($row = $result->fetch_object()){
    if ($totalVotes>0){
        //intval()获取一个变量的整型值
        $percent = intval(($row->num_votes/$totalVotes)*100);
    }else {
        $percent = 0;
    }
    //$num++;

    //echo $num;
    //为图形添加百分比标签
    $percentDimensions = imagettfbbox($mainSize, 0, $font, $percent.'%');
    $percentLength = $percentDimensions[2] - $percentDimensions[0];
    imagettftext($img, $mainSize, 0, $width-$percentLength-$textIndent, $y+($barHeight/2), $percentColor, $font, $percent.'%');
    
    //绘制百分比实体矩形
    $barLength = $x + ($percent*$barUnit);
    imagefilledrectangle($img, $x, $y-2, $barLength, $y+$barHeight, $barColor);
    //添加候选人标签
    imagettftext($img, $mainSize, 0, $textIndent, $y+($barHeight/2), $textColor, $font, "$row->candidate");
    //100%表示矩形框
    imagerectangle($img, $barLength+1, $y-2, $x+(100*$barUnit), $y+$barHeight, $lineColor);
    //添加数字占比标签
    imagettftext($img, $smallSize, 0, $x+(100*$barUnit)-50, $y+($barHeight/2), $numberColor, $font, $row->num_votes.'/'.$totalVotes);
    //移动至下一个矩形框
    $y = $y + ($barHeight + $barSpacing);
}
/*
 * Display image
 */
Header('Content-type: image/png');
imagepng($img);
imagedestroy($img);




