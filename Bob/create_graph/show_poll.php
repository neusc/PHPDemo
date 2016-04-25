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
//�������ݿ������
if (!empty($vote)){
    $vote = addslashes($vote);
    $query = "update poll_results set num_votes=num_votes+1 where candidate ='$vote'";
    if (!($result=@$dbConn->query($query))){
        echo 'Could not connect to database';
        exit;
    }
}
//��ȡͶƱ����������Լ���Ʊ��
$query = 'select * from poll_results';
if (!($result = @$dbConn->query($query))){
    echo 'Could not connect to database';
    exit;
}
//��ѡ����
$numCandidate = $result->num_rows;
//��Ʊ��
$totalVotes = 0;
while ($row = $result->fetch_object()){
    $totalVotes += $row->num_votes;
}
//echo $totalVotes;
//����$resultָ��
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
//ָ��ʹ������ľ���·��
$font = "C:\WINDOWS\Fonts\Arial.ttf";
$tilteSize = 16;
$mainSize = 12;
$smallSize = 12;
$textIndent = 10;

//����ͼ�ε����
$x = $leftMargin+60;
$y = 50;
//�ٷֱȻ�ͼ,1%��ʾ��barUnit
$barUnit = ($width-($x+$rightMargin))/100;
//ͼ��߶�
$height = $numCandidate*($barHeight+$barSpacing)+50;

/*
 * Set up base image
 */
//�����հ׻���
$img = imagecreatetruecolor($width, $height);

//������ɫ
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

//������ͼ���õĻ���
//���������ɫ�ľ���
imagefilledrectangle($img, 0, 0, $width, $height, $bgColor);

//���ƻ�����������
imagerectangle($img, 0, 0, $width-1, $height-1, $lineColor);

//��ӱ���
$title = 'Poll Results';
//bounding box�����������С����,���ؾ���4�������ȫ��8������
$titleDimensions = imagettfbbox($tilteSize, 0, $font, $title);
$titleLength = $titleDimensions[2] - $titleDimensions[0];
$titleHeight = abs($titleDimensions[7] - $titleDimensions[1]);
$titleAboveLine = abs($titleDimensions[7]);
$titleX = ($width-$titleLength)/2;
$titleY = ($y-$titleHeight)/2 + $titleAboveLine;
//���ı�����ͼ��֮��
imagettftext($img, $tilteSize, 0, $titleX, $titleY, $textColor, $font, $title);
//���ƻ���
imageline($img, $x, $y-5, $x, $height-15, $lineColor);

/*
 * Draw data into graph
 */
//$num = 0;
//ע��˴�whileѭ������ִ�з�Χ�����׳��ֻ���ͼ�β�ȫ�����
while ($row = $result->fetch_object()){
    if ($totalVotes>0){
        //intval()��ȡһ������������ֵ
        $percent = intval(($row->num_votes/$totalVotes)*100);
    }else {
        $percent = 0;
    }
    //$num++;

    //echo $num;
    //Ϊͼ����Ӱٷֱȱ�ǩ
    $percentDimensions = imagettfbbox($mainSize, 0, $font, $percent.'%');
    $percentLength = $percentDimensions[2] - $percentDimensions[0];
    imagettftext($img, $mainSize, 0, $width-$percentLength-$textIndent, $y+($barHeight/2), $percentColor, $font, $percent.'%');
    
    //���ưٷֱ�ʵ�����
    $barLength = $x + ($percent*$barUnit);
    imagefilledrectangle($img, $x, $y-2, $barLength, $y+$barHeight, $barColor);
    //��Ӻ�ѡ�˱�ǩ
    imagettftext($img, $mainSize, 0, $textIndent, $y+($barHeight/2), $textColor, $font, "$row->candidate");
    //100%��ʾ���ο�
    imagerectangle($img, $barLength+1, $y-2, $x+(100*$barUnit), $y+$barHeight, $lineColor);
    //�������ռ�ȱ�ǩ
    imagettftext($img, $smallSize, 0, $x+(100*$barUnit)-50, $y+($barHeight/2), $numberColor, $font, $row->num_votes.'/'.$totalVotes);
    //�ƶ�����һ�����ο�
    $y = $y + ($barHeight + $barSpacing);
}
/*
 * Display image
 */
Header('Content-type: image/png');
imagepng($img);
imagedestroy($img);




