<?php
//��õ�ǰ���ڵ�UNIXʱ���
// $timestamp = time();
// $timestamp = date("U");
// $timestamp = mktime();

//����һ���������飬��ʾ���ں�ʱ��ĸ�������
$today = getdate();
print_r($today);
echo '<br/><br/>';

//����û��������ڵ���Ч��  
print_r(checkdate(2,29,2008));
echo '<br/><br/>';

echo strftime('%A<br/>');
echo strftime('%x<br/>');
echo strftime('%c<br/>');
echo strftime('%Y<br/>');
echo '<br/><br/>';

//���ظ������͵�ʱ���
echo number_format(microtime(true),10,'.','');

echo '<br/><br/>';

//������ʽ֮���ת��������Ҫת����Julian Day Count�м��ʽ
$jd = gregoriantojd(9, 18, 1582);
echo jdtojulian($jd);
