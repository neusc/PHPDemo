<?php
chdir('../uploads/');

// 能够运行服务器命令的函数

//exec version
echo '<pre>';
exec('dir',$result);
foreach ($result as $line){
    echo "$line\n";
}
echo '</pre>';
echo '<br><hr><br>';

//passthru version
echo '<pre>';
passthru('dir');
echo '</pre>';
echo '<br><hr><br>';

//system version
echo '<pre>';
$result = system('dir');
echo '</pre>';
echo '<br><hr><br>';

// backticks version
echo '<pre>';
$result = `dir`;
echo $result;
echo '</pre>';