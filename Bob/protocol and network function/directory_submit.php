<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Site submission results</title>
</head>
<body>
<?php 
//���ڼ��URL�͵����ʼ���ַ�ĽŲ�
$url = $_REQUEST['url'];
$email = $_REQUEST['email'];

//���ذ���url������ɲ��ֵĹ�������
$url = parse_url($url);
$host = $url['host'];
if (!($ip = gethostbyname($host))){
    echo 'Host for URL does not have valid IP';
    exit;
}
echo "Host is at IP $ip<br/>";

$email = explode("@", $email);
$emailhost = $email[1];
//����һ���ʼ���ַ��һ���ʼ�������¼
if (!getmxrr($emailhost, $mxhostsarr)){
    echo 'Email address is not at valid host';
    exit;
}

echo 'Email is delivered via: ';
foreach ($mxhostsarr as $mx)
    echo "$mx ";
    
echo '<br/>All submitted details are OK.<br/>';
echo 'Thank you for submitting your site.<br/>'
        .'It will be visited by one of our staff members soon.';

?>
</body>
</html>
