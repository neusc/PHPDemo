<html>
<head>
    <title>Mirror update</title>
</head>
<body>
<h1>Mirror update</h1>
<?php 
//备份或镜像一个文件
//设置标量
$host = 'ftp.cs.rmit.edu.au';
$user = 'anonymous';
$password = 'me@example.com';
$remotefile = '/pub/tsg/teraterm/ttssh14.zip';
$localfile = '/tmp/writable/ttssh14.zip';
//连接远程ftp服务器
$conn = ftp_connect($host);
if(!$conn){
    echo 'Error:Could not connect to ftp server<br/>';
    exit;
}
//登录
$result = @ftp_login($conn, $user, $password);
if (!$result){
    echo 'Error: Could not log on as $user<br/>';
    ftp_quit($conn);
    exit;
}

echo "Logged in as $user<br/>";

//检查本地文件是否需要更新
echo 'Checking file time...<br/>';
if (file_exists($localfile)){
    //获取文件最后被修改时间
    $localtime = filemtime($localfile);
    echo 'Local file last updated ';
    echo date('G:i j-M-Y',$localtime);
    echo '<br/>';
    
}
else 
    $localtime = 0;

//返回最后被修改时间
$remotetime = ftp_mdtm($conn, $remotefile);
if (!($remotetime >= 0)){
    echo 'Can\'t access remote file time.<br/>';
    $remotetime = $localtime+1;
}
else {
    echo 'Remote file last updated ';
    echo date('G:i j-M-Y',$remotetime);
    echo '<br/>';
}

if (!($remotetime > $localtime)){
    echo 'Local copy is up to date.<br/>';
    exit;
}
//从ftp服务器下载文件
echo 'Getting file from server...<br/>';
$fp = fopen($localfile, 'w');
if (!$success = ftp_fget($conn, $fp, $remotefile, FTP_BINARY)){
    echo 'Error: Could not download file';
    ftp_quit($conn);
    exit;
}
fclose($fp);
echo 'File downloaded successfully';
//关闭到ftp服务器的连接
ftp_quit($conn);
?>
</body>
</html>