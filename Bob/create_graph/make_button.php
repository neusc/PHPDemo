<?php
$buttonText = $_REQUEST['button_text'];
$color = $_REQUEST['color'];

//empty()���������ڻ���ֵΪfalse,isset()�������Ƿ�����,defined()��ⳣ���Ƿ�����
if (empty($buttonText) || empty($color)){
    echo 'Could not create image - form not filled out correctly';
    exit;
}
//���ڴ��д���ͼ��,�����Ҫʹ��ImagePNG()����
$img = imagecreatefrompng($color.'-button.png');
//��ȡͼ��ĸ߶ȺͿ��
$widthImage = imagesx($img);
$heightImage = imagesy($img);
//ͼ����Χ���пհ�
$widthImageMargins = $widthImage - (2*18);
$heightImageMargins = $heightImage - (2*18);

$fontSize = 33;
//��GD2��ָ������λ��
putenv('GDFONTPATH = C:\WINDOWS\Fonts');
$fontName = 'arial';

//�鿴�ı��߿�����ı���С
do{
    $fontSize--;
    //�Ը����������С$fontSize���ı���б0��,ʹ������$fontName,���ذ����߿�����ǵ����������
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
    //��ӽ�������
    if ($leftText<0){
        $textX += abs($leftText);
    }
    //��ӻ�������΢��
    $aboveLineText = abs($bbox[7]);
    $textY += $aboveLineText;
    
    $textY -= 2;
    
    $white = imagecolorallocate($img, 255, 255, 255);
    //���ı�д����ť��
    imagettftext($img, $fontSize, 0, $textX, $textY, $white, $fontName, $buttonText);
    
    //����������
    header('Content-type:image/png');
    imagepng($img);
    
    imagedestroy($img);
    
}