<?php
$day = 18;
$month = 9;
$year = 1972;

//������ת��Ϊunixʱ���
$bdayunix = mktime(0,0,0,$month,$day,$year);
//��ȡ��ǰ����unixʱ���
$nowunix = time();
$ageunix = $nowunix - $bdayunix;
//floor��������С����ֵ���������
$age = floor($ageunix/(60*60*24*365));

echo "Age is $age";