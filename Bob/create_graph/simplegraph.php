<?php
//set up image
$height = 200;
$width = 200;
//�����հױ���
$img = imagecreatetruecolor($width, $height);
$white = imagecolorallocate($img, 255, 255, 255);
$blue = imagecolorallocate($img, 0, 0, 64);

//draw on image
//����һ����ɫ����
imagefill($img, 0, 0, $blue);
//����һ����
imageline($img, 0, 0, $width, $height, $white);
//��ӱ�ǩ
imagestring($img, 4, 50, 150, 'Sales', $white);

//���ͼ��
//header()�������������������κ����֮ǰ
header('Content-type: image/png');
//���png��ʽ��ͼ��
imagepng($img);
//
imagedestroy($img);
