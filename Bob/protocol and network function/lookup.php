<html>
<head>
    <title>Stock Quote From NASDAQ</title>
</head>
<body>
<?php 
//�û����Լ�����ҳ����AMZN��Ʊ����Ϣ
$symbol = 'AMZN';
echo '<h1>Stock Quote for'.$symbol.'</h1>';

$url = 'http://finance.yahoo.com/q'.'?s='.$symbol.'$e=.csv&f=sl1d1t1c1ohgv';
if (!($contents = file_get_contents($url))){
    die('Failure to open'.$url);
}

//explode�˺����������ַ�����ɵ� array��ÿ��Ԫ�ض��� string ��һ���Ӵ������Ǳ��ַ��� delimiter ��Ϊ�߽��ָ����
// list�������е�ֵ����һЩ���� 
list($symbol,$quote,$date,$time) = explode(',', $contents);

//trimȥ���ַ�����β�Ŀո�������ַ��������б�Ҳ�����еڶ��������޶�
$date = trim($date,'"');
$time = trim($time,'"');

echo '<p>'.$symbol.' was last sold at: '.$quote.'</p>';
echo '<p>Quote current as of '.$date.' at '.$time.'</p>';
echo '<p>This information retrieved from <br/><a href="'.$url.'">'.$url.'</a></p>';
?>
</body>
</html>

