<?php
class employee{
    public  $name;
    public  $employee_id;
}

$emp = new employee();
$emp->name = "Fred";
$emp->employee_id = 5324;
//序列化将变量或对象转换为字节流便于保存到文件或数据库中
echo serialize($emp);
echo '<br/><br/>';
//找到已加载的php扩展部件
// echo 'Function sets supported in this install are:<br/>';
// $extensions = get_loaded_extensions();
// foreach ($extensions as $ext){
//     echo "$ext <br/>";
//     echo '<ul>';
//     $extFuncs = get_extension_funcs($ext);
//     foreach ($extFuncs as $func){
//         echo "<li>$func</li>";
//     }
//     echo '</ul>';
// }
// echo '<br/><br/>';
//识别脚本所有者
echo get_current_user();
echo '<br/>';
//最后修改时间
echo date('g:i a, j M Y',getlastmod());
echo '<br/>';
$oldMaxExecTime = ini_set('max_execution_time', 120);
echo "Old timeout is $oldMaxExecTime<br/>";
$maxExecTime = ini_get('max_execution_time');
echo "New timeout is $maxExecTime<br/>";
//源代码高亮显示到浏览器
show_source('authmain.php');
highlight_file('authmain.php');