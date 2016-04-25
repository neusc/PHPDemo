<html>
<head>
    <title>Stock Quote From NASDAQ</title>
</head>
<body>
<?php 
//用户在自己的主页载入AMZN股票的信息
$symbol = 'AMZN';
echo '<h1>Stock Quote for'.$symbol.'</h1>';

$url = 'http://finance.yahoo.com/q'.'?s='.$symbol.'$e=.csv&f=sl1d1t1c1ohgv';
if (!($contents = file_get_contents($url))){
    die('Failure to open'.$url);
}

//explode此函数返回由字符串组成的 array，每个元素都是 string 的一个子串，它们被字符串 delimiter 作为边界点分割出来
// list把数组中的值赋给一些变量 
list($symbol,$quote,$date,$time) = explode(',', $contents);

//trim去除字符串首尾的空格和其它字符，过滤列表也可以有第二个参数限定
$date = trim($date,'"');
$time = trim($time,'"');

echo '<p>'.$symbol.' was last sold at: '.$quote.'</p>';
echo '<p>Quote current as of '.$date.' at '.$time.'</p>';
echo '<p>This information retrieved from <br/><a href="'.$url.'">'.$url.'</a></p>';
?>
</body>
</html>

